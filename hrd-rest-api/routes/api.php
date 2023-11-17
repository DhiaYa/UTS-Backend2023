<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// HRD

Route::middleware(['auth:sanctum'])->group(function () {
    // membuat route dengan method get all pegawai
    Route::get('employess', [PegawaiController::class,'index']);

    // membuat route dengan method post  
    Route::post('/employess', [PegawaiController::class,'store']);

    // membuat route dengan method put
    Route::put('/employess/{id}', [PegawaiController::class,'update']);

    // membuat route dengan method delete
    Route::delete('/employess/{id}', [PegawaiController::class,'destroy']);

    // mendapatkan detail pegawai
    Route::get('/employess/{id}', [PegawaiController::class,'show']);

});

// route untuk login dan register
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
