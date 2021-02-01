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

Route::get('/', 'HomeController@index')
  ->name('home');

Route::prefix('admin')
  ->namespace('Admin')
  ->middleware(['auth','checkRole:admin,staf'])
  ->group(function() {
      Route::get('/', 'DashboardController@index')
        ->name('dashboard');

      // Route Cetak
      Route::get('kendaraan/cetak', 'KendaraanController@cetak')
        ->name('cetak-kendaraan');
      Route::get('peralatan/cetak', 'PeralatanController@cetak')
        ->name('cetak-peralatan');
      Route::get('kantor/cetak', 'KantorController@cetak')
        ->name('cetak-kantor');
      Route::get('pengajuan-aset/cetak', 'PengajuanController@cetak')
        ->name('cetak-pengajuan');

      // Route Pencarian
      // Route::get('kendaraan/action', 'KendaraanController@action')
      //   ->name('kendaraan.action');

      // Route index
      Route::resource('kendaraan', 'KendaraanController');
      Route::resource('peralatan', 'PeralatanController');
      Route::resource('kantor', 'KantorController');
      Route::resource('pengajuan-aset', 'PengajuanController');
      Route::resource('aset-rusak', 'RusakController');

      // Route Edit Aset Rusak
      Route::put('aset-rusak/kendaraan/{id}', 'RusakController@updateKendaraan')->name('update-kendaraan');
      Route::put('aset-rusak/peralatan/{id}', 'RusakController@updatePeralatan')->name('update-peralatan');

      // Route Hapus Aset Rusak
      Route::delete('aset-rusak/destroy-kendaraan/{id}', 'RusakController@destroyKendaraan')->name('destroy-kendaraan');
      Route::delete('aset-rusak/destroy-peralatan/{id}', 'RusakController@destroyPeralatan')->name('destroy-peralatan');
  });
Auth::routes(['verify' => true]);
