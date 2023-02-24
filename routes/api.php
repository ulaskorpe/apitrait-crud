<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\UsController;
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

	//Route::get('users',[\App\Http\Controllers\UserController::class,'index']);


	//Route::resource('users', UsController::class);

/**
 * Countries API Routes
 */
Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/{id}', [CountryController::class, 'show']);
    Route::post('/', [CountryController::class, 'create']);
    Route::patch('/{id}', [CountryController::class, 'update']);
    Route::delete('/{id}', [CountryController::class, 'delete']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UsController::class, 'index']);
    Route::get('/{id}', [UsController::class, 'show']);
    Route::post('/', [UsController::class, 'create']);
    Route::patch('/{id}', [UsController::class, 'update']);
    Route::delete('/{id}', [UsController::class, 'delete']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
