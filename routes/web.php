<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('news-detail', function () {
    return view('news-detail');
});
Route::post('/validate','AuthController@login')->name('auth.login');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');
Route::post('/register-store', 'AuthController@register')->name('auth.register');

Route::get('/register', function () {
    return view('register');
});

Route::get('/form-peminjaman','PeminjamanController@formpeminjaman')->name('peminjaman.form');
Route::get('/get-free-aset','PeminjamanController@get_free_aset')->name('peminjaman.get-free-aset');
Route::get('/template-surat','PeminjamanController@templatesurat')->name('peminjaman.template-surat');
Route::get('/temporary-data','PeminjamanController@temporary_data')->name('peminjaman.temporary-data');
Route::post('/store-permintaan','PeminjamanController@storepermintaan')->name('peminjaman.store-permintaan');


Route::group(['middleware' => ['auth','cekrole:Super Admin, Sarpras, BMN']], function(){
    //route data aset
    Route::resource('data-aset', DataAsetController::class);
    Route::get('/impor-aset','DataAsetController@import')->name('data-aset.import');
    Route::get('/get-data-aset','DataAsetController@getdatatable')->name('data-aset.getdatatable');
    Route::get('/import-data-aset','DataAsetController@getdataimport')->name('data-aset.getdataimport');
    Route::get('/detail-import-aset','DataAsetController@getdatadetailimport')->name('data-aset.getdatadetailimport');
    Route::get('/export-data-aset','DataAsetController@export_excel')->name('data-aset.export_excel');
    Route::get('/template-import','DataAsetController@import_template')->name('data-aset.import-template');
    Route::get('/filter-data','DataAsetController@filter_data')->name('data-aset.filter-data-aset');
    Route::get('/detail-import/{id}','DataAsetController@detail_riwayat_import')->name('data-aset.detail-riwayat-import');
    Route::post('/destroy-log-import/{id}','DataAsetController@destroy_log_import')->name('data-aset.destroy-log-import');
    Route::post('/data-aset-import','DataAsetController@import_data')->name('data-aset.import-data-aset');
    
    //route unit
    Route::resource('unit', ManajemenUnitController::class);
});

Route::group(['middleware' => ['auth','cekrole:Peminjam']], function(){
    //route peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
});