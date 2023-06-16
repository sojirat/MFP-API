<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{DropdownController};


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix' => 'dropdown'
], function () {
    Route::post('/province',            [DropdownController::class,        'province']);
    Route::post('/district',            [DropdownController::class,        'district']);
    Route::post('/sub_district',        [DropdownController::class,        'sub_district']);
    Route::post('/complaint_type',      [DropdownController::class,        'complaint_type']);
    Route::post('/status',              [DropdownController::class,        'status']);
});
