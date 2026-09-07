<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactBannerRequest;
use App\Models\ContactBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ContactBannerController extends Controller
{
    protected int $imageWidth = 1600;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    /**
     * SHOW FORM — always the single Contact banner (or empty model if none exists yet)
     */
    public function index()
    {
        $contactBanner = ContactBanner::first() ?? new ContactBanner();
        return view('admin.contact-banner.form', compact('contactBanner'));
    }

    /**
     * STORE — creates the Contact banner if none exists, otherwise updates the existing one
     */
    public function store(ContactBannerRequest $request)
    {
        $data = $request->validated();

        $contactBanner = ContactBanner::first() ?? new ContactBanner();
        $contactBanner->title = $data['title'];
        $contactBanner->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($contactBanner->image) {
                Storage::disk('public')->delete($contactBanner->image);
            }
            $contactBanner->image = $this->processAndStoreImage($request->file('image'));
        }

        $contactBanner->save();

        return redirect()
            ->route('admin.home.contact-banner')
            ->with('success', 'Contact Us banner saved successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'contact-banner/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
