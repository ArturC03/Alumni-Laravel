<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\FollowerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
