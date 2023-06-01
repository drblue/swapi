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

Route::apiResource('films', 'App\Http\Controllers\Api\FilmController');
Route::apiResource('people', 'App\Http\Controllers\Api\PersonController');
Route::apiResource('planets', 'App\Http\Controllers\Api\PlanetController');
Route::apiResource('species', 'App\Http\Controllers\Api\SpeciesController');
Route::apiResource('starships', 'App\Http\Controllers\Api\StarshipController');
Route::apiResource('vehicles', 'App\Http\Controllers\Api\VehicleController');
