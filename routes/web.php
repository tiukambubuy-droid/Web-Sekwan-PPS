<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\InformasiController;
use App\Models\Page;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | INFORMASI (HALAMAN HUB)
    |--------------------------------------------------------------------------
    */
    Route::get('/informasi', [InformasiController::class, 'index'])
        ->name('admin.informasi.index');

    /*
    |--------------------------------------------------------------------------
    | BERITA (CRUD FULL – DALAM INFORMASI)
    |--------------------------------------------------------------------------
    */
    Route::prefix('informasi')->name('admin.informasi.')->group(function () {
        Route::resource('berita', BeritaController::class)
            ->parameters(['berita' => 'berita']);
    });

    /*
    |--------------------------------------------------------------------------
    | MENU DINAMIS
    |--------------------------------------------------------------------------
    */
    Route::resource('menus', MenuController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('pages', PageController::class);
});

/*
|--------------------------------------------------------------------------
| FRONTEND DINAMIS PAGE
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('pages.dynamic', compact('page'));
});
