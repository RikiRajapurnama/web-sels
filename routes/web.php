<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\OrderStepController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\SalesProfileController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/daftar', [HomeController::class, 'storeLead'])->name('leads.store');

Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware(['admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('promos', PromoController::class)->except(['show']);
        Route::patch('promos/{promo}/toggle', [PromoController::class, 'toggle'])->name('promos.toggle');

        Route::resource('packages', PackageController::class)->except(['show']);
        Route::patch('packages/{package}/toggle', [PackageController::class, 'toggle'])->name('packages.toggle');

        Route::resource('banners', BannerController::class)->except(['show']);
        Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');

        Route::resource('benefits', BenefitController::class)->except(['show']);
        Route::patch('benefits/{benefit}/toggle', [BenefitController::class, 'toggle'])->name('benefits.toggle');

        Route::resource('order-steps', OrderStepController::class)->except(['show'])->parameters(['order-steps' => 'step']);
        Route::patch('order-steps/{step}/toggle', [OrderStepController::class, 'toggle'])->name('order-steps.toggle');

        Route::resource('service-areas', ServiceAreaController::class)->except(['show'])->parameters(['service-areas' => 'area']);
        Route::patch('service-areas/{area}/toggle', [ServiceAreaController::class, 'toggle'])->name('service-areas.toggle');

        Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
        Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
        Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
        Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

        Route::get('sales-profile', [SalesProfileController::class, 'edit'])->name('sales-profile.edit');
        Route::put('sales-profile', [SalesProfileController::class, 'update'])->name('sales-profile.update');

        Route::get('contact', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('account', [AccountController::class, 'edit'])->name('account.edit');
        Route::put('account', [AccountController::class, 'updateProfile'])->name('account.update');
        Route::put('account/password', [AccountController::class, 'updatePassword'])->name('account.password');
    });
});
