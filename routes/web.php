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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/record', 'RecordsController@index')->name('record.index');
    Route::get('/record/create', 'RecordsController@create')->name('record.create');
    Route::put('/record/{id}', 'RecordsController@update')->name('record.update');
    Route::get('/record/{id}/edit', 'RecordsController@edit')->name('record.edit');

    Route::get('/record/{id}/destroy', 'RecordsController@destroy')->name('record.destroy');
    Route::post('/record', 'RecordsController@store')->name('record.store');


    Route::get('/time/{record_id}/create', 'TimesController@create')->name('time.create');
    Route::post('/time/{record_id}', 'TimesController@store')->name('time.store');
    Route::get('/time/{record_id}/start', 'TimesController@start')->name('time.start');
    Route::get('/time/{id}/end', 'TimesController@end')->name('time.end');
    Route::get('/time/{id}/edit', 'TimesController@edit')->name('time.edit');
    Route::put('/time/{id}', 'TimesController@update')->name('time.update');
    Route::get('/time/{id}/destroy', 'TimesController@destroy')->name('time.destroy');
});
