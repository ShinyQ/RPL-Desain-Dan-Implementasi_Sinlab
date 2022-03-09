<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
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

Route::get('auth/callback', [GoogleProviderController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleProviderController::class, 'handleCallback']);

Route::get('/', function () {
    $title = "Halaman Awal";
    return view('index', compact('title'));
});

Route::group(['prefix' => 'user'], function (){
    Route::get('/login', [UserController::class, 'view_login']);
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::resource('item', ItemController::class);


