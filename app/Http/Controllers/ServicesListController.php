<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesListController extends Controller
{
    public function index()
    {
        $services = Service::get();

        return view('web.services', compact('services'));
    }
}
