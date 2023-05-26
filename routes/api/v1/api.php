<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\KeyController;
use App\Http\Controllers\Api\KeyLogController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\WorkerController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->controller(WorkerController::class)->prefix('/workers')->group(function () {
    Route::post('add', 'addWorker');
    Route::get('', 'allWorkers');
    Route::put('{workerId}', 'updateWorker');
    Route::post('upload-image', 'upload');
});

Route::middleware('auth:sanctum')->controller(DepartmentController::class)->prefix('/departments')->group(function () {
    Route::post('add', 'addWorker');
    Route::get('', 'allDepartments');
    Route::put('{workerId}', 'updateWorker');
    Route::post('upload-image', 'upload');
});

Route::middleware('auth:sanctum')->controller(KeyController::class)->prefix('/keys')->group(function () {
    Route::post('', 'store');
    Route::get('', 'allKeys');
    Route::delete('{keyId}', 'delete');
    Route::put('{keyId}', 'update');
});

Route::middleware('auth:sanctum')->controller(KeyLogController::class)->prefix('/key-logs')->group(function () {
    Route::post('pick', 'pickKey');
    Route::post('drop', 'dropKey');
    Route::get('', 'keyLogs');
});

Route::middleware('auth:sanctum')->controller(DashboardController::class)->prefix('dashboard')->group(function () {
    Route::get('items', 'index');
});