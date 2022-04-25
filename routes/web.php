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
Route::post('/register-store', 'AuthController@register')->name('auth.register');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('forget-password', 'AuthController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'AuthController@submitForgetPasswordForm')->name('forget.password.post');
Route::get('reset-password/{token}', 'AuthController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'AuthController@submitResetPasswordForm')->name('reset.password.post');

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin']], function () {
    Route::resource('aktivitas-sistem', AktivitasSistemController::class);
    Route::get('/get-aktivitas-sistem','AktivitasSistemController@get_aktivitas')->name('aktivitas-sistem.get-aktivitas');
    Route::post('/test','AktivitasSistemController@test')->name('test');

    Route::resource('laporan-aset', LaporanAsetController::class);
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin']], function () {
    //route unit
    Route::resource('unit', ManajemenUnitController::class);
    Route::get('/get-data-unit','ManajemenUnitController@get_data_unit')->name('unit.get-data-unit');

    Route::resource('manajemen-user', ManajemenUserController::class);
    Route::get('/get-superadmin','ManajemenUserController@get_superadmin')->name('manajemen-user.get-superadmin');
    Route::get('/get-admin','ManajemenUserController@get_admin')->name('manajemen-user.get-admin');
    Route::get('/get-bmn','ManajemenUserController@get_bmn')->name('manajemen-user.get-bmn');
    Route::get('/get-sarpras','ManajemenUserController@get_sarpras')->name('manajemen-user.get-sarpras');
    Route::get('/get-peminjam','ManajemenUserController@get_peminjam')->name('manajemen-user.get-peminjam');
    Route::get('/get-pengaju','ManajemenUserController@get_pengaju')->name('manajemen-user.get-pengaju');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin,BMN']], function(){
    //route data aset
    Route::resource('data-aset', DataAsetController::class);
    Route::get('/impor-aset','DataAsetController@import')->name('data-aset.import');
    Route::get('/get-data-aset','DataAsetController@getdatatable')->name('data-aset.getdatatable');
    Route::get('/import-data-aset','DataAsetController@getdataimport')->name('data-aset.getdataimport');
    Route::get('/detail-import-aset','DataAsetController@getdatadetailimport')->name('data-aset.getdatadetailimport');
    Route::get('/template-import','DataAsetController@import_template')->name('data-aset.import-template');
    Route::get('/filter-data','DataAsetController@filter_data')->name('data-aset.filter-data-aset');
    Route::get('/detail-import/{id}','DataAsetController@detail_riwayat_import')->name('data-aset.detail-riwayat-import');
    Route::post('/destroy-log-import/{id}','DataAsetController@destroy_log_import')->name('data-aset.destroy-log-import');
    Route::post('/data-aset-import','DataAsetController@import_data')->name('data-aset.import-data-aset');

    //route ruangan
    Route::resource('data-ruangan', ManajemenRuanganController::class);
    Route::get('/get-data-ruangan','ManajemenRuanganController@get_data_ruangan')->name('data-ruangan.get-data-ruangan');
    Route::post('/impor-data-ruangan','ManajemenRuanganController@importexcel')->name('data-ruangan.impor-data-ruangan');

    //route pengajuan
    Route::resource('pengajuan', PengajuanController::class);
    Route::get('/get-pengajuan-admin','PengajuanController@get_data_pengajuan')->name('pengajuan.getdatapengajuan-admin');
    Route::post('/confirm-request-pengajuan/{no_permintaan}','PengajuanController@confirm_request')->name('pengajuan.confirm-request');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin,Sarpras']], function(){

    //route peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/get-data-permintaan-peminjaman-admin','PeminjamanController@get_data_permintaan_peminjaman')->name('peminjaman.getdatapermintaanpeminjaman-admin');
    Route::get('/get-data-peminjaman-admin','PeminjamanController@get_data_peminjaman')->name('peminjaman.getdatapeminjaman-admin');
    Route::get('/data-from-nopeminjam-admin','PeminjamanController@data_from_no_peminjam')->name('peminjaman.data-from-nopeminjam-admin');
    Route::get('/list-peminjaman-admin','PeminjamanController@list_peminjaman_admin')->name('peminjaman.list-peminjaman-admin');
    Route::get('/download-surat-peminjaman-admin/{no_peminjaman}','PeminjamanController@download_surat_peminjaman')->name('peminjaman.download-surat-peminjaman-admin');
    Route::get('/download-surat-balasan-admin/{no_peminjaman}','PeminjamanController@download_surat_balasan')->name('peminjaman.download-surat-balasan-admin');
    Route::post('/destroy-permintaan-admin/{no_permintaan}','PeminjamanController@destroy_permintaan')->name('peminjaman.destroy-permintaan-admin');
    Route::post('/confirm-request/{no_permintaan}','PeminjamanController@confirm_request')->name('peminjaman.confirm-request');
    Route::get('/done-peminjaman/{id}','PeminjamanController@done_peminjaman')->name('peminjaman.done-peminjaman');
    Route::post('/destroy-peminjaman/{id}','PeminjamanController@destroy_peminjaman')->name('peminjaman.destroy-peminjaman');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin,Sarpras,BMN']], function(){
    //route data aset
    Route::get('data-aset', 'DataAsetController@index')->name('data-aset.index');
    Route::get('/get-data-aset','DataAsetController@getdatatable')->name('data-aset.getdatatable');
    Route::get('/filter-data','DataAsetController@filter_data')->name('data-aset.filter-data-aset');
    Route::get('/get-ruangan','DataAsetController@get_ruangan')->name('data-aset.get-ruangan');
    Route::get('/export-data-aset','DataAsetController@export_excel')->name('data-aset.export_excel');

});

