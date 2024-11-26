<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KodeWilayah\ConKodeWilayah;
use App\Http\Controllers\Api\ListPerumahan\ConPerumahan;

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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['as' => 'api.', 'prefix' => '/'],  function () {
    //--------------------------------------------------------------------------
    //  Routes Kode Wilayah
    //--------------------------------------------------------------------------
    Route::group(['as' => 'kd_wilayah.', 'prefix' => '/kd_wilayah'],  function () {
        Route::get('/getDesa_byKd_kecamatan/{byKd_kecamatan?}', [ConKodeWilayah::class, 'getDesa_byKd_kecamatan'])->name('getDesa_byKd_kecamatan');
    });

    //--------------------------------------------------------------------------
    //  Routes List Perumahan
    //--------------------------------------------------------------------------
    Route::group(['as' => 'perumahan.', 'prefix' => '/perumahan'],  function () {
        Route::get('/getPerumahan_byKd_Kec_Desa/{byKd_kecamatan?}/{byKd_desa?}', [ConPerumahan::class, 'getPerumahan_byKd_Kec_Desa'])->name('getPerumahan_byKd_Kec_Desa');
        Route::get('/getPerumahan_byNm_perumahan/{nm_perumahan?}', [ConPerumahan::class, 'getPerumahan_byNm_perumahan'])->name('getPerumahan_byNm_perumahan');
        Route::get('/getPerumahan_byId/{id_perumahan?}', [ConPerumahan::class, 'getPerumahan_byId'])->name('getPerumahan_byId');
    });
});
