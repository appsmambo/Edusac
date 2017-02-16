<?php

Route::get('/', function()
{
	$personal = Personal::orderBy('nombres')->get(['id', 'nombres', 'apellidos']);
	return View::make('index')->with('dataPersonal', $personal->toArray());
});

Route::get('/reporte-primera-quincena', array('uses' => 'HomeController@getReportePrimeraQuincena'));
Route::get('/reporte-segunda-quincena', array('uses' => 'HomeController@getReporteSegundaQuincena'));
Route::get('/reporte-mes', array('uses' => 'HomeController@getReporteMes'));

Route::post('/registrarAsistencia', array('uses' => 'HomeController@postAsistencia'));
Route::post('/registrarSalida', array('uses' => 'HomeController@postSalida'));
Route::post('/ultimasAsistencias', array('uses' => 'HomeController@getUltimasAsistencias'));

//Route::post('/dataPersonal', array('uses' => 'HomeController@postDataPersonal'));
Route::post('/postHoraIngreso', array('uses' => 'HomeController@getHoraIngreso'));
Route::post('/postActualizarHora', array('uses' => 'HomeController@postActualizarHora'));