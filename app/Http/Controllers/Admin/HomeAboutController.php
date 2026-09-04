<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeAboutRequest;
use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class HomeAboutController extends Controller
{
    protected int $imageWidth = 1000;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $abouts = HomeAbout::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.home-about.list', compact('abouts', 'search', 'perPage'));
    }

    public function create()
    {
        $about = new HomeAbout();
        return view('admin.home-about.form', compact('about'));
    }

    public function store(HomeAboutRequest $request)
    {
        $data = $request->validated();

        $about = new HomeAbout();
        $about->title = $data['title'];
        $about->description = $data['description'];

        if ($request->hasFile('image')) {
            $about->image = $this->processAndStoreImage($request->file('image'));
        }

        $about->save();

        return redirect()
            ->route('admin.home.about')
            ->with('success', 'About section created successfully.');
    }

    public function edit(HomeAbout $home_about)
    {
        return view('admin.home-about.form', ['about' => $home_about]);
    }

    public function update(HomeAboutRequest $request, HomeAbout $home_about)
    {
        $data = $request->validated();

        $home_about->title = $data['title'];
        $home_about->description = $data['description'];

        if ($request->hasFile('image')) {
            if ($home_about->image) {
                Storage::disk('public')->delete($home_about->image);
            }
            $home_about->image = $this->processAndStoreImage($request->file('image'));
        }

        $home_about->save();

        return redirect()
            ->route('admin.home.about')
            ->with('success', 'About section updated successfully.');
    }

    public function destroy(HomeAbout $home_about)
    {
        if ($home_about->image) {
            Storage::disk('public')->delete($home_about->image);
        }

        $home_about->delete();

        return redirect()
            ->route('admin.home.about')
            ->with('success', 'About section deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'home-about/' . Str::random(20) . '.webp';

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}