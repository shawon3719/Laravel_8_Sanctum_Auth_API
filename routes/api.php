<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', 'App\Http\Controllers\userController@userdata')->name('user.api');
});


Route::post('/users/store', 'App\Http\Controllers\Auth\registerController@store');
Route::post('/login', 'App\Http\Controllers\Auth\loginController@login')->name('login');