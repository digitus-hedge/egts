<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class AboutController extends Controller
{
    protected int $imageWidth = 1000;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    public function index()
    {
        $why = AboutUs::first() ?? new AboutUs();

        return view('admin.about', compact('why'));
    }

    public function store(AboutUsRequest $request)
    {
        $data = $request->validated();

        $about = AboutUs::first() ?? new AboutUs();

        $about->fill([
            'banner_heading'     => $data['banner_heading'],
            'banner_description' => $data['banner_description'],

            'about_heading'     => $data['about_heading'],
            'about_description' => $data['about_description'],

            'mission_title'            => $data['mission_title'],
            'mission_description'      => $data['mission_description'],
            'mission_description_rich' => $data['mission_description_rich'],

            'vision_title'             => $data['vision_title'],
            'vision_description'       => $data['vision_description'],
            'vision_description_rich'  => $data['vision_description_rich'],

            'values_title'             => $data['values_title'],
            'values_description'       => $data['values_description'],
            'values_description_rich'  => $data['values_description_rich'],

            'commitment_title'            => $data['commitment_title'],
            'commitment_description'      => $data['commitment_description'],
            'commitment_description_rich' => $data['commitment_description_rich'],

            'foundation_heading'     => $data['foundation_heading'],
            'foundation_description' => $data['foundation_description'],
        ]);

        $imageFields = [
            'banner_image',
            'section_two_image_one',
            'section_two_image_two',
            'mission_image',
            'vision_image',
            'values_image',
            'commitment_image', // Added here
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($about->{$field}) {
                    Storage::disk('public')->delete($about->{$field});
                }
                $about->{$field} = $this->processAndStoreImage($request->file($field));
            }
        }

        $about->save();

        return redirect()
            ->route('admin.about')
            ->with('success', 'About Us page saved successfully.');
    }

     private function processAndStoreImage($file): string
    {
        $filename = 'about-us/' . Str::random(20) . '.webp';

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