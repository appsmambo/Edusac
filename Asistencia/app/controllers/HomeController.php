<?php

class HomeController extends BaseController {

	public function postAsistencia()
	{
		$login = Input::get('login');
		$email = Input::get('email');
		$personal = Personal::where('email', $email)->get();
		
		$id = $personal[0]->id;
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		
		$asistencia = new Asistencia;
		$asistencia->fecha = $fecha;
		$asistencia->hora = $hora;
		$asistencia->personal = $id;
		$asistencia->login = $login;
		$asistencia->save();
		
		return $hora;
	}

}
