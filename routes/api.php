<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
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

Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user',[AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/musics/search', [MusicController::class, 'search']);
    Route::post('/musics', [MusicController::class, 'store']);
    Route::get('/musics', [MusicController::class, 'index']);
    Route::get('/musics/{music}', [MusicController::class, 'show']);
    Route::put('/musics/{music}', [MusicController::class, 'update']);
    Route::delete('/musics/{music}', [MusicController::class, 'destroy']);
});
