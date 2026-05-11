<?php
// routes/demo.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\Finance\FinanceDashboardController;
use App\Http\Controllers\Demo\Finance\IncomeController;
use App\Http\Controllers\Demo\Finance\ExpenseController;
use App\Http\Controllers\Demo\Water\WaterDashboardController;
use App\Http\Controllers\Demo\Water\CustomerController;
use App\Http\Controllers\Demo\Water\PaymentController;
use App\Http\Controllers\Demo\Blog\BlogDashboardController;
use App\Http\Controllers\Demo\Blog\PostController;
use App\Http\Controllers\Demo\Blog\CommentController;

Route::prefix('demo')
    ->name('demo.')
    ->middleware(['demo.init'])   // Sets up demo session ID
    ->group(function () {

        // ── FINANCE TRACKER ──────────────────────
        Route::prefix('finance')->name('finance.')->group(function () {
            Route::get('/', [FinanceDashboardController::class, 'index'])->name('index');
            Route::post('/income', [IncomeController::class, 'store'])->name('income.store');
            Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');
            Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');
            Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
        });

        // ── WATER DRUM TRACKER ───────────────────
        Route::prefix('water')->name('water.')->group(function () {
            Route::get('/', [WaterDashboardController::class, 'index'])->name('index');
            Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
            Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
            Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
            Route::patch('/payments/{id}/complete', [PaymentController::class, 'markComplete'])->name('payments.complete');
        });

        // ── FAMILY LINK BLOG ─────────────────────
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogDashboardController::class, 'index'])->name('index');
            Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
            Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
            Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
            Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
            Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
        });
    });