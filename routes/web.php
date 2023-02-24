<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
Route::get('/', [AdminController::class, 'home'])->name('dashboard-home');

/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

Route::get('redirect', [AdminController::class, 'redirect'])->name('redirect');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::post('informasi_add', [AdminController::class, 'informasi_add'])->name('informasi-add-admin');
        Route::get('kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan-admin');
        Route::post('kegiatan_add', [AdminController::class, 'kegiatan_add'])->name('kegiatan-add-admin');

        Route::get('pengunduran', [AdminController::class, 'pengunduran'])->name('pengunduran-admin');
        Route::get('pengunduran_data', [AdminController::class, 'pengunduran_data'])->name('pengunduran-data-admin');
        Route::post('pengunduran_update', [AdminController::class, 'pengunduran_update'])->name('pengunduran-update-admin');

        Route::get('anggota', [AdminController::class, 'anggota'])->name('anggota-admin');
        Route::get('anggota_data', [AdminController::class, 'anggota_data'])->name('anggota-data-admin');
        Route::post('anggota_update', [AdminController::class, 'anggota_update'])->name('anggota-update-admin');
        Route::post('anggota_first', [AdminController::class, 'anggota_first'])->name('anggota-first-admin');
        Route::get('anggota/delete/{id}', [AdminController::class, 'anggota_delete'])->name('anggota-delte-data-admin');

        Route::get('keluhan', [AdminController::class, 'keluhan'])->name('keluhan-admin');
        Route::get('keluhan_data', [AdminController::class, 'keluhan_data'])->name('keluhan-data-admin');
        Route::post('keluhan_update', [AdminController::class, 'keluhan_update'])->name('keluhan-update-admin');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('kegiatan', [PenggunaController::class, 'kegiatan'])->name('kegiatan-user');
        
        Route::get('pengunduran', [PenggunaController::class, 'pengunduran'])->name('pengunduran-user');
        Route::get('pengunduran_data', [PenggunaController::class, 'pengunduran_data'])->name('pengunduran-data-user');
        Route::post('pengunduran_add', [PenggunaController::class, 'pengunduran_add'])->name('pengunduran-add-user');

        Route::get('keluhan', [PenggunaController::class, 'keluhan'])->name('keluhan-user');
        Route::get('keluhan_data', [PenggunaController::class, 'keluhan_data'])->name('keluhan-data-user');
        Route::post('keluhan_add', [PenggunaController::class, 'keluhan_add'])->name('keluhan-add-user');
    });
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin');
    Route::get('/user', [PenggunaController::class, 'dashboard'])->name('dashboard-user');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
