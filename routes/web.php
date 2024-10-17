<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\Sample\SampleController;
use App\Http\Middleware\HelloMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello/{id}', [HelloController::class, 'index'])->where('id', '[0-9]+');
// Route::get('/hello/{person}', [HelloController::class, 'index']);

Route::middleware([HelloMiddleware::class])->group(function () {
    // Route::get('/hello/other', [HelloController::class, 'other']);
});

Route::get('/hello', [HelloController::class, 'index'])->name('hello');
Route::get('/hello/other', [HelloController::class, 'other']);
Route::get('/sample', [SampleController::class, 'index'])->name('sample');
