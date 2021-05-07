<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ReservationsController;

Route::apiResource('/shops', ShopsController::class);
Route::post('/register', [RegisterController::class, 'post']);
Route::post('/login', [LoginController::class, 'post']);
Route::post('/logout', [LogoutController::class, 'post']);
Route::get('/user/{id}', [UsersController::class, 'get']);
Route::post('/like', [LikesController::class, 'post']);
Route::delete('/like', [LikesController::class, 'delete']);
Route::get('shops/{id}/reservations', [ReservationsController::class, 'get']);
Route::post('shops/{id}/reservations', [ReservationsController::class, 'post']);
Route::delete('shops/{id}/reservations', [ReservationsController::class, 'delete']);
