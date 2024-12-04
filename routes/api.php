<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tasks/{id}', [TaskController::class, 'index']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::post('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    
    Route::get('/tags', [TagController::class, 'index']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});
