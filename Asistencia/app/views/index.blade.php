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
		<link href="{{url('css/main.css')}}" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1238616539531033";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<section class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h1>
						Control de asistencia
					</h1>
					<div id="bloqueSignIn">
						<h3>
							Para identificarte, haz clic en uno de los botones:
						</h3>
						<p>
							<br>
							<a href="#" id="fbLogin" class="btn btn-md btn-primary">
								<i class="fa fa-lg fa-facebook"></i> Conectar con Facebook
							</a>
							<br>
						</p>
						<div class="clearfix"></div>
						<div class="g-signin2" data-onsuccess="onSignIn"></div>
						<!--div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div-->
					</div>
					<div id="bloqueSignOut" style="display:none">
						<p>
							<img id="imagen" alt="" class="pull-left img-circle" style="margin-right:12px">
							<strong>Bienvenido(a):</strong> <span id="nombre"></span>
							<br>
							<strong>Hora de ingreso:</strong> <span id="hora"></span>
						</p>
						<a id="salir" href="#" class="btn btn-danger btn-md">
							Salir
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</section>
		<script>
			var baseUrl = '{{url()}}';
		</script>
		<script src="{{url('js/jquery.min.js')}}"></script>
		<script src="{{url('js/bootstrap.min.js')}}"></script>
		<script src="{{url('js/main.js')}}"></script>
	</body>
</html>