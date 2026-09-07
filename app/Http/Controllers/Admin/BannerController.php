<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Intervention\Image\Format;

class BannerController extends Controller
{
    protected int $imageWidth = 1200;
    protected int $imageHeight = 600;
    protected int $compressQuality = 70;

    /**
     * SHOW FORM — always the single banner (or empty model if none exists yet)
     */
    public function index()
    {
        $banner = Banner::first() ?? new Banner();
        return view('admin.banner.form', compact('banner'));
    }

    /**
     * STORE — creates the banner if none exists, otherwise updates the existing one
     */
    public function store(BannerRequest $request)
{
    ini_set('memory_limit', '512M');

    try {
        $data = $request->validated();

        $banner = Banner::first() ?? new Banner();
        $banner->title = $data['title'];
        $banner->description = $data['description'] ?? null;
              $banner->meta_title        = $data['meta_title'] ?? null;
        $banner->meta_description  = $data['meta_description'] ?? null;

        $hasNewVideo = $request->hasFile('video');
        $hasNewImage = collect(['image_1', 'image_2', 'image_3'])
            ->contains(fn ($field) => $request->hasFile($field));

        if ($hasNewVideo) {
            // 1. New video uploaded -> Wipe out all existing images completely
            foreach (['image_1', 'image_2', 'image_3'] as $field) {
                if ($banner->{$field}) {
                    Storage::disk('public')->delete($banner->{$field});
                }
                $banner->{$field} = null;
            }

            // Replace existing video
            if ($banner->video) {
                Storage::disk('public')->delete($banner->video);
            }
            $banner->video = $this->storeVideo($request->file('video'));

        } elseif ($hasNewImage) {
            // 2. New image uploaded -> Wipe out existing video completely
            if ($banner->video) {
                Storage::disk('public')->delete($banner->video);
                $banner->video = null;
            }

            // Process uploaded images individually
            foreach (['image_1', 'image_2', 'image_3'] as $field) {
                if ($request->hasFile($field)) {
                    if ($banner->{$field}) {
                        Storage::disk('public')->delete($banner->{$field});
                    }
                    $banner->{$field} = $this->processAndStoreImage($request->file($field));

                    gc_collect_cycles();
                }
            }
        }

        $banner->save();

        return redirect()
            ->route('admin.home.banner')
            ->with('success', 'Banner saved successfully.');

    } catch (\Throwable $e) {
        \Log::error('Banner store() FAILED', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
        ]);

        return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

    private function processAndStoreImage($file): string
    {
        $filename = 'banners/' . Str::random(20) . '.webp';

        // Initialize ImageManager with GD Driver
        $manager = new ImageManager(new Driver());

        // Read image path
        $image = $manager->read($file->getPathname());

        // Resize/Crop
        $image->cover($this->imageWidth, $this->imageHeight);

        // Encode to WebP
        $encoded = $image->toWebp($this->compressQuality ?? 80);

        // Save to storage disk
        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }

    private function storeVideo($file): string
    {
        return $file->store('banners/videos', 'public');
    }
}
