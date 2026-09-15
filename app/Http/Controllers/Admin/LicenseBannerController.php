<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LicenseBannerRequest;
use App\Models\LicenseBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LicenseBannerController extends Controller
{
    protected int $imageWidth = 1600;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    public function index()
    {
        $licenseBanner = LicenseBanner::first() ?? new LicenseBanner();
        return view('admin.license-banner.form', compact('licenseBanner'));
    }

    public function store(LicenseBannerRequest $request)
{
    $data = $request->validated();

    $licenseBanner = LicenseBanner::first() ?? new LicenseBanner();
    $licenseBanner->title = $data['title'] ?? null;
    $licenseBanner->description = $data['description'] ?? null;

    $licenseBanner->meta_title = $data['meta_title'] ?? null;
$licenseBanner->meta_description = $data['meta_description'] ?? null;

    // ----- Image -----
    if ($request->hasFile('image')) {
        if ($licenseBanner->image) {
            Storage::disk('public')->delete($licenseBanner->image);
        }
        $licenseBanner->image = $this->processAndStoreImage($request->file('image'));

        // uploading a new image clears any existing video (mutually exclusive)
        if ($licenseBanner->video) {
            Storage::disk('public')->delete($licenseBanner->video);
            $licenseBanner->video = null;
        }
    } elseif ($request->boolean('remove_image')) {
        if ($licenseBanner->image) {
            Storage::disk('public')->delete($licenseBanner->image);
        }
        $licenseBanner->image = null;
    }

    // ----- Video -----
    if ($request->hasFile('video')) {
        if ($licenseBanner->video) {
            Storage::disk('public')->delete($licenseBanner->video);
        }
        $licenseBanner->video = $request->file('video')->store('license-banner/videos', 'public');

        // uploading a new video clears any existing image (mutually exclusive)
        if ($licenseBanner->image) {
            Storage::disk('public')->delete($licenseBanner->image);
            $licenseBanner->image = null;
        }
    } elseif ($request->boolean('remove_video')) {
        if ($licenseBanner->video) {
            Storage::disk('public')->delete($licenseBanner->video);
        }
        $licenseBanner->video = null;
    }

    $licenseBanner->save();

    return redirect()
        ->route('admin.home.license-banner')
        ->with('success', 'License banner saved successfully.');
}

    private function processAndStoreImage($file): string
    {
        $filename = 'license-banner/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
