<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelfController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubMemberController;
use App\Http\Controllers\ClubReadingLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingLogController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Bookshelves
// BookShelf Routes
Route::middleware(['auth'])->group(function () {

    Route::prefix('bookshelves')->name('bookshelves.')->group(function () {
        Route::get('/', [BookShelfController::class, 'index'])->name('index');
        Route::get('/create', [BookShelfController::class, 'create'])->name('create');
        Route::post('/', [BookShelfController::class, 'store'])->name('store');
        Route::get('/{id}', [BookShelfController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BookShelfController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BookShelfController::class, 'update'])->name('update');
        Route::delete('/{id}', [BookShelfController::class, 'destroy'])->name('destroy');
        Route::post('/{shelf_id}/books', [BookshelfController::class, 'addBook'])->name('shelves.books.add');
        Route::delete('/{shelf_id}/books/{book_id}', [BookshelfController::class, 'removeBook'])->name('shelves.books.remove');

        // Reading Logs within a specific shelf
        Route::get('/{shelf_id}/logs/create', [ReadingLogController::class, 'create'])->name('logs.create');
        Route::post('/{shelf_id}/logs', [ReadingLogController::class, 'store'])->name('logs.store');
    });

    // Reading Logs
// Reading Log Routes
    Route::prefix('reading-logs')->name('reading_logs.')->group(function () {
        Route::post('/', [ReadingLogController::class, 'store'])->name('logs.store');
        Route::get('/{id}/edit', [ReadingLogController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ReadingLogController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReadingLogController::class, 'destroy'])->name('destroy');
    });

    // Book Routes
// Books Management
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/search', [BookController::class, 'search'])->name('search');
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{id}', [BookController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BookController::class, 'update'])->name('update');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
        Route::post('/{book}/status', [BookController::class, 'updateStatus'])->name('status');
        Route::post('/{book}/progress', [BookController::class, 'updateProgress'])->name('progress');
    });

    // Reading Statistics
    Route::prefix('stats')->group(function () {
        Route::get('/', [ReadingStatsController::class, 'index'])->name('stats.index');
        Route::get('/yearly', [ReadingStatsController::class, 'yearlyHeatmap'])->name('stats.yearly');
        Route::get('/monthly', [ReadingStatsController::class, 'monthlyDetails'])->name('stats.monthly');
        Route::get('/insights', [ReadingStatsController::class, 'insights'])->name('stats.insights');
    });

    // Club routes
    Route::resource('clubs', ClubController::class)->except(['create', 'edit']);
    Route::get('clubs/{club}/members', [ClubMemberController::class, 'index'])->name('clubs.members.index');
    Route::post('clubs/{club}/members', [ClubMemberController::class, 'store'])->name('clubs.members.store');
    Route::delete('clubs/{club}/members/{user}', [ClubMemberController::class, 'destroy'])->name('clubs.members.destroy');

    // Club Book routes
    Route::resource('club-books', ClubBookController::class)->except(['create', 'edit']);

    // Club Reading Log routes
    Route::resource('club-reading-logs', ClubReadingLogController::class)->except(['create', 'edit']);

    // Club Leaderboard routes
    Route::get('club-leaderboards/{club}', [ClubLeaderboardController::class, 'show'])->name('club-leaderboards.show');

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// Public Routes
Route::get('/books/public/{book}', [BookController::class, 'publicShow'])->name('books.public.show');

require __DIR__.'/auth.php';
