<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\HomeAboutController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\ServiceController;

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


Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login)
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('home', [DashboardController::class, 'home'])->name('home');

        // Banner CRUD routes
        Route::get('home/banner', [BannerController::class, 'index'])->name('home.banner');                     // List page
        Route::get('home/banner/create', [BannerController::class, 'create'])->name('home.banner.create');       // Create form
        Route::post('home/banner', [BannerController::class, 'store'])->name('home.banner.store');               // Save new
        Route::get('home/banner/{banner}/edit', [BannerController::class, 'edit'])->name('home.banner.edit');    // Edit form
        Route::put('home/banner/{banner}', [BannerController::class, 'update'])->name('home.banner.update');     // Save edit
        Route::delete('home/banner/{banner}', [BannerController::class, 'destroy'])->name('home.banner.destroy'); // Delete

        Route::get('home/about', [HomeAboutController::class, 'index'])->name('home.about');
        Route::get('home/about/create', [HomeAboutController::class, 'create'])->name('home.about.create');
        Route::post('home/about', [HomeAboutController::class, 'store'])->name('home.about.store');
        Route::get('home/about/{home_about}/edit', [HomeAboutController::class, 'edit'])->name('home.about.edit');
        Route::put('home/about/{home_about}', [HomeAboutController::class, 'update'])->name('home.about.update');
        Route::delete('home/about/{home_about}', [HomeAboutController::class, 'destroy'])->name('home.about.destroy');

        Route::get('home/stats', [StatController::class, 'index'])->name('home.stats');
        Route::get('home/stats/create', [StatController::class, 'create'])->name('home.stats.create');
        Route::post('home/stats', [StatController::class, 'store'])->name('home.stats.store');
        Route::get('home/stats/{stat}/edit', [StatController::class, 'edit'])->name('home.stats.edit');
        Route::put('home/stats/{stat}', [StatController::class, 'update'])->name('home.stats.update');
        Route::delete('home/stats/{stat}', [StatController::class, 'destroy'])->name('home.stats.destroy');

        Route::get('home/service-section', [ServiceSectionController::class, 'index'])->name('home.services.section');
        Route::get('home/service-section/create', [ServiceSectionController::class, 'create'])->name('home.services.section.create');
        Route::post('home/service-section', [ServiceSectionController::class, 'store'])->name('home.services.section.store');
        Route::get('home/service-section/{service_section}/edit', [ServiceSectionController::class, 'edit'])->name('home.services.section.edit');
        Route::put('home/service-section/{service_section}', [ServiceSectionController::class, 'update'])->name('home.services.section.update');
        Route::delete('home/service-section/{service_section}', [ServiceSectionController::class, 'destroy'])->name('home.services.section.destroy');


        Route::get('home/services', [ServiceController::class, 'index'])->name('home.services');
        Route::get('home/services/create', [ServiceController::class, 'create'])->name('home.services.create');
        Route::post('home/services', [ServiceController::class, 'store'])->name('home.services.store');
        Route::get('home/services/{service}/edit', [ServiceController::class, 'edit'])->name('home.services.edit');
        Route::put('home/services/{service}', [ServiceController::class, 'update'])->name('home.services.update');
        Route::delete('home/services/{service}', [ServiceController::class, 'destroy'])->name('home.services.destroy');

        Route::get('about', [DashboardController::class, 'about'])->name('about');
        Route::get('services', [DashboardController::class, 'services'])->name('services');
        Route::get('contacts', [DashboardController::class, 'contacts'])->name('contacts');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
