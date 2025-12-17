<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskListController;
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('lists', TaskListController::class);

});


