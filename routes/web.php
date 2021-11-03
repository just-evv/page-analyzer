<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


Route::get('/', [UrlController::class, 'index']);

Route::post('/', [UrlController::class,'store']);

Route::get('/urls/{id}', [UrlController::class, 'showOne'])->name('urls');

Route::get('/urls', [UrlController::class, 'showAll'])->name('allUrls');


