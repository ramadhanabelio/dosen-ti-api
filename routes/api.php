<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LecturerController;

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

Route::get('/prodi', [LecturerController::class, 'getProdiList']);
Route::get('/lecturers/{prodi}', [LecturerController::class, 'getLecturersByProdi']);
Route::get('/research-by-lecturer/{id}', [LecturerController::class, 'getResearchByLecturerId']);

Route::post('/login', [LecturerController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [LecturerController::class, 'me']);
    Route::put('/profile', [LecturerController::class, 'updateProfile']);
    Route::get('/research', [LecturerController::class, 'getMyResearch']);
    Route::post('/research', [LecturerController::class, 'addResearch']);
    Route::put('/research/{id}', [LecturerController::class, 'updateResearch']);
    Route::delete('/research/{id}', [LecturerController::class, 'deleteResearch']);
});
