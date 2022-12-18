<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;

Route::prefix('admin')->middleware('auth:web')->group(function() {
    Route::resource('product', ProductsController::class)->except(['show']);
});
