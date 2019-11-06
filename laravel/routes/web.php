<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'SyncController@sync');
Route::post('/sync', 'SyncServerController@syncServer');
Route::get('/barcode', 'BarcodeController@index');
Route::get('/ongkir', 'OngkirController@index');
Route::post('/ajaxProvince', 'OngkirController@AjaxProvince');
Route::post('/cekOngkos', 'OngkirController@cekOngkos');
