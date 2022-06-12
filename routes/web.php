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

Route::group(['prefix' => 'admin', 'middleware' => 'superuser'], function () {
    //export route
    Route::get('transaction/export_pdf', [TransactionController::class, 'export_pdf'])->name('export_pdf');
    Route::get('item/export_pdf', [ItemController::class, 'export_pdf'])->name('export_pdf');
    Route::get('request/export_pdf', [RequestItemController::class, 'export_pdf'])->name('export_pdf');

    //another normal route
    Route::resource('item', ItemController::class);
    Route::resource('request', RequestItemController::class);
    Route::resource('transaction', TransactionController::class);
    Route::get('user', [UserController::class, 'index']);
    Route::get('update_role/{id}/{role}', [UserController::class, 'update_role']);
    
    Route::get('export', [TransactionController::class, 'export_index']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [UserController::class, 'view_login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/user/{id}', [UserController::class, 'update']);
});

Route::group(['middleware' => 'LoggedIn'], function () {
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('item', ItemController::class);
    Route::resource('transaction', TransactionController::class)->only(['index', 'store', 'create', 'show','update']);
});

Route::resource('/request', RequestItemController::class)->only(['index', 'store', 'create']);
