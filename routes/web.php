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
Route::resource('site', 'App\Http\Controllers\SiteController');
Route::get('/', function () {
     return redirect()->route('site.index');
});

// Route::get('/notifmail','AntrianController@mail');
Route::get('/viewmail','App\Http\Controllers\AntrianController@mail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});  

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::resource('poli', 'App\Http\Controllers\PoliController');
	Route::resource('pasien', 'App\Http\Controllers\PasienController');
	Route::get('pasien/{id_antrian}/verifikasi','App\Http\Controllers\PasienController@verifikasi')->name('pasien.verifikasi');
	Route::put('verifikasi/{id_antrian}','App\Http\Controllers\PasienController@verifikasi_update')->name('pasien.verifikasi-update');
	Route::resource('antrian', 'App\Http\Controllers\AntrianController');
	Route::GET('list_antrian','App\Http\Controllers\AntrianController@list_antrian');
	Route::post('record_antrian','App\Http\Controllers\AntrianController@record_antrian');
	Route::post('finish_antrian','App\Http\Controllers\AntrianController@finish');
	Route::resource('riwayat', 'App\Http\Controllers\RiwayatController');
	Route::get('report_poli','App\Http\Controllers\AntrianController@report_poli');
	Route::post('tambah_antrian','App\Http\Controllers\AntrianController@daftar_antrian');
	Route::get('cetak_antrian/{id}','App\Http\Controllers\AntrianController@print');
	Route::post('pasien-ajax','App\Http\Controllers\PetugasController@verifikasi_ajax');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