Route::group(['middleware' => ['auth','emailverified','cekrole:Peminjam']], function(){
    //route peminjaman
    Route::get('/form-peminjaman','PeminjamanController@formpeminjaman')->name('peminjaman.form');
    Route::get('/get-free-aset','PeminjamanController@get_free_aset')->name('peminjaman.get-free-aset');
    Route::get('/template-surat','PeminjamanController@templatesurat')->name('peminjaman.template-surat');
    Route::get('/temporary-data','PeminjamanController@temporary_data')->name('peminjaman.temporary-data');
    Route::post('/store-permintaan','PeminjamanController@storepermintaan')->name('peminjaman.store-permintaan');
    Route::get('/list-permintaan-peminjaman','PeminjamanController@list_permintaan_peminjaman')->name('peminjaman.list-permintaan-peminjaman');
    Route::get('/list-peminjaman','PeminjamanController@list_peminjaman')->name('peminjaman.list-peminjaman');
    Route::get('/get-data-permintaan-peminjaman','PeminjamanController@get_data_permintaan_peminjaman')->name('peminjaman.getdatapermintaanpeminjaman');
    Route::get('/get-data-peminjaman','PeminjamanController@get_data_peminjaman')->name('peminjaman.getdatapeminjaman');
    Route::get('/data-from-nopeminjam','PeminjamanController@data_from_no_peminjam')->name('peminjaman.data-from-nopeminjam');
    Route::get('/download-surat-peminjaman/{no_peminjaman}','PeminjamanController@download_surat_peminjaman')->name('peminjaman.download-surat-peminjaman');
    Route::get('/download-surat-balasan/{no_peminjaman}','PeminjamanController@download_surat_balasan')->name('peminjaman.download-surat-balasan');
    Route::post('/destroy-permintaan/{no_permintaan}','PeminjamanController@destroy_permintaan')->name('peminjaman.destroy-permintaan');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Pengaju']], function(){
    //route pengajuan
    Route::get('/form-pengajuan','PengajuanController@formpengajuan')->name('pengajuan.form');
    Route::post('/store-pengajuan','PengajuanController@storepengajuan')->name('pengajuan.store-pengajuan');
    Route::get('/get-ruangan-pengaju','PengajuanController@get_ruangan')->name('pengajuan.get-ruangan');
    Route::get('/list-pengajuan','PengajuanController@list_pengajuan')->name('pengajuan.list-pengajuan');
    Route::get('/get-pengajuan','PengajuanController@get_data_pengajuan_user')->name('pengajuan.getdatapengajuan');
    Route::get('/import-pengajuan','PengajuanController@import_index')->name('pengajuan.import');
    Route::get('/template-import-pengajuan','PengajuanController@import_template')->name('pengajuan.import-template');
    Route::post('/pengajuan-data-aset-import','PengajuanController@import_data')->name('pengajuan.import-data-aset');
    Route::get('/import-pengajuan-data-aset','PengajuanController@getdataimport')->name('pengajuan.getdataimport');
    Route::get('/detail-import-aset-pengajuan','PengajuanController@getdatadetailimport')->name('pengajuan.getdatadetailimport');
    Route::get('/detail-import-pengajuan/{id}','PengajuanController@detail_riwayat_import')->name('pengajuan.detail-riwayat-import');
    Route::post('/destroy-log-import-pengajuan/{id}','PengajuanController@destroy_log_import')->name('pengajuan.destroy-log-import');
});

Route::group(['middleware' => ['auth']], function(){
    Route::resource('manajemen-profil', ManajemenProfileController::class);
    Route::get('verify-email', 'AuthController@emailVerifyForm')->name('email.verify.get');
    Route::post('verify-email', 'AuthController@submitEmailVerifyForm')->name('email.verify.post');
    Route::get('verify-email/{token}', 'AuthController@submitEmailVerify')->name('email.verify.submit');
    Route::get('mark-read', 'NotificationController@markNotification')->name('notif.mark-read');
    Route::get('clearnotif', 'NotificationController@clearNotification')->name('notif.clearnotif');
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');
});
