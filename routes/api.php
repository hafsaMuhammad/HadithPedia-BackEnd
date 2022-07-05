<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChildHadithController;
use App\Http\Controllers\API\ClusterController;
use App\Http\Controllers\API\HadithController;
use App\Http\Controllers\API\HadithQuestionController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\UserController;
use App\Models\ChildHadith;
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

//hadith routes
Route::get('hadiths', [HadithController::class,'index']);
Route::get('hadiths/{id}',[HadithController::class,'show']);

//categories routes
Route::get('categories', [CategoryController::class,'index']);
Route::get('categories/{id}',[CategoryController::class,'show']);
Route::get('categoryHadiths/{id}',[CategoryController::class,'categoryHadiths']);

//child hadith routes
Route::get('ChildHadith', [ChildHadithController::class,'index']);
Route::get('ChildHadith/{id}',[ChildHadithController::class,'show']);

//user routes
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);



//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //hadith routes
    Route::post('hadiths',[HadithController::class,'store']);
    Route::put('hadiths/{id}',[HadithController::class,'update']);
    Route::delete('hadiths/{id}',[HadithController::class,'destroy']);
    Route::get('hadithsQuestion/{id}',[HadithController::class,'hadithsQuestion']);


    //categories routes
    Route::post('categories',[CategoryController::class,'store']);
    Route::put('categories/{id}',[CategoryController::class,'update']);
    Route::delete('categories/{id}',[CategoryController::class,'destroy']);
    Route::post('categoryAttach/{categoryId}/{hadithId}',[CategoryController::class,'categoryAttach']);

    //hadith questions
    Route::apiResource('hadithQuestions', HadithQuestionController::class);


    //level routes
    Route::apiResource('levels', LevelController::class);
    Route::get('levelHadiths/{id}',[LevelController::class,'levelHadiths']);
    Route::get('levelQuestions/{id}',[LevelController::class,'levelQuestions']);
    Route::get('insertLevel', [HadithQuestionController::class,'insertLevel']);


    //cluster routes
    Route::apiResource('clusters', ClusterController::class);
    Route::get('clusterHadiths/{id}',[ClusterController::class,'clusterHadiths']);
    Route::get('insertData', [ClusterController::class,'insertData']);

    //child hadiths routes
    Route::post('ChildHadith',[ChildHadithController::class,'store']);
    Route::put('ChildHadith/{id}',[ChildHadithController::class,'update']);
    Route::delete('ChildHadith/{id}',[ChildHadithController::class,'destroy']);
    Route::post('ChildHadith/truncate', [ChildHadithController::class, 'truncate']);
    Route::get('ChildHadith/getImages', [ChildHadithController::class, 'getImages']);


    //user routes
    Route::get('users',[UserController::class,'index']);
    Route::get('displayImage/{userId}',[UserController::class,'displayImage']);
    Route::get('favorites/{id}',[UserController::class,'favorites']);
    Route::get('grades/{id}',[UserController::class,'grades']);
    Route::post('logout',[UserController::class,'logout']);
    Route::post('uploadPhoto/{id}',[UserController::class,'uploadPhoto']);
    Route::post('attachHadith/{userId}/{hadithId}',[UserController::class,'attachHadith']);
    Route::post('detachHadith/{userId}/{hadithId}',[UserController::class,'detachHadith']);
    Route::post('attachGrade/{userId}/{levelId}',[UserController::class,'attachGrade']);
});
