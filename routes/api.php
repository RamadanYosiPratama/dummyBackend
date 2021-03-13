<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\CovidsController;
use App\Http\Controllers\API\VaksinController;
use App\Http\Controllers\API\KhitanController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\CovidItemsTransaksiController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\Api\Payment\XenditController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);
    Route::post('checkout', [TransactionController::class, 'checkout']);
    Route::get('transactionCovidItem', [CovidItemsTransaksiController::class, 'all']);
    Route::post('transactionCovidItem/{id}', [CovidItemsTransaksiController::class, 'update']);
    Route::post('checkoutCovidItem', [CovidItemsTransaksiController::class, 'checkout']);
    Route::post('checkoutCovidItemVaksin', [CovidItemsTransaksiController::class, 'checkoutVaksin']);
    Route::post('checkoutCovidItemKhitan', [CovidItemsTransaksiController::class, 'checkoutKhitan']);
    Route::post('checkoutCovidItem{id}', [CovidItemsTransaksiController::class, 'update']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('food', [FoodController::class, 'all']);
Route::get('product', [CovidsController::class, 'all']);
Route::get('khitan', [KhitanController::class, 'all']);
Route::get('vaksin', [VaksinController::class, 'all']);
// Route::get('product', [ProductController::class, 'all']);
Route::post('midtrans/callback', [MidtransController::class, 'callback']);
// Route::get('xendit/va/list', 'Api\Payment\XenditController@getListVal');
// Route::get('xendit/va/invoice', 'Api\Payment\XenditController@createVa');
Route::get('xendit/va/list', [XenditController::class, 'getListVal']);
Route::post('xendit/va/invoice', [XenditController::class, 'createVa']);
