<?php

use App\Http\Controllers\API\UserController;
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


Route::get('/users', [UserController::class, 'index'])->name('api.users');
Route::get('/users/{user}', [UserController::class, 'show'])->name('api.users.show');
Route::patch('/users/{user}', [UserController::class, 'update'])->name('api.users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.users.delete');



//TODO:: This would have been used to get the authenticated user. But Authentication is not implemented
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
