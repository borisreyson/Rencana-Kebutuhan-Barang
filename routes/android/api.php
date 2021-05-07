<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


Route::get('/android/api/get/user', [ 'uses'=>'android\androidController@get_user',
				  "alias" => 'android.user'
				]);

Route::get('/android/api/monitoring/ob', [ 'uses'=>'android\androidController@getOB',
				  "alias" => 'android.getOB'
				]);
Route::get('/android/api/monitoring/stock', [ 'uses'=>'android\androidController@getStock',
				  "alias" => 'android.getStock'
				]);

Route::get('/android/api/hse/sumber/bahaya', [ 'uses'=>'android\androidController@getSumberBahaya',
				  "alias" => 'android.getSumberBahaya'
				]);

Route::post('/android/api/hse/hazard/reportPost', [ 'uses'=>'android\androidController@postHazardReport',
				  "alias" => 'android.postHazardReport'
				]);
Route::post('/android/api/hse/hazard/reportPost/selesai', [ 'uses'=>'android\androidController@postHazardReportSelesai',
				  "alias" => 'android.postHazardReportSelesai'
				]);

Route::get('/android/api/hse/list/hazard/report', [ 'uses'=>'android\androidController@getListHazard',
				  "alias" => 'android.getListHazard'
				]);
Route::get('/android/api/hse/list/hazard/report/all', [ 'uses'=>'android\androidController@getListHazardAll',
				  "alias" => 'android.getListHazard'
				]);
Route::get('/android/api/hse/item/hazard/report', [ 'uses'=>'android\androidController@getItemHazard',
				  "alias" => 'android.getItemHazard'
				]);
Route::get('/android/api/user/forgot/password', [ 'uses'=>'android\androidController@forgotPassword',
				  "alias" => 'android.forgotPassword'
				]);
Route::get('/android/api/user/check/data', [ 'uses'=>'android\androidController@cekUser',
				  "alias" => 'android.cekUser'
				]);
Route::get('/android/api/get/perusahaan', [ 'uses'=>'android\androidController@getPerusahaan',
				  "alias" => 'android.getPerusahaan'
				]);
Route::get('/android/api/get/department', [ 'uses'=>'android\androidController@getDepartment',
				  "alias" => 'android.getDepartment'
				]);

Route::get('/android/api/check/section/dept', [ 'uses'=>'android\androidController@checkSection',
				  "alias" => 'android.checkSection'
				]);


Route::post('/android/api/daftar/akun/baru', [ 'uses'=>'android\androidController@daftarkanAkun',
				  "alias" => 'android.daftarkanAkun'
				]);
Route::post('/android/api/daftar/akun/baru/mitra', [ 'uses'=>'android\androidController@daftarkanAkunMitra',
				  "alias" => 'android.daftarkanAkunMitra'
				]);


Route::post('/android/api/hse/hazard/report/update/bukti/bergambar', [ 'uses'=>'android\androidController@updateBuktiSelesaiBergambar',
				  "alias" => 'android.updateBuktiSelesaiBergambar'
				]);

Route::post('/android/api/hse/hazard/report/update/bukti', [ 'uses'=>'android\androidController@updateBuktiSelesai',
				  "alias" => 'android.updateBuktiSelesai'
				]);

Route::get('/android/api/lokasi/get', [ 'uses'=>'android\androidController@getLokasi',
				  "alias" => 'android.getLokasi'
				]);
Route::get('/android/api/risk/get', [ 'uses'=>'android\androidController@getRisk',
				  "alias" => 'android.getRisk'
				]);
Route::post('/android/api/login/validate', [
        'uses'  => 'android\androidController@LoginValidate',
        'as'    => 'android.login.validate'
    ]);