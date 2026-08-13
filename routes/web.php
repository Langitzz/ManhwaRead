<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/manhwa', 'manhwa')->name('manhwa');
    Route::get('/manhwa/detail', 'detail')->name('manhwa.detail');
    Route::get('/chapter/read', 'chapter')->name('chapter.read');
    Route::get('/genre', 'genre')->name('genre');
    Route::get('/populer', 'populer')->name('populer');
    Route::get('/latest', 'latest')->name('latest');
    Route::get('/404', 'notFaound')->name('404');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])
            ->name('admin');
        Route::view('/manhwa', 'admin.manhwa')
            ->name('manhwa.index');
        Route::view('/manhwa/create', 'admin.manhwa-create')
            ->name('manhwa.create');
        Route::view('/genre', 'admin.genre')
            ->name('genre.index');
        Route::view('/genre/create', 'admin.genre-create')
            ->name('genre.create');
        Route::view('/chapter', 'admin.chapter')
            ->name('chapter.index');
        Route::view('/chapter/create', 'admin.chapter-create')
            ->name('chapter.create');
        Route::view('/aktivitas', 'admin.aktivitas')
            ->name('aktivitas.index');
        Route::view('/komentar', 'admin.komentar')
            ->name('komentar.index');
        Route::view('/komentar/detail', 'admin.komentar-detail')
            ->name('komentar.detail');
        Route::view('/bookmark', 'admin.bookmark')
            ->name('bookmark.index');
        Route::view('/riwayat', 'admin.riwayat')
            ->name('riwayat.index');
        Route::view('/users', 'admin.users')
            ->name('user.index');
        Route::view('/role-user', 'admin.role-user')
            ->name('admin.user.index');
        Route::view('/hak-akses', 'admin.hak-akses')
            ->name('admin.access.index');
        Route::view('/log-aktivitas', 'admin.log-aktivitas')
            ->name('admin.log.index');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
