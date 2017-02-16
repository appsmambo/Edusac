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
		$estado = $personal[0]->estado;
		
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

			$response = '[{"estado":"E","id":'.$id.',"nombre":"'.$nombre.'","hora":"'.$hora.'","reporte":"'.$estado.'"}]';
		} else {
			// mostrar hora de asistencia y boton de salida
			$hora = $consultaAsistencia[0]->hora;
			$response = '[{"estado":"S","id":'.$id.',"nombre":"'.$nombre.'","hora":"'.$hora.'","reporte":"'.$estado.'"}]';
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
	
	public function getUltimasAsistencias()
	{
		// ultimas 5 asistencias
		$id = Input::get('id');
		//SELECT fecha, min(hora), max(hora), personal FROM `asistencia` group by personal, fecha ORDER BY personal, fecha, hora
		$asistencias = DB::table('asistencia')
					->select(DB::raw("DATE_FORMAT(fecha, '%d/%m/%Y') AS dia, min(hora) AS entrada, max(hora) AS salida"))
					->where('personal', $id)
					->groupBy('fecha')
					->orderBy('fecha', 'desc')
					->take(6)
					->get();
		return $asistencias;
	}
	
	public function getReportePrimeraQuincena()
	{
		$mes = date('m');
		$ultimoDia = date('t');
		$anio = date('Y');
		
		$fechaInicio = "$anio-$mes-01";
		$fechaFin = "$anio-$mes-15";
		$sql = "SELECT DATE_FORMAT(a.fecha, '%d/%m/%Y') AS dia, min(a.hora) AS entrada, max(a.hora) AS salida, CONCAT(p.nombres, ' ', p.apellidos) as persona 
				FROM asistencia a 
				INNER JOIN personal p ON a.personal = p.id 
				where fecha >= ? and fecha <= ? 
				group by personal, fecha 
				ORDER BY personal, fecha, hora";
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$datos = DB::select($sql, array($fechaInicio, $fechaFin));
		// exportar a excel
		Excel::create("Reporte-$fechaInicio-$fechaFin", function($excel) use($datos) {
			$excel->sheet('Asistencia', function($sheet)  use($datos) {
				$sheet->fromArray($datos);
			});
		})->export('xls');
	}
	
	public function getReporteSegundaQuincena()
	{
		$mes = date('m');
		$ultimoDia = date('t');
		$anio = date('Y');
		
		$fechaInicio = "$anio-$mes-16";
		$fechaFin = "$anio-$mes-$ultimoDia";
		$sql = "SELECT DATE_FORMAT(a.fecha, '%d/%m/%Y') AS dia, min(a.hora) AS entrada, max(a.hora) AS salida, CONCAT(p.nombres, ' ', p.apellidos) as persona 
				FROM asistencia a 
				INNER JOIN personal p ON a.personal = p.id 
				where fecha >= ? and fecha <= ? 
				group by personal, fecha 
				ORDER BY personal, fecha, hora";
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$datos = DB::select($sql, array($fechaInicio, $fechaFin));
		// exportar a excel
		Excel::create("Reporte-$fechaInicio-$fechaFin", function($excel) use($datos) {
			$excel->sheet('Asistencia', function($sheet)  use($datos) {
				$sheet->fromArray($datos);
			});
		})->export('xls');
	}
	
	public function getReporteMes()
	{
		$mes = date('m');
		$ultimoDia = date('t');
		$anio = date('Y');
		
		$fechaInicio = "$anio-$mes-01";
		$fechaFin = "$anio-$mes-$ultimoDia";
		$sql = "SELECT DATE_FORMAT(a.fecha, '%d/%m/%Y') AS dia, min(a.hora) AS entrada, max(a.hora) AS salida, CONCAT(p.nombres, ' ', p.apellidos) as persona 
				FROM asistencia a 
				INNER JOIN personal p ON a.personal = p.id 
				where fecha >= ? and fecha <= ? 
				group by personal, fecha 
				ORDER BY personal, fecha, hora";
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$datos = DB::select($sql, array($fechaInicio, $fechaFin));
		// exportar a excel
		Excel::create("Reporte-$fechaInicio-$fechaFin", function($excel) use($datos) {
			$excel->sheet('Asistencia', function($sheet)  use($datos) {
				$sheet->fromArray($datos);
			});
		})->export('xls');
	}

	public function getHoraIngreso()
	{
		$id = Input::get('id');
		$fecha = Input::get('fecha');
		$consultaAsistencia = Asistencia::where('fecha', '=', $fecha)->where('personal', '=', $id)->where('estado', 'E')->get(['id', 'hora']);
		return Response::json($consultaAsistencia->toArray(), 200);
	}
	
	public function postActualizarHora()
	{
		$id = Input::get('id');
		$horaEditada = Input::get('hora');
		$asistencia = Asistencia::find($id);
		$asistencia->hora = $horaEditada;
		$asistencia->save();
		return 1;
	}
}
