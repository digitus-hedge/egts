<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacilityBannerRequest;
use App\Models\FacilityBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FacilityBannerController extends Controller
{
    protected int $imageWidth = 1600;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    public function index()
    {
        $facilityBanner = FacilityBanner::first() ?? new FacilityBanner();
        return view('admin.facility-banner.form', compact('facilityBanner'));
    }

    public function store(FacilityBannerRequest $request)
    {
        $data = $request->validated();

        $facilityBanner = FacilityBanner::first() ?? new FacilityBanner();
        $facilityBanner->banner_title = $data['banner_title'] ?? null;
        $facilityBanner->banner_description = $data['banner_description'] ?? null;
        $facilityBanner->operations_heading = $data['operations_heading'] ?? null;
        $facilityBanner->operations_description = $data['operations_description'] ?? null;
        $facilityBanner->infrastructure_title = $data['infrastructure_title'] ?? null;
        $facilityBanner->infrastructure_description = $data['infrastructure_description'] ?? null;

        if ($request->hasFile('banner_image')) {
            if ($facilityBanner->banner_image) {
                Storage::disk('public')->delete($facilityBanner->banner_image);
            }
            $facilityBanner->banner_image = $this->processAndStoreImage($request->file('banner_image'));
        }

        $facilityBanner->save();

        return redirect()
            ->route('admin.home.facility.banner')
            ->with('success', 'Facility banner saved successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'facility/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
