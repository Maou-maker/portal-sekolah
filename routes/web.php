<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Alihkan rute publik ke HomeController / ProfileController agar data database selalu terbaca
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/berita', [HomeController::class, 'berita'] ?? function () {
    $news = \App\Models\News::latest()->get();
    return view('berita', compact('news'));
})->name('berita');

Route::get('/media-sosial', [HomeController::class, 'mediaSosial'])->name('media-sosial');

Route::get('/berita/{id}', function ($id) {
    $newsItem = \App\Models\News::findOrFail($id);
    return view('berita-detail', compact('newsItem'));
})->name('berita.detail');

// Route Publik Profil & Direktori Guru
Route::get('/profil', [ProfileController::class, 'publicIndex'])->name('profil');
Route::get('/profil/guru', [ProfileController::class, 'publicTeachers'])->name('profil.guru');


/*
|--------------------------------------------------------------------------
| 2. ROUTE AUTHENTICATION (Login & Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 3. ROUTE ADMIN / BACKEND (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('news', NewsController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('socials', SocialMediaController::class);
    Route::resource('sections', SectionController::class);

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/teacher', [ProfileController::class, 'storeTeacher'])->name('teacher.store');
        Route::put('/teacher/{id}', [ProfileController::class, 'updateTeacher'])->name('teacher.update');
        Route::delete('/teacher/{id}', [ProfileController::class, 'destroyTeacher'])->name('teacher.destroy');

        Route::post('/vision', [ProfileController::class, 'storeVision'])->name('vision.store');
        Route::put('/vision/{id}', [ProfileController::class, 'updateVision'])->name('vision.update');
        Route::delete('/vision/{id}', [ProfileController::class, 'destroyVision'])->name('vision.destroy');

        Route::post('/program', [ProfileController::class, 'storeProgram'])->name('program.store');
        Route::put('/program/{id}', [ProfileController::class, 'updateProgram'])->name('program.update');
        Route::delete('/program/{id}', [ProfileController::class, 'destroyProgram'])->name('program.destroy');

        Route::post('/event', [ProfileController::class, 'storeEvent'])->name('event.store');
        Route::put('/event/{id}', [ProfileController::class, 'updateEvent'])->name('event.update');
        Route::delete('/event/{id}', [ProfileController::class, 'destroyEvent'])->name('event.destroy');
    });

});