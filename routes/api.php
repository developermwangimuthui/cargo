<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\OrderController;
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
Route::prefix('v1')->group(function () {
    Route::post('/newlogin', [UserAuthController::class, 'userLogin']);
    Route::post('/newregister', [UserAuthController::class, 'registerUser']);
    Route::post('/verifyEmail', [UserAuthController::class, 'verifyEmail']);
    Route::post('/forgotpassword', [UserAuthController::class, 'forgot_password']);
    Route::post('tokenconnfrm', [UserAuthController::class, 'token_connfrm']);
    Route::post('/changePassword', [UserAuthController::class, 'changePassword']);


    Route::group(['middleware' => 'auth:carriers'], function () {
        Route::post('/carrier-updateprofle', [UserAuthController::class,'updateProfile']);
        Route::get('/find-cargo', [OrderController::class,'findCargo']);
        Route::get('/fetch-cargos', [OrderController::class,'fetchCargos']);
        Route::get('/fetch-orders', [OrderController::class,'fetchOrders']);
        Route::post('/upload-order/{id}/photos', [OrderController::class,'uploadOrderPhotos']);
        Route::post('/match-sender-code', [OrderController::class,'matchSenderCode']);
        Route::post('/add-addition-notes', [OrderController::class,'addAdditionNotes']);
    });
    Route::group(['middleware' => 'auth:customers'], function () {
        Route::post('/customer-updateprofle', [UserAuthController::class,'updateProfile']);
    });
});
