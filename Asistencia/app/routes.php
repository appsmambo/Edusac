<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::post('/registrarAsistencia', array('uses' => 'HomeController@postAsistencia'));
