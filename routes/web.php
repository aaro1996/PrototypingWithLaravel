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

Auth::routes();

Route::post('/githook', 'GitController@gitpull');

Route::get('/', function () {
    return view('legacy.index');
});

Route::get('/play', function() {
	return view('infrastructure.game_list');
});

Route::get('/testhex', function() {
	return view('gameboard.implementations.testhex.game');
});

Route::get('/jdlink', function () {
    return view('legacy.jdlink');
});

Route::get('/testsquare', function() {
	return view('gameboard.implementations.testsquare.game', ['gamenum' => -1, 'playernum' => -1]);
});

Route::resource('/play/testsquare', 'gameTestsquareController');

Route::get('/playi/testsquare', function() {
	return view('gameboard.implementations.testsquare.game', ['gamenum' => -2, 'playernum' => 1]);
});

Route::get('/home', 'HomeController@index')->name('home');
