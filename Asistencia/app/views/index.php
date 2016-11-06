<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="google-signin-client_id" content="973153671850-v8u8j16uajlcfcqa0p886hm2t834m8kt.apps.googleusercontent.com">
		<title>Estudio Contable Tributario</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<div class="jumbotron">
			<section class="container">
				<h1>
					Control de asistencia
				</h1>
				<p>
					Marca tu hora de ingreso, haz clic en una opción para identificarte:
				</p>
				<div id="botonesSignIn">
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
				</div>
				<div class="botonSignOut" style="display:none">
					<a id="salir" href="#" class="btn btn-primary btn-lg">
						Desconectarse
					</a>
				</div>
				<div class="clearfix"></div>
				<div class="clock">
					<div id="Date"></div>
					<ul>
						<li id="hours"></li>
						<li id="point">:</li>
						<li id="min"></li>
						<li id="point">:</li>
						<li id="sec"></li>
					</ul>
				</div>
			</section>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>