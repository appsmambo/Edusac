<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::post('/registrarAsistencia', array('uses' => 'HomeController@postAsistencia'));
Route::post('/registrarSalida', array('uses' => 'HomeController@postSalida'));

