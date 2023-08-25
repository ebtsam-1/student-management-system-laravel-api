<?php

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SchoolClassController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use PHPUnit\Framework\TestStatus\Risky;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('school-classes', SchoolClassController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('exams', ExamController::class);
    Route::group(['prefix' => 'statistics'], function(){
        Route::post('/date-chart', [StatisticsController::class, 'dateChart']);
    });
});


