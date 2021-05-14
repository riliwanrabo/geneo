<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\PagesController::class, 'index']);
Route::get('/contact', [App\Http\Controllers\PagesController::class, 'contact']);
Route::post('/contact', [App\Http\Controllers\PagesController::class, 'store'])->middleware('throttle:web');
Route::post('/upload', [App\Http\Controllers\PagesController::class, 'uploadFile']);
