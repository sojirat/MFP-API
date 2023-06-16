<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{ComplaintController};


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix' => 'complaint'
], function () {
    Route::post('/index',       [ComplaintController::class,        'index']);
    Route::post('/create',      [ComplaintController::class,        'create']);
    Route::post('/update',      [ComplaintController::class,        'update']);
    Route::post('/destroy',     [ComplaintController::class,        'destroy']);
});
