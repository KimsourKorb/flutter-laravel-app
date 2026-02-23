<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    UniversityController,
    MajorController,
    FavoriteController,
    SearchController
};

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/universities', [UniversityController::class, 'index']);
    Route::get('/universities/{id}', [UniversityController::class, 'show']);
    Route::get('/majors', [MajorController::class, 'index']);
    Route::get('/majors/{id}', [MajorController::class, 'show']);
    Route::get('/search', [SearchController::class, 'search']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        Route::put('/user/profile', [AuthController::class, 'updateProfile']);
        
        Route::get('/favorites', [FavoriteController::class, 'index']);
        Route::post('/favorites', [FavoriteController::class, 'store']);
        Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
    });
});