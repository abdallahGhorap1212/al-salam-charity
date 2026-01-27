<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CaseTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CaseController;
use App\Http\Controllers\Admin\AidDistributionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BoardMemberController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DonationRequestController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/about', [SiteController::class, 'about'])->name('site.about');
Route::get('/services', [SiteController::class, 'services'])->name('site.services');
Route::get('/services/{service:slug}', [SiteController::class, 'serviceShow'])->name('site.services.show');
Route::get('/news', [SiteController::class, 'news'])->name('site.news');
Route::get('/news/{news:slug}', [SiteController::class, 'newsShow'])->name('site.news.show');
Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
Route::post('/contact', [SiteController::class, 'contactStore'])->name('site.contact.store');
Route::get('/donations', [SiteController::class, 'donations'])->name('site.donations');
Route::post('/donations', [SiteController::class, 'donationsStore'])->name('site.donations.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('areas', AreaController::class)->except(['show']);
        Route::resource('case-types', CaseTypeController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::get('cases-export', [CaseController::class, 'exportExcel'])->name('cases.export');
        Route::get('cases-export-pdf', [CaseController::class, 'exportPdf'])->name('cases.export-pdf');
        Route::post('cases-import', [CaseController::class, 'import'])->name('cases.import');
        Route::get('cases/{case}/card', [CaseController::class, 'card'])->name('cases.card');
        Route::resource('cases', CaseController::class)->except(['show']);
        Route::get('distributions-export', [AidDistributionController::class, 'exportExcel'])->name('distributions.export');
        Route::get('distributions-export-pdf', [AidDistributionController::class, 'exportPdf'])->name('distributions.export-pdf');
        Route::resource('distributions', AidDistributionController::class)->only(['index', 'create', 'store']);

        Route::resource('news', NewsController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('board-members', BoardMemberController::class)->except(['show']);
        Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutController::class, 'update'])->name('about.update');
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::resource('donation-requests', DonationRequestController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    });
