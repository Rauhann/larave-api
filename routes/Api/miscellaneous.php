<?php

/**
 * Dependencies
 */

use Illuminate\Support\Facades\Route;

/**
 * Routes
 */

use App\Http\Controllers\User\GetUsersController;


Route::get('users', GetUsersController::class);
