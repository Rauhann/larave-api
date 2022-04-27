<?php

/**
 * Dependencies
 */

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return response()->json(["message" => "on"], 200);
});
