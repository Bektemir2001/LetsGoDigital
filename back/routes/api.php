<?php

use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\Instruction\InstructionController;
use App\Http\Controllers\API\Lawyer\LawyerController;
use App\Http\Controllers\API\Question\CommentController;
use App\Http\Controllers\API\Question\LikeController;
use App\Http\Controllers\API\Question\QuestionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('/auth', App\Http\Controllers\API\AuthController::class);

Route::group(['prefix' => 'category'], function (){
    Route::post('/create', [CategoryController::class, 'store']);
    Route::get('/get/all', [CategoryController::class, 'getAll']);
    Route::get('/get/{category}', [CategoryController::class, 'get']);
});

Route::group(['prefix' => 'instruction'], function (){
    Route::post('/create', [InstructionController::class, 'store']);
    Route::get('/get/all', [InstructionController::class, 'getAll']);
    Route::get('/get/{instruction}', [InstructionController::class, 'get']);
    Route::get('/get/by/category/{category}', [InstructionController::class, 'getByCategory']);
    Route::post('/search', [InstructionController::class, 'search']);
    Route::get('/document', [InstructionController::class, 'document']);
});

Route::group(['prefix' => 'question'], function (){
    Route::post('/create', [QuestionController::class, 'store']);
    Route::get('/get/all', [QuestionController::class, 'getAll']);
    Route::get('/get/{question}', [QuestionController::class, 'get']);
    Route::get('/get/by/category/{category}', [QuestionController::class, 'getByCategory']);
    Route::get('/get/by/user/{user}', [QuestionController::class, 'getByUser']);

    Route::group(['prefix' => 'like'], function (){
        Route::post('/create', [LikeController::class, 'store']);
        Route::get('/get/by/question/{question}/{user}', [LikeController::class, 'getByQuestion']);
        Route::delete('/delete', [LikeController::class, 'delete']);

    });
    Route::group(['prefix' => 'comment'], function (){
        Route::post('/create', [CommentController::class, 'store']);
        Route::get('/get/by/question/{question}', [CommentController::class, 'getByQuestion']);
        Route::delete('/delete', [CommentController::class, 'delete']);

    });
});

Route::group(['prefix' => 'lawyer'], function (){
    Route::post('/create/{user}', [LawyerController::class, 'store']);
});

Route::group(['prefix' => 'chat'], function (){
    Route::post('/query', [ChatController::class, 'query']);
});

Route::get('/get/user/{user}', [UserController::class, 'get']);


