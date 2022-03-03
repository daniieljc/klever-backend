<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('students', \App\Http\Controllers\API\StudentController::class);
Route::apiResource('marks', \App\Http\Controllers\API\MarkController::class);
Route::get('reports/lower', [\App\Http\Controllers\API\ReportsController::class, 'markLower']);
Route::get('reports/order', [\App\Http\Controllers\API\ReportsController::class, 'order']);
Route::apiResource('reports', \App\Http\Controllers\API\ReportsController::class);
