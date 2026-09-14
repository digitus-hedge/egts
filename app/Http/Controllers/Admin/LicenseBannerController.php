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

        if ($request->hasFile('image')) {
            if ($licenseBanner->image) {
                Storage::disk('public')->delete($licenseBanner->image);
            }
            $licenseBanner->image = $this->processAndStoreImage($request->file('image'));
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
