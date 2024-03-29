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

    Route::resource('laporan-inventaris', LaporanInventarisController::class);
    Route::get('/get-laporan-data-inventaris','LaporanInventarisController@laporangetdatatable')->name('laporan-data-inventaris.getdatatable');
    
    Route::resource('manajemen-user', ManajemenUserController::class);
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin']], function () {
    //route unit
    Route::resource('unit', ManajemenUnitController::class);
    Route::get('/get-data-unit','ManajemenUnitController@get_data_unit')->name('unit.get-data-unit');
    Route::post('/impor-data-unit','ManajemenUnitController@importexcel')->name('unit.impor-data-unit');
    Route::get('/impor-unit-template','ManajemenUnitController@import_template')->name('unit.impor-unit-template');

    Route::resource('manajemen-user', ManajemenUserController::class);
    Route::get('/get-superadmin','ManajemenUserController@get_superadmin')->name('manajemen-user.get-superadmin');
    Route::get('/get-admin','ManajemenUserController@get_admin')->name('manajemen-user.get-admin');
    Route::get('/get-bmn','ManajemenUserController@get_bmn')->name('manajemen-user.get-bmn');
    Route::get('/get-sarpras','ManajemenUserController@get_sarpras')->name('manajemen-user.get-sarpras');
    Route::get('/get-peminjam','ManajemenUserController@get_peminjam')->name('manajemen-user.get-peminjam');
    Route::get('/get-pengaju','ManajemenUserController@get_pengaju')->name('manajemen-user.get-pengaju');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin']], function(){
    //route data inventaris
    Route::resource('data-inventaris', DataInventarisController::class);
    Route::get('/impor-inventaris','DataInventarisController@import')->name('data-inventaris.import');
    Route::get('/get-data-inventaris','DataInventarisController@getdatatable')->name('data-inventaris.getdatatable');
    Route::get('/import-data-inventaris','DataInventarisController@getdataimport')->name('data-inventaris.getdataimport');
    Route::get('/detail-import-inventaris','DataInventarisController@getdatadetailimport')->name('data-inventaris.getdatadetailimport');
    Route::get('/template-import','DataInventarisController@import_template')->name('data-inventaris.import-template');
    Route::get('/filter-data','DataInventarisController@filter_data')->name('data-inventaris.filter-data-inventaris');
    Route::get('/detail-import/{id}','DataInventarisController@detail_riwayat_import')->name('data-inventaris.detail-riwayat-import');
    Route::post('/destroy-log-import/{id}','DataInventarisController@destroy_log_import')->name('data-inventaris.destroy-log-import');
    Route::post('/data-inventaris-import','DataInventarisController@import_data')->name('data-inventaris.import-data-inventaris');

    //route ruangan
    Route::resource('data-ruangan', ManajemenRuanganController::class);
    Route::get('/get-data-ruangan','ManajemenRuanganController@get_data_ruangan')->name('data-ruangan.get-data-ruangan');
    Route::post('/impor-data-ruangan','ManajemenRuanganController@importexcel')->name('data-ruangan.impor-data-ruangan');
    Route::get('/impor-ruangan-template','ManajemenRuanganController@import_template')->name('data-ruangan.impor-ruangan-template');

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
    Route::get('/download-data-diri-penanggung-jawab-admin/{no_peminjaman}','PeminjamanController@download_data_diri_penanggung_jawab')->name('peminjaman.download-data-diri-penanggung-jawab-admin');
    Route::post('/destroy-permintaan-admin/{no_permintaan}','PeminjamanController@destroy_permintaan')->name('peminjaman.destroy-permintaan-admin');
    Route::post('/confirm-request/{no_permintaan}','PeminjamanController@confirm_request')->name('peminjaman.confirm-request');
    Route::get('/done-peminjaman/{id}','PeminjamanController@done_peminjaman')->name('peminjaman.done-peminjaman');
    Route::post('/destroy-peminjaman/{id}','PeminjamanController@destroy_peminjaman')->name('peminjaman.destroy-peminjaman');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Super Admin,Admin,Sarpras']], function(){
    //route data inventaris
    Route::get('data-inventaris', 'DataInventarisController@index')->name('data-inventaris.index');
    Route::get('/get-data-inventaris','DataInventarisController@getdatatable')->name('data-inventaris.getdatatable');
    Route::get('/filter-data','DataInventarisController@filter_data')->name('data-inventaris.filter-data-inventaris');
    Route::get('/get-ruangan','DataInventarisController@get_ruangan')->name('data-inventaris.get-ruangan');
    Route::get('/export-data-inventaris','DataInventarisController@export_excel')->name('data-inventaris.export_excel');

});

Route::group(['middleware' => ['auth','emailverified','cekrole:Unit,Peminjam']], function(){
    //route peminjaman
    Route::get('/form-peminjaman','PeminjamanController@formpeminjaman')->name('peminjaman.form');
    Route::get('/get-free-inventaris','PeminjamanController@get_free_inventaris')->name('peminjaman.get-free-inventaris');
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
    Route::get('/download-template-surat-peminjaman','PeminjamanController@download_template_surat_peminjaman')->name('peminjaman.download-template-surat-peminjaman');
    Route::post('/destroy-permintaan/{no_permintaan}','PeminjamanController@destroy_permintaan')->name('peminjaman.destroy-permintaan');
});

Route::group(['middleware' => ['auth','emailverified','cekrole:Unit']], function(){
    //route pengajuan
    Route::get('/form-pengajuan','PengajuanController@formpengajuan')->name('pengajuan.form');
    Route::post('/store-pengajuan','PengajuanController@storepengajuan')->name('pengajuan.store-pengajuan');
    Route::get('/get-ruangan-pengaju','PengajuanController@get_ruangan')->name('pengajuan.get-ruangan');
    Route::get('/list-pengajuan','PengajuanController@list_pengajuan')->name('pengajuan.list-pengajuan');
    Route::get('/get-pengajuan','PengajuanController@get_data_pengajuan_user')->name('pengajuan.getdatapengajuan');
    Route::get('/import-pengajuan','PengajuanController@import_index')->name('pengajuan.import');
    Route::get('/template-import-pengajuan','PengajuanController@import_template')->name('pengajuan.import-template');
    Route::post('/pengajuan-data-inventaris-import','PengajuanController@import_data')->name('pengajuan.import-data-inventaris');
    Route::get('/import-pengajuan-data-inventaris','PengajuanController@getdataimport')->name('pengajuan.getdataimport');
    Route::get('/detail-import-inventaris-pengajuan','PengajuanController@getdatadetailimport')->name('pengajuan.getdatadetailimport');
    Route::get('/detail-import-pengajuan/{id}','PengajuanController@detail_riwayat_import')->name('pengajuan.detail-riwayat-import');
    Route::post('/destroy-log-import-pengajuan/{id}','PengajuanController@destroy_log_import')->name('pengajuan.destroy-log-import');
    Route::delete('/destroy-pengajuan/{id}','PengajuanController@destroy')->name('pengajuan.destroy-pengajuan');

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
