<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;

Route::prefix('admin')->group(function () {
   Route::get('login', [AuthController::class, 'index'])->name('login');
   Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::prefix('admin')->middleware('auth:web')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('admin.index');
});
