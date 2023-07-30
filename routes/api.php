<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_production;

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
Route::group(['middleware' => 'api.key'], function () {
    // Hanya izinkan rute untuk menambah data (Create) dan menampilkan semua data (Read)
    Route::apiResource('production', c_production::class)->only(['store', 'index']);

    // Izinkan rute untuk menampilkan data tertentu (Read) dengan tampilan detail
    Route::get('production/{id}', [c_production::class, 'show']);
});