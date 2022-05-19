<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\HadithQuestionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('hadiths', HadithController::class);
Route::get('hadiths/edit/{id}', [HadithController::class, 'edit']);
Route::resource('hadithQuestions', HadithQuestionController::class);
Route::get('/linkstorage', function () { Artisan::call('storage:link');});