<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.home');
});

Route::get('/about', function () {
    return view('web.about_us');
});

Route::get('/services', function () {
    return view('web.services');
});

Route::get('/services/api-threading-services', function () {
    return view('web.service_details');
});

Route::get('/facility_capabilities', function () {
    return view('web.facility_capabilities');
});

Route::get('/contact', function () {
    return view('web.contact_us');
});

Route::post('/contact/submit', function () {
    // handle form submission — validate, send email, save to DB, etc.
    return back()->with('success', 'Your message has been sent.');
});
