<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\LitterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StationController;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

// Resources
Route::resource('animals', AnimalController::class);
Route::resource('stations', StationController::class);
Route::resource('litters', LitterController::class);

// Dashboard
Route::redirect('/home', '/');
Route::get('/', function () {
    return view('home');
})->name('home');

// Search
Route::get('/search', [SearchController::class, 'search']);

Route::middleware('auth')->group(static function(): void {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});
