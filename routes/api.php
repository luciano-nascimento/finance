<?php

use App\Http\Controllers\Api\ExpensesController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\ResumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('expenses', ExpensesController::class);
Route::controller(ExpensesController::class)->group(function () {
    Route::get('/expenses/{year}/{month}', 'indexByYearAndMonth');
});

Route::apiResource('income', IncomeController::class);
Route::controller(IncomeController::class)->group(function () {
    Route::get('/income/{year}/{month}', 'indexByYearAndMonth');
});

Route::get('/resume/{year}/{month}', [ResumeController::class, 'getResumeByYearAndMonth']);