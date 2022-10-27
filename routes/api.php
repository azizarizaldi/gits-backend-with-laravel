<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PublisherController;
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

Route::post('/auth/sign-in',[LoginController::class , 'login']);

Route::group(['prefix' => 'author'],function(){
    Route::get('/',[AuthorController::class , 'index']);
    Route::post('/store',[AuthorController::class , 'store']);
    Route::get('/{author}',[AuthorController::class , 'show']);
    Route::get('/delete/{author}',[AuthorController::class , 'delete']);
    Route::post('/update/{author}',[AuthorController::class , 'update']);
});

Route::group(['prefix' => 'book'],function(){
    Route::get('/',[BookController::class , 'index']);
    Route::post('/store',[BookController::class , 'store']);
    Route::get('/{book}',[BookController::class , 'show']);
    Route::get('/delete/{book}',[BookController::class , 'delete']);
    Route::post('/update/{book}',[BookController::class , 'update']);
});

Route::group(['prefix' => 'publisher'],function(){
    Route::get('/',[PublisherController::class , 'index']);
    Route::post('/store',[PublisherController::class , 'store']);
    Route::get('/{publisher}',[PublisherController::class , 'show']);
    Route::get('/delete/{publisher}',[PublisherController::class , 'delete']);
    Route::post('/update/{publisher}',[PublisherController::class , 'update']);
});