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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/equipos/{categoria?}', 'EquiposController@index')->name('view_equipos');
Route::post('/new_equipo', 'EquiposController@create')->name('new_equipos');
Route::post('equipos/search_equipo', 'EquiposController@search')->name('search_equipos');
Route::get('equipos/ver/{id}', 'EquiposController@view')->name('view_equipo');
Route::post('equipos/editar', 'EquiposController@update')->name('update_equipo');

Route::get('/torneos/{categoria?}', 'TorneosController@index')->name('view_torneos');
Route::post('/new_torneo', 'TorneosController@create')->name('new_torneo');
Route::get('/torneos/ver/{id}', 'TorneosController@view')->name('view_torneo');
Route::post('/torneos/editar', 'TorneosController@update')->name('update_torneo');
//Route::post('/fixture', 'TorneosController@create_fixture')->name('create_fixture');
Route::post('/torneos/fixture', 'TorneosController@create_fixture')->name('fixture_torneo');
Route::get('/torneos/resulado/{torneo}/{fecha}', 'TorneosController@save_result')->name('save_result');
Route::get('/torneos/editar_fecha', 'TorneosController@edit_date')->name('edit_date');

Route::post('/jugadores', 'TorneosController@index')->name('view_players');

