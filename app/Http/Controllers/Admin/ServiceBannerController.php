<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceBannerRequest;
use App\Models\ServiceBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceBannerController extends Controller
{
    protected int $imageWidth = 1000;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    /**
     * SHOW FORM — always the single Service Banner section (or empty model if none exists yet)
     */
    public function index()
    {
        $about = ServiceBanner::first() ?? new ServiceBanner();
        return view('admin.service-banner', compact('about'));
    }

    /**
     * STORE — creates the Service Banner section if none exists, otherwise updates the existing one
     */
    public function store(ServiceBannerRequest $request)
    {
        $data = $request->validated();

        $about = ServiceBanner::first() ?? new ServiceBanner();

        // Mandatory fields
        $about->banner_heading    = $data['title'];
        $about->banner_description = $data['description'];

        // Optional (not mandatory) fields
        $about->meta_title       = $data['meta_title'] ?? null;
        $about->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $this->processAndStoreImage($request->file('image'));
        }

        $about->save();

        return redirect()
            ->route('admin.service.banner')
            ->with('success', 'Service Banner Section saved successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'services/' . Str::random(20) . '.webp';

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
}