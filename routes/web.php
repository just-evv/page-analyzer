<?php

use App\Http\Controllers\UrlController;
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


Route::get('/', [UrlController::class, 'index'])->name('index');

Route::post('/', [UrlController::class,'store'])->name('urls.store');

Route::get('/urls/{id}', [UrlController::class, 'showOne'])->name('urls.show');

Route::get('/urls', [UrlController::class, 'showAll'])->name('urls.all');

Route::post('/urls/{id}/checks', [UrlController::class, 'checkUrl'])->name('urls.checks');
