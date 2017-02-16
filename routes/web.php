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

// 会社
Route::get('/corporation/create','CorporationController@showCreate');	// 登録
Route::post('/corporation/create','CorporationController@create');		// 登録実行
Route::get('/corporation/{id}','CorporationController@showEdit');		// 変更
Route::patch('/corporation/{id}','CorporationController@edit');			// 変更実行
Route::delete('/corporation/{id}','CorporationController@delete');		// 削除実行
Route::get('/corporation','CorporationController@index');				// 一覧

Route::get('/', function () {
    return view('welcome');
});
