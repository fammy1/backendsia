<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/records/search', [RecordController::class, 'search']);
    Route::post('/records', [RecordController::class, 'store']);
    Route::get('/records', [RecordController::class, 'index']);
    Route::get('/records/{record}', [RecordController::class, 'show']);
    Route::put('/records/{record}', [RecordController::class, 'update']);
    Route::delete('/records/{record}', [RecordController::class, 'destroy']);
});
