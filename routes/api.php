<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiShortUrlController;
use App\Http\Controllers\Api\AutenticarController;

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

Route::post('/register', [AutenticarController::class, 'register']);
Route::post('/login',    [AutenticarController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::post('/logout',           [AutenticarController::class, 'logout']);

    Route::post('/generate-code',   [ApiShortUrlController::class, 'generateCode']);
    Route::post('/get-url',         [ApiShortUrlController::class, 'getUrl']);
    Route::post('/delete-url',      [ApiShortUrlController::class, 'deleteUrl']);

});
