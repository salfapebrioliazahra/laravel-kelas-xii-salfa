<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
    AuthController,
};

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');
Route::post('/movies/{film}/comments', [App\Http\Controllers\KritikController::class, 'store'])->middleware('auth')->name('comments.store');

Route::get('/login', function () {
    return redirect()->route('home')->with('open_login_modal', true);
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('films', App\Http\Controllers\Admin\FilmController::class);
    Route::resource('casts', App\Http\Controllers\Admin\CastController::class);
    Route::resource('genres', App\Http\Controllers\Admin\GenreController::class);
    Route::resource('perans', App\Http\Controllers\Admin\PeranController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('kritiks', App\Http\Controllers\Admin\KritikController::class)->only(['index', 'edit', 'update', 'destroy']);
});
