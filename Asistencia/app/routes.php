<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/reporte-primera-quincena', array('uses' => 'HomeController@getReportePrimeraQuincena'));
Route::get('/reporte-segunda-quincena', array('uses' => 'HomeController@getReporteSegundaQuincena'));
Route::get('/reporte-mes', array('uses' => 'HomeController@getReporteMes'));

Route::post('/registrarAsistencia', array('uses' => 'HomeController@postAsistencia'));
Route::post('/registrarSalida', array('uses' => 'HomeController@postSalida'));
Route::post('/ultimasAsistencias', array('uses' => 'HomeController@getUltimasAsistencias'));

