<?php

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
Route::prefix("v1")->group(function () {
    Route::resource("/administrateurs", App\Http\Controllers\AdministrateurController::class);
    Route::post('search-admin', [App\Http\Controllers\AdministrateurController::class, 'search']);
    Route::resource("/societes", App\Http\Controllers\SocieteController::class);
    Route::post('search-societe', [App\Http\Controllers\SocieteController::class, 'search']);
    Route::resource("/employes", App\Http\Controllers\EmployeController::class);
    Route::post('search-employe', [App\Http\Controllers\EmployeController::class, 'search']);
    Route::resource("/history", App\Http\Controllers\OperationController::class);
    Route::resource("/invitation", App\Http\Controllers\InvitationController::class);
    Route::post("/accepter-invitation", [App\Http\Controllers\InvitationController::class, "accepter"]);
    Route::post('login-user', [App\Http\Controllers\AuthController::class, 'loginUser']);
});
