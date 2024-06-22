<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\LitterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StationController;
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
if (app()->environment('local')) {
    Route::post('dev-login', [LoginController::class, 'devLogin'])->name('dev-login');
}

// Resources
Route::resource('animals', AnimalController::class);
Route::prefix('animals/{animal}')->name('animals.')->group(function () {
    Route::prefix('files')->name('files.')->group(function () {
        Route::get('pedigree', [AnimalController::class, 'filePedigree'])->name('pedigree');
    });
})->where(['animal' => '\d+']);

Route::resource('stations', StationController::class);
Route::resource('litters', LitterController::class);


// Dashboard
Route::redirect('/home', '/');
Route::get('/', function () {
    return view('home');
})->name('home');

// Search
Route::get('/search', [SearchController::class, 'search']);

Route::middleware('auth')->group(static function (): void {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

// Autocomplete
Route::get('/autocomplete', [AutocompleteController::class, 'autocomplete']);
