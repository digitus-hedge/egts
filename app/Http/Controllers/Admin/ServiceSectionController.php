<?php
// app/Http/Controllers/Admin/ServiceSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceSectionRequest;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $serviceSections = ServiceSection::query()
            ->when($search, function ($query, $search) {
                $query->where('heading', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.service_section.list', compact('serviceSections', 'search', 'perPage'));
    }

    public function create()
    {
        $serviceSection = new ServiceSection();
        return view('admin.service_section.form', compact('serviceSection'));
    }

    public function store(ServiceSectionRequest $request)
    {
        ServiceSection::create($request->validated());

        return redirect()
            ->route('admin.home.services.section')
            ->with('success', 'Service section created successfully.');
    }

    public function edit(ServiceSection $service_section)
    {
        return view('admin.service_section.form', ['serviceSection' => $service_section]);
    }

    public function update(ServiceSectionRequest $request, ServiceSection $service_section)
    {
        $service_section->update($request->validated());

        return redirect()
            ->route('admin.home.services.section')
            ->with('success', 'Service section updated successfully.');
    }

    public function destroy(ServiceSection $service_section)
    {
        $service_section->delete();

        return redirect()
            ->route('admin.home.services.section')
            ->with('success', 'Service section deleted successfully.');
    }
}