<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected int $imageWidth = 1200;
    protected int $imageHeight = 600;
    protected int $compressQuality = 70;

    /**
     * LIST PAGE — show all banners
     */
    // public function index()
    // {
    //     $banners = Banner::latest()->paginate(10);
    //     return view('admin.banner.list', compact('banners'));
    // }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $banners = Banner::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString(); // keeps search/per_page in pagination links

        return view('admin.banner.list', compact('banners', 'search', 'perPage'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $banner = new Banner(); // empty model, so the shared form view works for both create/edit
        return view('admin.banner.form', compact('banner'));
    }

    /**
     * STORE new banner
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();

        $banner = new Banner();
        $banner->title = $data['title'];
        $banner->description = $data['description'] ?? null;

        foreach (['image_1', 'image_2', 'image_3'] as $field) {
            if ($request->hasFile($field)) {
                $banner->{$field} = $this->processAndStoreImage($request->file($field));
            }
        }

        if ($request->hasFile('video')) {
            $banner->video = $this->storeVideo($request->file('video'));
        }

        $banner->save();

        return redirect()
            ->route('admin.home.banner')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * EDIT FORM — same view as create, pre-filled
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.form', compact('banner'));
    }

    /**
     * UPDATE existing banner
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();

        $banner->title = $data['title'];
        $banner->description = $data['description'] ?? null;

        foreach (['image_1', 'image_2', 'image_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($banner->{$field}) {
                    Storage::disk('public')->delete($banner->{$field});
                }
                $banner->{$field} = $this->processAndStoreImage($request->file($field));
            }
        }

        if ($request->hasFile('video')) {
            if ($banner->video) {
                Storage::disk('public')->delete($banner->video);
            }
            $banner->video = $this->storeVideo($request->file('video'));
        }

        $banner->save();

        return redirect()
            ->route('admin.home.banner')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * DELETE banner
     */
    public function destroy(Banner $banner)
    {
        foreach (['image_1', 'image_2', 'image_3', 'video'] as $field) {
            if ($banner->{$field}) {
                Storage::disk('public')->delete($banner->{$field});
            }
        }

        $banner->delete();

        return redirect()
            ->route('admin.home.banner')
            ->with('success', 'Banner deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'banners/' . Str::random(20) . '.webp';

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }

    private function storeVideo($file): string
    {
        return $file->store('banners/videos', 'public');
    }
}
