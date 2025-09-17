<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
