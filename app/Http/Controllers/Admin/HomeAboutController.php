<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeAboutRequest;
use App\Models\HomeAbout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeAboutController extends Controller
{
    protected int $imageWidth = 1000;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    /**
     * SHOW FORM — always the single About section (or empty model if none exists yet)
     */
    public function index()
    {
        $about = HomeAbout::first() ?? new HomeAbout();
        return view('admin.home-about.form', compact('about'));
    }

    /**
     * STORE — creates the About section if none exists, otherwise updates the existing one
     */
    public function store(HomeAboutRequest $request)
    {
        $data = $request->validated();

        $about = HomeAbout::first() ?? new HomeAbout();
        $about->title = $data['title'];
        $about->description = $data['description'];

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $this->processAndStoreImage($request->file('image'));
        }

        $about->save();

        return redirect()
            ->route('admin.home.about')
            ->with('success', 'About section saved successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'banners/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
