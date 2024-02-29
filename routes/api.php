<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\TaskController;
use App\Http\Controllers\AuthController;
use app\Http\Controllers\Controller;
use app\Http\Controllers\UserSstoriesController;
use App\Http\Controllers\ProjectsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('projects', [ProjectsController::class,'index']);

Route::post('register',[AuthController::class,'register']);

Route::post('login',[AuthController::class,'login']);



Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('projects', [ProjectsController::class,'create']);
    Route::get('projects', [ProjectsController::class,'index']);
    Route::post('logout',[AuthController::class,'logout']);
    
});