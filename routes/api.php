<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ReservationsController;


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);
Route::get('/users/{id}', [UsersController::class, 'getUser']);
Route::get('/shops',[ShopsController::class, 'getShops']);
Route::get('/shops/{id}', [ShopsController::class, 'getShop']);
Route::post('/shops/{id}/likes', [LikesController::class, 'postLike']);
Route::delete('/shops/{id}/likes', [LikesController::class, 'deleteLike']);
Route::get('/users/{id}/likes', [LikesController::class, 'getLikes']);
Route::post('/shops/{id}/reservations', [ReservationsController::class, 'postReservation']);
Route::delete('/shops/{id}/reservations', [ReservationsController::class, 'deleteReservation']);
Route::get('/users/{id}/reservations', [ReservationsController::class, 'getReservations']);