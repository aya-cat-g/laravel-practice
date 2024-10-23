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
Route::post('/hello', [HelloController::class, 'index']);
Route::get('/hello/other', [HelloController::class, 'other']);
Route::get('/sample', [SampleController::class, 'index'])->name('sample');

Route::get('/hello/get', [HelloController::class, 'get'])->name('hello.get');
Route::get('/hello/put/{msg}', [HelloController::class, 'put'])->name('hello.put');

Route::get('/hello/getpub', [HelloController::class, 'getPublic'])->name('hello.getPub');
Route::get('/hello/putpub/{msg}', [HelloController::class, 'putPublic'])->name('hello.putPub');
Route::get('/hello/download', [HelloController::class, 'download'])->name('hello.download');
Route::post('/hello/upload', [HelloController::class, 'upload'])->name('hello.upload');

Route::get('/hello/service/{id}', [HelloController::class, 'service'])->name('hello.service');
Route::get('/hello/serviceset', [HelloController::class, 'serviceSet'])->name('hello.service.set');
Route::get('/hello/usefacade', [HelloController::class, 'useFacade'])->name('hello.useFacade');
