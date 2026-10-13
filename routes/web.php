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
use Illuminate\Support\Carbon;

// Home page - Laser Cleaning Website
Route::get('/', function () {
    $counts = Media::published()->selectRaw('category, count(*) as n')->groupBy('category')->pluck('n', 'category');
    $preview = Media::published()->byType('image')->orderByDesc('is_featured')->ordered()->limit(6)->get();

    return view('laser-home', compact('counts', 'preview'));
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
        'Disallow: /admin',
        'Disallow: /language/',
        '',
        'Sitemap: ' . route('sitemap'),
    ];

    return response(implode("\n", $lines))->header('Content-Type', 'text/plain');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $updated = Media::published()
        ->selectRaw('category, max(updated_at) as t')
        ->groupBy('category')
        ->pluck('t', 'category')
        ->map(fn ($t) => Carbon::parse($t));

    $galleryAt = $updated->max();
    $homeAt = collect([$galleryAt, Carbon::createFromTimestamp(filemtime(resource_path('views/laser-home.blade.php')))])
        ->filter()
        ->max();
    $day = fn ($t) => $t?->toDateString();

    $urls = [
        ['loc' => url('/'), 'lastmod' => $day($homeAt), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => route('gallery'), 'lastmod' => $day($galleryAt), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('gallery', ['category' => 'wood']), 'lastmod' => $day($updated->get('wood')), 'changefreq' => 'weekly', 'priority' => '0.6'],
        ['loc' => route('gallery', ['category' => 'stone']), 'lastmod' => $day($updated->get('stone')), 'changefreq' => 'weekly', 'priority' => '0.6'],
        ['loc' => route('gallery', ['category' => 'metal']), 'lastmod' => $day($updated->get('metal')), 'changefreq' => 'weekly', 'priority' => '0.6'],
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
