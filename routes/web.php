<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\UserBookmarkController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterPageController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ManhwaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/manhwa', 'manhwa')->name('manhwa');
    Route::get('/manhwa/{manhwa:slug}', 'detail')
        ->name('manhwa.detail');
    Route::get('/chapter/read', 'chapter')->name('chapter.read');
    Route::get('/genre', 'genre')->name('genre');
    Route::get('/explore', 'explore')
        ->name('explore');
    Route::get('/search', 'search')
        ->name('search');
    Route::get('/populer', 'populer')->name('populer');
    Route::get('/latest', 'latest')->name('latest');
    Route::get('/404', 'notFaound')->name('404');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('admin');

        // Manhwa
        Route::get('/manhwa', [ManhwaController::class, 'index'])
            ->name('manhwa.index');
        Route::get('/manhwa/create', [ManhwaController::class, 'create'])
            ->name('manhwa.create');
        Route::post('/manhwa', [ManhwaController::class, 'store'])
            ->name('manhwa.store');
        Route::get('/manhwa/{manhwa}/edit', [ManhwaController::class, 'edit'])
            ->name('manhwa.edit');
        Route::put('/manhwa/{manhwa}', [ManhwaController::class, 'update'])
            ->name('manhwa.update');
        Route::delete('/manhwa/{manhwa}', [ManhwaController::class, 'destroy'])
            ->name('manhwa.destroy');

        // Genre
        Route::get('/genre', [GenreController::class, 'index'])
            ->name('genre.index');
        Route::get('/genre/create', [GenreController::class, 'create'])
            ->name('genre.create');
        Route::post('/genre', [GenreController::class, 'store'])
            ->name('genre.store');
        Route::get('/genre/{genre}/edit', [GenreController::class, 'edit'])
            ->name('genre.edit');
        Route::put('/genre/{genre}', [GenreController::class, 'update'])
            ->name('genre.update');
        Route::delete('/genre/{genre}', [GenreController::class, 'destroy'])
            ->name('genre.destroy');

        // Chapter
        Route::get('/chapter', [ChapterController::class, 'index'])
            ->name('chapter.index');
        Route::get('/chapter/create', [ChapterController::class, 'create'])
            ->name('chapter.create');
        Route::post('/chapter', [ChapterController::class, 'store'])
            ->name('chapter.store');
        Route::get('/chapter/{chapter}/edit', [ChapterController::class, 'edit'])
            ->name('chapter.edit');
        Route::put('/chapter/{chapter}', [ChapterController::class, 'update'])
            ->name('chapter.update');
        Route::delete('/chapter/{chapter}', [ChapterController::class, 'destroy'])
            ->name('chapter.destroy');

        // Chapter Pages
        Route::get('/chapter/{chapter}/pages', [ChapterPageController::class, 'index'])
            ->name('chapter.pages.index');
        Route::post('/chapter/{chapter}/pages', [ChapterPageController::class, 'store'])
            ->name('chapter.pages.store');
        Route::delete('/chapter-pages/{chapterPage}', [ChapterPageController::class, 'destroy'])
            ->name('chapter.pages.destroy');

        // Komentar
        Route::get('/komentar', [KomentarController::class, 'index'])
            ->name('komentar.index');
        Route::get('/komentar/{komentar}', [KomentarController::class, 'show'])
            ->name('komentar.detail');
        Route::patch('/komentar/{komentar}/toggle-status', [KomentarController::class, 'toggleStatus'])
            ->name('komentar.toggle-status');
        Route::delete('/komentar/{komentar}', [KomentarController::class, 'destroy'])
            ->name('komentar.destroy');

        // Bookmark
        Route::get('/bookmark', [BookmarkController::class, 'index'])
            ->name('bookmark.index');
        Route::delete('/bookmark/{bookmark}', [BookmarkController::class, 'destroy'])
            ->name('bookmark.destroy');

        // Riwayat
        Route::get('/riwayat', [RiwayatController::class, 'index'])
            ->name('riwayat.index');
        Route::delete('/riwayat/{riwayat}', [RiwayatController::class, 'destroy'])
            ->name('riwayat.destroy');

        // Users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('user.index');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])
            ->name('user.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('user.destroy');

        // Role User
        Route::get('/role-user', [RoleController::class, 'index'])
            ->name('admin.user.index');
        Route::post('/role-user', [RoleController::class, 'store'])
            ->name('admin.user.store');
        Route::put('/role-user/{role}', [RoleController::class, 'update'])
            ->name('admin.user.update');
        Route::delete('/role-user/{role}', [RoleController::class, 'destroy'])
            ->name('admin.user.destroy');

        // Hak Akses
        Route::get('/hak-akses', [HakAksesController::class, 'index'])
            ->name('admin.access.index');
        Route::put('/hak-akses/{role}', [HakAksesController::class, 'update'])
            ->name('admin.access.update');

        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('admin.log.index');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']) 
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::post('/manhwa/{manhwa:slug}/bookmark', [UserBookmarkController::class, 'toggle'])
        ->name('bookmark.toggle');
    Route::get('/library', [LibraryController::class, 'index'])
        ->name('library.index');
});

require __DIR__.'/auth.php';
