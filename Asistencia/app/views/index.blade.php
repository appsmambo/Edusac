<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="google-signin-client_id" content="973153671850-v8u8j16uajlcfcqa0p886hm2t834m8kt.apps.googleusercontent.com">
		<title>Estudio Contable Tributario</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
		<link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">
		<link href="{{url('css/main.css?v=123')}}" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<section class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h1>
						Control de asistencia
					</h1>
					<div id="bloqueSignIn">
						<h3>
							Ingresa tu correo y clave de acceso para identificarte:
						</h3>
						<div class="row formulario">
							<div class="col-sm-6">
								<div id="bloqueEmail" class="form-group">
									<input autofocus type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Correo electrónico">
								</div>
								<div id="bloqueClave" class="form-group">
									<input type="password" class="form-control" id="clave" name="clave" maxlength="50" placeholder="Clave">
								</div>
								<button type="button" id="asistencia" class="btn btn-primary pull-right">Entrar</button>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div id="bloqueSignOut" style="display:none">
						<div class="row">
							<div class="col-sm-6">
								<p class="datos">
									<strong>Bienvenido(a):</strong> <span id="nombre"></span>
									<br>
									<strong>Hora de ingreso:</strong> <span id="hora"></span>
								</p>
							</div>
							<div class="col-sm-6">
								<div id="botonReporte">
									<div class="btn-group">
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Reporte <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="{{url('/reporte-primera-quincena')}}">Primera quincena</a></li>
											<li><a href="{{url('/reporte-segunda-quincena')}}">Segunda quincena</a></li>
											<li><a href="{{url('/reporte-mes')}}">Mes completo</a></li>
										</ul>
									</div>
									<button type="button" class="btn btn-warning" id="editarIngreso">Editar ingreso</button>
									<button type="button" class="btn btn-info" id="nuevoPersonal">Nuevo personal</button>
								</div>
							</div>
						</div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Fecha</th>
									<th>Hora de ingreso</th>
									<th>Hora de salida</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody id="listado">
							</tbody>
						</table>
						<a id="salida" href="#" class="btn btn-danger btn-md" style="display:none">
							Marcar salida
						</a>
						<a id="salir" href="#" class="btn btn-danger btn-md">
							Salir
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</section>
		<!-- Modal -->
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" id="modalMensaje">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Mensaje:</h4>
					</div>
					<div class="modal-body">
						No encontramos tu email, o tu contraseña, vuelve a intentarlo.
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modalEditarIngreso" id="modalEditarIngreso">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar la hora de ingreso:</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="personal">Seleccione personal</label>
							<select class="form-control" id="personal">
								<option>&nbsp;</option>
								@foreach($dataPersonal as $personal)
								<option value="{{$personal['id']}}">{{ucwords($personal['nombres'])}} {{ucwords($personal['apellidos'])}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="fechaIngreso">Ingrese la fecha</label>
							<input type="date" class="form-control" id="fechaIngreso" max="{{date('Y-m-d')}}">
							<input type="text" class="form-control" id="horaIngreso" disabled value="" style="display:none">
						</div>
						<div class="form-group">
							<label for="horaEditada">Nueva hora</label>
							<input type="time" class="form-control" id="horaEditada">
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var baseUrl = '{{url()}}';
		</script>
		<script src="{{url('js/jquery.min.js')}}"></script>
		<script src="{{url('js/bootstrap.min.js')}}"></script>
		<script src="{{url('js/main.js?v=123')}}"></script>
	</body>
</html>