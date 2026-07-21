<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portfolio\HomeController;
use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\ContactController;


Route::get('/health', function () {
    return response()->json([
        'status'   => 'ok',
        'app_key'  => config('app.key') ? 'set' : 'MISSING',
        'db'       => function_exists('app') ? 'checking' : 'unknown',
    ]);
});
// =============================================
// PUBLIC PORTFOLIO ROUTES
// =============================================

Route::get('/', function () {
    return view('portfolio.home');
})->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/demos', [HomeController::class, 'demos'])->name('demos');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/cv/download', [PortfolioController::class, 'downloadCv'])->name('cv.download');

// Load auth routes (login/logout from Breeze)
require __DIR__.'/auth.php';

// Load admin routes
require __DIR__.'/admin.php';

// Load demo routes
require __DIR__.'/demo.php';