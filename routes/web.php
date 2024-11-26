<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\beranda\ConBeranda;
use App\Http\Controllers\Frontend\listperumahan\ConListPerumahan;
use App\Http\Controllers\Frontend\tentang\ConTentang;

use App\Http\Controllers\Backend\auth\ConbeAuth;
use App\Http\Controllers\Backend\beranda\ConbeBeranda;
use App\Http\Controllers\Backend\masterdata\users\ConbeUsers;
use App\Http\Controllers\Backend\masterdata\pengembang\ConbePengembang;
use App\Http\Controllers\Backend\masterdata\perumahan\ConbePerumahan;
use App\Http\Controllers\Backend\profile\ConbeProfile;
use App\Http\Controllers\Backend\data_psu\permohonan\ConbePermohonanPSU;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| FrontEnd Routes
|--------------------------------------------------------------------------
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ConBeranda::class, 'index'])->name('index');

Route::group(['as' => 'fe.', 'prefix' => '/'],  function () {
    Route::get('/list_perumahan', [ConListPerumahan::class, 'index'])->name('list_perumahan');
    Route::get('/tentang', [ConTentang::class, 'index'])->name('tentang');
});


/*
|--------------------------------------------------------------------------
| BackEnd Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'auth.', 'prefix' => '/'],  function () {
    Route::get('/login', [ConbeAuth::class, 'index_login'])->name('login');
    Route::post('/act_login', [ConbeAuth::class, 'act_login'])->name('act_login');
    Route::get('/act_logout', [ConbeAuth::class, 'act_logout'])->name('act_logout');
});

Route::group(['as' => 'be.', 'prefix' => '/be', 'middleware' => 'AuthSecurity'],  function () {
    Route::get('/beranda', [ConbeBeranda::class, 'index'])->name('beranda');

    //--------------------------------------------------------------------------
    //  Routes Profile
    //--------------------------------------------------------------------------
    Route::group(['as' => 'profile.', 'prefix' => '/profile'],  function () {
        //View Index
        Route::get('/akun', [ConbeProfile::class, 'index_akun'])->name('akun');

         //action edit
         Route::post('/act_edit_akun', [ConbeProfile::class, 'act_edit_akun'])->name('act_edit_akun');
    });

    //--------------------------------------------------------------------------
    //  Routes PSU Data
    //--------------------------------------------------------------------------
    Route::group(['as' => 'psu.', 'prefix' => '/psu'],  function () {
        Route::group(['as' => 'permohonan.', 'prefix' => '/permohonan'],  function () {
            //View Index
            Route::get('/index', [ConbePermohonanPSU::class, 'index'])->name('index');
            Route::get('/index_tambah_permohonan', [ConbePermohonanPSU::class, 'index_tambah_permohonan'])->name('index_tambah_permohonan');
            Route::get('/index_edit_permohonan/{id_permohonan_psu?}', [ConbePermohonanPSU::class, 'index_edit_permohonan'])->name('index_edit_permohonan');

            //action tambah
            Route::post('/act_tambah_permohonan_psu', [ConbePermohonanPSU::class, 'act_tambah_permohonan_psu'])->name('act_tambah_permohonan_psu');
            //action edit
            Route::post('/act_edit_permohonan_psu', [ConbePermohonanPSU::class, 'act_edit_permohonan_psu'])->name('act_edit_permohonan_psu');
            Route::post('/act_edit_status_permohonan_psu', [ConbePermohonanPSU::class, 'act_edit_status_permohonan_psu'])->name('act_edit_status_permohonan_psu');
            //action hapus
            Route::post('/act_hapus_permohonan_psu', [ConbePermohonanPSU::class, 'act_hapus_permohonan_psu'])->name('act_hapus_permohonan_psu');
            
        }); 
    });

    //--------------------------------------------------------------------------
    //  Routes Master Data
    //--------------------------------------------------------------------------
    Route::group(['as' => 'masterdata.', 'prefix' => '/masterdata'],  function () {
        // Route Data Pengembang
        Route::group(['as' => 'pengembang.', 'prefix' => '/pengembang'],  function () {
            //View Index
            Route::get('/semua_pengembang', [ConbePengembang::class, 'index_semua_pengembang'])->name('semua_pengembang');
            
            //action tambah
            Route::post('/act_tambah_pengembang', [ConbePengembang::class, 'act_tambah_pengembang'])->name('act_tambah_pengembang');
            //action edit
            Route::post('/act_edit_pengembang', [ConbePengembang::class, 'act_edit_pengembang'])->name('act_edit_pengembang');
            //action hapus
            Route::post('/act_hapus_pengembang', [ConbePengembang::class, 'act_hapus_pengembang'])->name('act_hapus_pengembang');
        });

        // Route Data Perumahan
        Route::group(['as' => 'perumahan.', 'prefix' => '/perumahan'],  function () {
            //View Index
            Route::get('/semua_perumahan', [ConbePerumahan::class, 'index_semua_perumahan'])->name('semua_perumahan');
            Route::get('/tambah_perumahan', [ConbePerumahan::class, 'index_tambah_perumahan'])->name('tambah_perumahan');
            Route::get('/edit_perumahan/{id_perumahan?}', [ConbePerumahan::class, 'index_edit_perumahan'])->name('edit_perumahan');
            
            //action tambah
            Route::post('/act_tambah_perumahan', [ConbePerumahan::class, 'act_tambah_perumahan'])->name('act_tambah_perumahan');
            //action edit
            Route::post('/act_edit_perumahan', [ConbePerumahan::class, 'act_edit_perumahan'])->name('act_edit_perumahan');
            //action hapus
            Route::post('/act_hapus_perumahan', [ConbePerumahan::class, 'act_hapus_perumahan'])->name('act_hapus_perumahan');
            
        });

        // Route Data Users
        Route::group(['as' => 'users.', 'prefix' => '/users'],  function () {
            //View Index
            Route::get('/role_users', [ConbeUsers::class, 'index_role_users'])->name('role_users');
            Route::get('/semua_users', [ConbeUsers::class, 'index_semua_users'])->name('semua_users');

            //action tambah
            Route::post('/act_tambah_role_users', [ConbeUsers::class, 'act_tambah_role_users'])->name('act_tambah_role_users');
            Route::post('/act_tambah_users', [ConbeUsers::class, 'act_tambah_users'])->name('act_tambah_users');
            //action edit
            Route::post('/act_edit_role_users', [ConbeUsers::class, 'act_edit_role_users'])->name('act_edit_role_users');
            Route::post('/act_edit_users', [ConbeUsers::class, 'act_edit_users'])->name('act_edit_users');
            //action hapus
            Route::post('/act_hapus_role_users', [ConbeUsers::class, 'act_hapus_role_users'])->name('act_hapus_role_users');
            Route::post('/act_hapus_users', [ConbeUsers::class, 'act_hapus_users'])->name('act_hapus_users');
        });
    });
});