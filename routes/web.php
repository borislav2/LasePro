<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\PublicResourceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;

// Home page - Laser Cleaning Website
Route::get('/', function () {
    return view('laser-home');
})->name('home');

// Language switch
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Auth::routes();
