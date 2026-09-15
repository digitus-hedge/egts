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
        $contactBanner->company_name = $data['company_name'] ?? null;
        $contactBanner->description = $data['description'] ?? null;
        $contactBanner->address = $data['address'] ?? null;
        $contactBanner->phone = $data['phone'] ?? null;
        $contactBanner->email = $data['email'] ?? null;
        $contactBanner->working_hours = $data['working_hours'] ?? null;

        $contactBanner->admin_phone = $data['admin_phone'] ?? null;
        $contactBanner->admin_email = $data['admin_email'] ?? null;
        $contactBanner->qaqc_phone = $data['qa_qc_phone'] ?? null;
        $contactBanner->qaqc_email = $data['qa_qc_email'] ?? null;
        $contactBanner->operations_phone = $data['operations_phone'] ?? null;
        $contactBanner->operations_email = $data['operations_email'] ?? null;
        $contactBanner->sales_phone = $data['sales_phone'] ?? null;
        $contactBanner->sales_email = $data['sales_email'] ?? null;

        // ----- Banner Image -----
        if ($request->hasFile('image')) {
            if ($contactBanner->image) {
                Storage::disk('public')->delete($contactBanner->image);
            }
            $contactBanner->image = $this->processAndStoreImage($request->file('image'));

            // uploading a new image clears any existing video (mutually exclusive)
            if ($contactBanner->video) {
                Storage::disk('public')->delete($contactBanner->video);
                $contactBanner->video = null;
            }
        } elseif ($request->boolean('remove_image')) {
            if ($contactBanner->image) {
                Storage::disk('public')->delete($contactBanner->image);
            }
            $contactBanner->image = null;
        }

        // ----- Banner Video -----
        if ($request->hasFile('video')) {
            if ($contactBanner->video) {
                Storage::disk('public')->delete($contactBanner->video);
            }
            $contactBanner->video = $request->file('video')->store('contact-banner/videos', 'public');

            // uploading a new video clears any existing image (mutually exclusive)
            if ($contactBanner->image) {
                Storage::disk('public')->delete($contactBanner->image);
                $contactBanner->image = null;
            }
        } elseif ($request->boolean('remove_video')) {
            if ($contactBanner->video) {
                Storage::disk('public')->delete($contactBanner->video);
            }
            $contactBanner->video = null;
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
