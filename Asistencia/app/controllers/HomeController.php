<?php

class HomeController extends BaseController {

	public function postAsistencia()
	{
		$login = Input::get('login');
		$email = Input::get('email');
		$clave = md5(trim(Input::get('clave')));
		
		if ($login !== 'email') {
			$personal = Personal::where('email', $email)->get();
		} else {
			$personal = Personal::where('email', $email)->where('clave', $clave)->get();
		}
		
		if (!count($personal)) {
			return 'error';
		}
			
		$id = $personal[0]->id;
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		
		// validar si personal ya marco el día de hoy
		$consultaAsistencia = Asistencia::where('fecha', $fecha)->where('personal', $id);
		
		if (!count($consultaAsistencia)) {
			// marca asistencia
			$asistencia = new Asistencia;
			$asistencia->fecha = $fecha;
			$asistencia->hora = $hora;
			$asistencia->personal = $id;
			$asistencia->login = $login;
			$asistencia->estado = 'E';
			$asistencia->save();

			$response = '[{"estado":"E","hora":"'.$hora.'"}]';
			if ($login === 'email') {
				$response = '[{"estado":"E","nombre":"'.ucfirst($personal[0]->nombres).' '.ucfirst($personal[0]->apellidos).'","hora":"'.$hora.'"}]';
			}
		} else {
			// mostrar hora de asistencia y boton de salida
			$response = '[{"estado":"S","hora":"'.$hora.'"}]';
		}
		
		return Response::json($response, 200);
	}

}
