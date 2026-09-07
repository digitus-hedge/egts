<?php

namespace App\Http\Controllers;

use App\Models\ContactBanner;

class ContactUsController extends Controller
{
    public function index()
    {
        $contactBanner = ContactBanner::first();

        return view('web.contact_us', compact('contactBanner'));
    }
}
