<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectsClientsBannerRequest;
use App\Models\ProjectsClientsBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectsClientsBannerController extends Controller
{
    protected int $imageWidth = 1600;
    protected int $imageHeight = 700;
    protected int $compressQuality = 70;

    public function index()
    {
        $projectsClientsBanner = ProjectsClientsBanner::first() ?? new ProjectsClientsBanner();
        return view('admin.projects-clients-banner.form', compact('projectsClientsBanner'));
    }

    public function store(ProjectsClientsBannerRequest $request)
    {
        $data = $request->validated();

        $banner = ProjectsClientsBanner::first() ?? new ProjectsClientsBanner();
        $banner->title = $data['title'] ?? null;
        $banner->content = $data['content'] ?? null;
        $banner->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->image = $this->processAndStoreImage($request->file('image'));
        }

        $banner->save();

        return redirect()
            ->route('admin.home.projects-clients.banner')
            ->with('success', 'Projects & Clients banner saved successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'projects-clients/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
