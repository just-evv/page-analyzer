<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
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




Route::match(['get', 'post'], '/', [UrlController::class, 'main']);

Route::match(['get', 'post'],'/url',[UrlController::class,'store']);

Route::get('/urls', function () {
    return view('urls');
})->name('url');


