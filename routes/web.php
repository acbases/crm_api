<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Define your web routes here.
Route::post('/login', [UserController::class, 'login']);