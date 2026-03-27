<?php

use App\Http\Controllers\API\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.token')->group(function () {
    
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{user}', [UsersController::class, 'show']);
});

    
?>