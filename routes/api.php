<?php

use App\Http\Controllers\Api\CourseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseApiControlleri;

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

// Route::prefix('course')->group(function() {
// });
Route::get('v1/course/', [CourseApiController::class, 'course'])->name('api.course.query');
Route::get('v1/course/chapter/', [CourseApiController::class, 'chapter'])->name('api.course.chapter');