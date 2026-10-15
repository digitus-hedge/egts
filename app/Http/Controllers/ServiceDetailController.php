<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceDetailController extends Controller
{
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $relatedServices = Service::where('id', '!=', $service->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('web.service_details', compact('service', 'relatedServices'));
    }
}
