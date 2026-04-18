<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::get('/', function () {
		// Calculate precise looping background arrays natively
		$animeLoop = \App\Models\Anime::inRandomOrder()->take(30)->get();
		$recentReviews = \App\Models\Review::with(['user.profile', 'anime'])->inRandomOrder()->take(15)->get();
		return view('index', compact('animeLoop', 'recentReviews'));
	})->name('index');
	Route::get('/login', function () {return view('login');})->name('login');
	Route::get('/register', function () {return view('register');})->name('register');
	Route::post('/login', [AuthController::class, 'login']);
	Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('MAL.auth')->group(function () {
	Route::get('/anime', [AnimeController::class, 'index'])->name('anime');
	Route::get('/anime/{title}', [AnimeController::class, 'show'])->name('anime.show');
	Route::post('/watchlist/{anime}', [\App\Http\Controllers\UserController::class, 'addWatchlist'])->name('watchlist.add');
	Route::post('/favorite/{anime}', [\App\Http\Controllers\UserController::class, 'addFavorite'])->name('favorite.add');
	Route::post('/review/{anime}', [\App\Http\Controllers\UserController::class, 'addReview'])->name('review.add');
	Route::post('/rating/{anime}', [\App\Http\Controllers\UserController::class, 'addRating'])->name('rating.add');
	Route::get('/home', function () {return view('home');})->name('home');
	Route::get('/profile/{username}', [\App\Http\Controllers\UserController::class, 'show'])->name('profile.show');
	Route::get('/profile/{username}/edit', [\App\Http\Controllers\UserController::class, 'editProfile'])->name('profile.edit');
	Route::post('/profile/{username}/edit', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
	Route::get('/profile/{username}/password/edit', [\App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
	Route::post('/profile/{username}/password/edit', [\App\Http\Controllers\PasswordController::class, 'update'])->name('password.update');
	
	Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'adminIndex'])->name('admin.users');
	Route::get('/admin/users/{username}/edit', [\App\Http\Controllers\UserController::class, 'adminEdit'])->name('admin.users.edit');
	Route::post('/admin/users/{username}/edit', [\App\Http\Controllers\UserController::class, 'adminUpdate'])->name('admin.users.update');

	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function () {
	return redirect()->route('index');
});