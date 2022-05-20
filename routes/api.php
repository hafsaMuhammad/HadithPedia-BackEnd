<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChildHadithController;
use App\Http\Controllers\API\ClusterController;
use App\Http\Controllers\API\HadithController;
use App\Http\Controllers\API\HadithQuestionController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\UserController;
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

//public routes
Route::get('hadiths', [HadithController::class,'index']);
Route::get('hadiths/{id}',[HadithController::class,'show']);
Route::get('categories', [CategoryController::class,'index']);
Route::get('categories/{id}',[CategoryController::class,'show']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('categoryHadiths/{id}',[CategoryController::class,'categoryHadiths']);
Route::apiResource('ChildHadith', ChildHadithController::class);



//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    
    Route::post('hadiths',[HadithController::class,'store']);
    Route::put('hadiths/{id}',[HadithController::class,'update']);
    Route::delete('hadiths/{id}',[HadithController::class,'destroy']);

    Route::post('categories',[CategoryController::class,'store']);
    Route::put('categories/{id}',[CategoryController::class,'update']);
    Route::delete('categories/{id}',[CategoryController::class,'destroy']);
    Route::post('categoryAttach/{categoryId}/{hadithId}',[CategoryController::class,'categoryAttach']);


    Route::apiResource('hadithQuestions', HadithQuestionController::class);
    Route::apiResource('levels', LevelController::class);
    Route::apiResource('clusters', ClusterController::class);

    //user routes
    Route::get('users',[UserController::class,'index']);
    Route::get('displayImage/{userId}',[UserController::class,'displayImage']);
    Route::get('favorites/{id}',[UserController::class,'favorites']);
    Route::post('logout',[UserController::class,'logout']);
    Route::post('uploadPhoto/{id}',[UserController::class,'uploadPhoto']);
    Route::post('attachHadith/{userId}/{hadithId}',[UserController::class,'attachHadith']);
    Route::post('detachHadith/{userId}/{hadithId}',[UserController::class,'detachHadith']);
});
