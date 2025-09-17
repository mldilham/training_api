<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [ControllersUserController::class, 'index'])->name('users.index');
Route::get('/users/export', [ControllersUserController::class, 'export'])->name('users.export');
