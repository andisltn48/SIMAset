<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataAsetController;
use App\Http\Controllers\API\ManajemenRuanganController;
use App\Http\Controllers\API\ManajemenUnitController;
use App\Http\Controllers\API\PeminjamanController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/authenticate', [AuthController::class, 'not_authenticated'])->name('authenticate');

Route::group(['middleware' => ['auth:sanctum']], function(){ 
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum', 'cekroleapi:1,2,3']], function(){
    Route::get('/data-aset', [DataAsetController::class, 'index']);
    Route::post('/data-aset', [DataAsetController::class, 'store']);
    Route::get('/data-aset/{id}', [DataAsetController::class, 'detail']);
    Route::delete('/data-aset/{id}', [DataAsetController::class, 'destroy']);
    Route::put('/data-aset/{id}', [DataAsetController::class, 'update']);
    Route::post('/data-aset/import-excel', [DataAsetController::class, 'import_data']);
    
    Route::get('/data-ruangan', [ManajemenRuanganController::class, 'index']);
    Route::get('/data-ruangan/{id}', [ManajemenRuanganController::class, 'detail']);
    Route::post('/data-ruangan', [ManajemenRuanganController::class, 'store']);
    Route::put('/data-ruangan/{id}', [ManajemenRuanganController::class, 'update']);
    Route::delete('/data-ruangan/{id}', [ManajemenRuanganController::class, 'destroy']);

    Route::get('/data-unit', [ManajemenUnitController::class, 'index']);
    Route::get('/data-unit/{id}', [ManajemenUnitController::class, 'detail']);
    Route::put('/data-unit/{id}', [ManajemenUnitController::class, 'update']);
    Route::post('/data-unit', [ManajemenUnitController::class, 'store']);
    Route::delete('/data-unit/{id}', [ManajemenUnitController::class, 'destroy']);

    Route::get('/data-permintaan-peminjaman', [PeminjamanController::class, 'permintaan_peminjaman']);
    Route::get('/data-peminjaman', [PeminjamanController::class, 'peminjaman']);
    Route::get('/data-peminjaman/{id}', [PeminjamanController::class, 'detail']);
    Route::post('/confirm-permintaan/{no_permintaan}', [PeminjamanController::class, 'confirm_request']);
});

Route::group(['middleware' => ['auth:sanctum', 'cekroleapi:1,2']], function(){
    Route::get('/data-unit', [ManajemenUnitController::class, 'index']);
    Route::get('/data-unit/{id}', [ManajemenUnitController::class, 'detail']);
    Route::put('/data-unit/{id}', [ManajemenUnitController::class, 'update']);
    Route::post('/data-unit', [ManajemenUnitController::class, 'store']);
    Route::delete('/data-unit/{id}', [ManajemenUnitController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum', 'cekroleapi:1,2,4']], function(){
    Route::get('/data-permintaan-peminjaman', [PeminjamanController::class, 'permintaan_peminjaman']);
    Route::get('/data-peminjaman', [PeminjamanController::class, 'peminjaman']);
    Route::post('/data-peminjaman', [PeminjamanController::class, 'storepermintaan']);
    Route::get('/data-peminjaman/{id}', [PeminjamanController::class, 'detail']);
    Route::post('/confirm-permintaan/{no_permintaan}', [PeminjamanController::class, 'confirm_request']);
});
