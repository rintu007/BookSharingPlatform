<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;

// API Routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('books', [BookController::class, 'shareBook']);
    Route::get('books/nearby', [BookController::class, 'getNearbyBooks']);
});


Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('users', [AdminController::class, 'viewAllUsers']);
    Route::get('books', [AdminController::class, 'viewAllBooks']);
    Route::delete('books/{id}', [AdminController::class, 'deleteBook']);
});
