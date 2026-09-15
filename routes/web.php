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
use App\Http\Controllers\MediaController;
use App\Models\Media;

// Home page - Laser Cleaning Website
Route::get('/', function () {
    $woodMedia = Media::published()->byCategory('wood')->featured()->ordered()->limit(4)->get();
    $stoneMedia = Media::published()->byCategory('stone')->featured()->ordered()->limit(4)->get();
    $metalMedia = Media::published()->byCategory('metal')->featured()->ordered()->limit(4)->get();
    
    return view('laser-home', compact('woodMedia', 'stoneMedia', 'metalMedia'));
})->name('home');

// Gallery Routes
Route::get('/gallery', [MediaController::class, 'gallery'])->name('gallery');
Route::get('/gallery/{category}', function (string $category) {
    return redirect()->route('gallery', ['category' => $category]);
})->whereIn('category', ['wood', 'stone', 'metal'])->name('gallery.category');

// Admin Media Routes
Route::middleware('auth')->group(function () {
    Route::resource('media', MediaController::class);
});

// Language switch
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Robots.txt
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /media',
        'Disallow: /login',
        '',
        'Sitemap: ' . route('sitemap'),
    ];

    return response(implode("\n", $lines))->header('Content-Type', 'text/plain');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => route('gallery'), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('gallery', ['category' => 'wood']), 'changefreq' => 'weekly', 'priority' => '0.6'],
        ['loc' => route('gallery', ['category' => 'stone']), 'changefreq' => 'weekly', 'priority' => '0.6'],
        ['loc' => route('gallery', ['category' => 'metal']), 'changefreq' => 'weekly', 'priority' => '0.6'],
    ];

    return response()
        ->view('sitemap', compact('urls'))
        ->header('Content-Type', 'text/xml');
})->name('sitemap');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Auth::routes();
