<?php

use Briofy\Meta\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('briofy-meta.routes.api.prefix').'/meta')
    ->middleware(config('briofy-meta.routes.api.middleware'))
    ->name(config('briofy-meta.routes.api.name'))->group(function () {
    Route::get('/', [ApiController::class, 'index'])->name('index');
    Route::get('/{id}', [ApiController::class, 'show'])->name('show');
    Route::post('/', [ApiController::class, 'store'])->name('create');
});
