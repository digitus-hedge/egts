<?php
// app/Http/Controllers/Admin/ServiceController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

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
            ->orderBy('sort_order')
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
        $service->title = $data['title'];
        $service->description = $data['description'];
        $service->content = $data['content'] ?? null;
        $service->sort_order = $data['sort_order'] ?? 0;
        $service->status = $data['status'] ?? 0;

        if ($request->hasFile('image')) {
            $service->image = $this->processAndStoreImage($request->file('image'));
        }

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

        $service->title = $data['title'];
        $service->description = $data['description'];
        $service->content = $data['content'] ?? null;
        $service->sort_order = $data['sort_order'] ?? 0;
        $service->status = $data['status'] ?? 0;

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $this->processAndStoreImage($request->file('image'));
        }

        $service->save();

        return redirect()
            ->route('admin.home.services')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('admin.home.services')
            ->with('success', 'Service deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'services/' . Str::random(20) . '.webp';

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}