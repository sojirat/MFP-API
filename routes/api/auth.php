<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Non Auth
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/test', [AuthController::class, 'testUseAuth']);

// Auth
Route::group([
    'middleware' => ['jwt.verify'],
    'prefix' => 'auth'
], function () {
    Route::get('/user', [AuthController::class, 'getUserByToken']);
    Route::delete('/logout', [AuthController::class, 'logoutUser']);
    Route::post('/test', [AuthController::class, 'testUseAuth']);
});

// Clear application cache:
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

//Clear config cache:
Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return 'Config cache has been cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});
