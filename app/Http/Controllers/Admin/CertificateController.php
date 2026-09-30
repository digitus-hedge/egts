<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateRequest;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
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
        $certificate->title            = $data['title'];
        $certificate->description      = $data['description'] ?? null;
        $certificate->license_type     = $data['license_type'] ?? null;
        $certificate->meta_title       = $data['meta_title'] ?? null;
        $certificate->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            $certificate->image = $this->storeCertificateFile($request->file('image'));
        }

        $certificate->save();

        return $this->successResponse($request, 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.form', compact('certificate'));
    }

    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();

        $certificate->title            = $data['title'];
        $certificate->license_type     = $data['license_type'] ?? null;
        $certificate->description      = $data['description'] ?? null;
        $certificate->meta_title       = $data['meta_title'] ?? $certificate->meta_title;
        $certificate->meta_description = $data['meta_description'] ?? $certificate->meta_description;

        if ($request->hasFile('image')) {
            // New file uploaded: replace the old one
            $this->deleteFile($certificate->image);
            $certificate->image = $this->storeCertificateFile($request->file('image'));
        } elseif ($request->input('remove_image') === '1') {
            // Removed with no replacement (validation normally blocks this, kept as a safeguard)
            $this->deleteFile($certificate->image);
            $certificate->image = null;
        }

        $certificate->save();

        return $this->successResponse($request, 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $this->deleteFile($certificate->image);
        $certificate->delete();

        return redirect()
            ->route('admin.home.certificates')
            ->with('success', 'Certificate deleted successfully.');
    }

    /**
     * Save the certificate file (PDF / DOC / DOCX) without modifying it.
     */
    private function storeCertificateFile(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename  = Str::random(20) . '.' . $extension;

        return $file->storeAs('certificates', $filename, 'public');
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * JSON for the AJAX form, redirect for normal form submits.
     */
    private function successResponse(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message'  => $message,
                'redirect' => route('admin.home.certificates'),
            ]);
        }

        return redirect()
            ->route('admin.home.certificates')
            ->with('success', $message);
    }
}