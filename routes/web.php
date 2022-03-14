<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestItemController;
use App\Http\Controllers\TransactionController;
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

Route::group(['prefix' => 'user'], function (){
    Route::get('/login', [UserController::class, 'view_login']);
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::group(['middleware' => 'LoggedIn'], function (){
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('transaction', TransactionController::class)->only(['index', 'store']);
});

// Route::group(['middleware' => 'user'], function (){
//     Route::resource('/request', RequestItemController::class)->only(['index', 'store']);
// });

Route::resource('/request', RequestItemController::class)->only(['index', 'store', 'create']);


Route::group(['prefix' => 'admin', 'middleware' => 'superuser'], function (){
    Route::resource('item', ItemController::class);
    Route::resource('request', RequestItemController::class);
    Route::resource('transaction', TransactionController::class);
});

