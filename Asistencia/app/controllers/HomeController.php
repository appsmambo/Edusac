<?php

class HomeController extends BaseController {

	public function postAsistencia()
	{
		$email = Input::get('email');
		$clave = md5(trim(Input::get('clave')));
		
		$personal = Personal::where('email', $email)->where('clave', $clave)->get();
		
		if (!count($personal)) {
			$response = '[{"estado":"error"}]';
			return Response::json($response, 200);
		}
		
		$id = $personal[0]->id;
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		$nombre = ucfirst($personal[0]->nombres).' '.ucfirst($personal[0]->apellidos);
		
		// mis ultimas 5 asistencias
		
		
		// validar si personal ya marco el día de hoy
		$consultaAsistencia = Asistencia::where('fecha', '=', $fecha)->where('personal', '=', $id)->where('estado', 'E')->get();
		
		if (!count($consultaAsistencia)) {
			// marca asistencia
			$asistencia = new Asistencia;
			$asistencia->fecha = $fecha;
			$asistencia->hora = $hora;
			$asistencia->personal = $id;
			$asistencia->login = '-';
			$asistencia->estado = 'E';
			$asistencia->save();

			$response = '[{"estado":"E","id":'.$id.',"nombre":"'.$nombre.'","hora":"'.$hora.'"}]';
		} else {
			// mostrar hora de asistencia y boton de salida
			$hora = $consultaAsistencia[0]->hora;
			$response = '[{"estado":"S","id":'.$id.',"nombre":"'.$nombre.'","hora":"'.$hora.'"}]';
		}
		
		return Response::json($response, 200);
	}
	
	public function postSalida()
	{
		$id = Input::get('id');
		
		$personal = Personal::find($id);
		
		if (!count($personal)) {
			$response = '[{"estado":"error"}]';
			return Response::json($response, 200);
		}
		
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		
		// validar si personal ya marco su salida
		$consultaAsistencia = Asistencia::where('fecha', '=', $fecha)->where('personal', '=', $id)->where('estado', 'S')->get();
		
		if (!count($consultaAsistencia)) {
			// marca asistencia
			$asistencia = new Asistencia;
			$asistencia->fecha = $fecha;
			$asistencia->hora = $hora;
			$asistencia->personal = $id;
			$asistencia->login = '-';
			$asistencia->estado = 'S';
			$asistencia->save();

			$response = '[{"estado":"ok"}]';
		} else {
			// ya habia registrado hora de salida
			$response = '[{"estado":"0"}]';
		}
		
		return Response::json($response, 200);
	}

}
