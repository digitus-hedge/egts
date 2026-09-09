<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateRequest;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CertificateController extends Controller
{
    protected int $imageWidth = 400;
    protected int $imageHeight = 400;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $certificates = Certificate::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.certificate.list', compact('certificates', 'search', 'perPage'));
    }

    public function create()
    {
        $certificate = new Certificate();
        return view('admin.certificate.form', compact('certificate'));
    }

    public function store(CertificateRequest $request)
    {
        $data = $request->validated();

        $certificate = new Certificate();
        $certificate->title = $data['title'];
        $certificate->description = $data['description'] ?? null;
        $certificate->meta_title = $data['meta_title'] ?? null;
        $certificate->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            $certificate->image = $this->processAndStoreImage($request->file('image'));
        }

        $certificate->save();

        return redirect()
            ->route('admin.home.certificates')
            ->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.form', compact('certificate'));
    }

    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();

        $certificate->title = $data['title'];
        $certificate->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }
            $certificate->image = $this->processAndStoreImage($request->file('image'));
        }

        $certificate->save();

        return redirect()
            ->route('admin.home.certificates')
            ->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()
            ->route('admin.home.certificates')
            ->with('success', 'Certificate deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'certificates/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
