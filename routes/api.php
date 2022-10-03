<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Route::get('/categories', [CategoryController::class, 'index']);        +
// Route::post('/categories', [CategoryController::class, 'store']);       +
// Route::get('/categories/{id}', [CategoryController::class, 'show']);    +
// Route::put('/categories/{id}', [CategoryController::class, 'update']);  +
// Route::delete('/categories/{id}', [CategoryController::class, 'delete']); +

Route::resource('/categories', CategoryController::class);
