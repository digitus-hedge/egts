<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{
    protected int $imageWidth = 600;
    protected int $imageHeight = 500;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $services = Service::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.service.list', compact('services', 'search', 'perPage'));
    }

    public function create()
    {
        $service = new Service();
        return view('admin.service.form', compact('service'));
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        $service = new Service();
        $this->fillService($service, $data, $request);
        $service->save();

        return redirect()
            ->route('admin.home.services')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.service.form', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $this->fillService($service, $data, $request);
        $service->save();

        return redirect()
            ->route('admin.home.services')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        foreach ($service->gallery ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }

        $service->delete();

        return redirect()
            ->route('admin.home.services')
            ->with('success', 'Service deleted successfully.');
    }

    // private function fillService(Service $service, array $data, Request $request): void
    // {
    //     $service->title = $data['title'];
    //     $service->slug = Str::slug($data['title']);
    //     $service->description = $data['description'];
    //     $service->process_description = $data['process_description'] ?? null;

    //     $service->technical_scope = collect($data['technical_scope'] ?? [])
    //         ->filter(fn ($v) => trim((string) $v) !== '')
    //         ->values()
    //         ->all();

    //     $service->specifications = collect($data['specifications'] ?? [])
    //         ->filter(fn ($row) => !empty($row['specification']) || !empty($row['details']) || !empty($row['compliance']))
    //         ->values()
    //         ->all();


    //     if ($request->hasFile('image')) {
    //         if ($service->image) {
    //             Storage::disk('public')->delete($service->image);
    //         }
    //         $service->image = $this->processAndStoreImage($request->file('image'));
    //     }

    //     if ($request->hasFile('gallery')) {
    //         $existingGallery = $service->gallery ?? [];
    //         foreach ($request->file('gallery') as $file) {
    //             if (count($existingGallery) >= 3) break;
    //             $existingGallery[] = $this->processAndStoreImage($file);
    //         }
    //         $service->gallery = array_values($existingGallery);
    //     }


    //     if ($request->filled('remove_gallery')) {
    //         $toRemove = $request->input('remove_gallery');
    //         $currentGallery = $service->gallery ?? [];

    //         foreach ($toRemove as $path) {
    //             Storage::disk('public')->delete($path);
    //         }

    //         $service->gallery = array_values(array_diff($currentGallery, $toRemove));
    //     }
    // }

    private function fillService(Service $service, array $data, Request $request): void
    {
        $service->title = $data['title'];
        $service->slug = Str::slug($data['title']);
        $service->description = $data['description'];
        $service->process_description = $data['process_description'] ?? null;

        $service->meta_title = $data['meta_title'] ?? null;
        $service->meta_description = $data['meta_description'] ?? null;


        $service->technical_scope = collect($data['technical_scope'] ?? [])
            ->filter(fn($v) => trim((string) $v) !== '')
            ->values()
            ->all();

        $service->specifications = collect($data['specifications'] ?? [])
            ->filter(fn($row) => !empty($row['specification']) || !empty($row['details']) || !empty($row['compliance']))
            ->values()
            ->all();

        // ===== Hero image =====
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $this->processAndStoreImage($request->file('image'));
        }

        if ($request->hasFile('banner_image')) {
            if ($service->banner_image) {
                Storage::disk('public')->delete($service->banner_image);
            }
            $service->banner_image = $this->processAndStoreImage($request->file('banner_image'));
        }

        // ===== Gallery: handle removals FIRST, then additions =====
        $currentGallery = $service->gallery ?? [];

        // Remove images the admin marked for deletion
        if ($request->filled('remove_gallery')) {
            $toRemove = $request->input('remove_gallery');

            foreach ($toRemove as $path) {
                Storage::disk('public')->delete($path);
            }

            $currentGallery = array_values(array_diff($currentGallery, $toRemove));
        }

        // Add new uploads, capped so total never exceeds 6
        if ($request->hasFile('gallery')) {
            $slotsAvailable = max(0, 6 - count($currentGallery));

            foreach ($request->file('gallery') as $index => $file) {
                if ($index >= $slotsAvailable) break; // enforce max 6 total
                $currentGallery[] = $this->processAndStoreImage($file);
            }
        }

        // If gallery ends up empty, store null instead of an empty array (optional, matches your "set to null" request)
        $service->gallery = count($currentGallery) > 0 ? array_values($currentGallery) : null;
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'services/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
