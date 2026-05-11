<?php
// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CvController;
use App\Http\Controllers\Admin\MessageController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])   // Must be logged in AND be admin
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Projects CRUD
        Route::resource('projects', ProjectController::class);

        // Skills CRUD
        Route::resource('skills', SkillController::class);

        // CV Management
        Route::get('cv', [CvController::class, 'index'])->name('cv.index');
        Route::post('cv', [CvController::class, 'upload'])->name('cv.upload');
        Route::delete('cv/{cv}', [CvController::class, 'destroy'])->name('cv.destroy');

        // Messages (contact form submissions)
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });