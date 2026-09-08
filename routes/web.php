<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientSectionController;
use App\Http\Controllers\Admin\ContactBannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\HomeAboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\BehindTheSceneController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\ServicesListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [HomeController::class,'about']);

Route::get('/services', [ServicesListController::class, 'index']);
Route::get('/services/{slug}', [ServiceDetailController::class, 'show']);

Route::get('/facility_capabilities', function () {
    return view('web.facility_capabilities');
});

Route::get('/contact', [ContactUsController::class, 'index']);

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

        // Banner Section routes (singleton — one banner only)
        Route::get('home/banner', [BannerController::class, 'index'])->name('home.banner');       // Shows form directly (pre-filled if exists)
        Route::post('home/banner', [BannerController::class, 'store'])->name('home.banner.store'); // Creates or updates

        Route::get('home/about', [HomeAboutController::class, 'index'])->name('home.about');       // Shows form directly (pre-filled if exists)
        Route::post('home/about', [HomeAboutController::class, 'store'])->name('home.about.store'); // Creates or updates

        Route::get('home/stats', [StatController::class, 'index'])->name('home.stats');
        Route::post('home/stats', [StatController::class, 'store'])->name('home.stats.store');

        Route::get('home/service-section', [ServiceSectionController::class, 'index'])->name('home.services.section');       // Shows form directly (pre-filled if exists)
        Route::post('home/service-section', [ServiceSectionController::class, 'store'])->name('home.services.section.store'); // Creates or updates


        Route::get('home/services', [ServiceController::class, 'index'])->name('home.services');
        Route::get('home/services/create', [ServiceController::class, 'create'])->name('home.services.create');
        Route::post('home/services', [ServiceController::class, 'store'])->name('home.services.store');
        Route::get('home/services/{service}/edit', [ServiceController::class, 'edit'])->name('home.services.edit');
        Route::put('home/services/{service}', [ServiceController::class, 'update'])->name('home.services.update');
        Route::delete('home/services/{service}', [ServiceController::class, 'destroy'])->name('home.services.destroy');

        Route::get('home/clients', [ClientSectionController::class, 'index'])->name('home.clients');
        Route::post('home/clients', [ClientSectionController::class, 'store'])->name('home.clients.store');

        Route::get('home/why-choose-us', [WhyChooseUsController::class, 'index'])->name('home.why-choose-us');
        Route::post('home/why-choose-us', [WhyChooseUsController::class, 'store'])->name('home.why-choose-us.store');


        // routes/web.php (inside your admin route group with 'admin.' name prefix)

        Route::get('home/services/behind-the-scenes', [BehindTheSceneController::class, 'index'])->name('home.services.behind-the-scenes');
        Route::get('home/services/behind-the-scenes/create', [BehindTheSceneController::class, 'create'])->name('home.services.behind-the-scenes.create');
        Route::post('home/services/behind-the-scenes', [BehindTheSceneController::class, 'store'])->name('home.services.behind-the-scenes.store');
        Route::get('home/services/behind-the-scenes/{behind_the_scene}/edit', [BehindTheSceneController::class, 'edit'])->name('home.services.behind-the-scenes.edit');
        Route::put('home/services/behind-the-scenes/{behind_the_scene}', [BehindTheSceneController::class, 'update'])->name('home.services.behind-the-scenes.update');
        Route::delete('home/services/behind-the-scenes/{behind_the_scene}', [BehindTheSceneController::class, 'destroy'])->name('home.services.behind-the-scenes.destroy');



        Route::get('about', [AboutController::class, 'index'])->name('about');       // Shows form directly (pre-filled if exists)
        Route::post('about', [AboutController::class, 'store'])->name('about.store'); // Creates or updates

        Route::get('services', [DashboardController::class, 'services'])->name('services');

        Route::get('home/contact-banner', [ContactBannerController::class, 'index'])->name('home.contact-banner');
        Route::post('home/contact-banner', [ContactBannerController::class, 'store'])->name('home.contact-banner.store');

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
