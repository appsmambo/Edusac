var dataPersonal = {};
var personal = {};
personal.id = null;
personal.nombre = '';
personal.hora = '';
personal.reporte = '';

$(document).ready(function () {
	$('#salir').click(function () {
		botones();
		return false;
	});
	$('#asistencia').click(function() {
		var email = $('#email').val();
		var clave = $('#clave').val();
		if (email.length === 0) return false;
		if (!isEmail(email)) {
			$('#bloqueEmail').addClass('has-error');
			$('#email').focus();
			return false;
		}
		$('#bloqueEmail').removeClass('has-error');
		$.ajax({
			url:baseUrl + '/registrarAsistencia',
			data:'email=' + email + '&clave=' + clave,
			error:function () {
				//console.log('error');
			},
			dataType:'json',
			success:function (data) {
				var dataJson = JSON.parse(data);
				var respuesta = dataJson[0];
				if (respuesta.estado === 'error') {
					$('#modalMensaje').modal('show');
					return false;
				} else {
					botones(respuesta.estado);
					personal.id = respuesta.id;
					personal.nombre = respuesta.nombre;
					personal.hora = respuesta.hora;
					personal.reporte = respuesta.reporte;
					$('#nombre').html(personal.nombre);
					$('#hora').html(personal.hora);
					//console.log(personal.reporte);
					if (personal.reporte == 2) {
						$('#botonReporte').show();
					} else {
						$('#botonReporte').hide();
					}
					// cargar 5 ultimas fechas de asistencia
					cargarAsistencias();
				}
			},
			type:'POST'
		});
	});
	$('#salida').click(function() {
		botones();
		$.ajax({
			url:baseUrl + '/registrarSalida',
			data:'id=' + personal.id,
			error:function () {
				//console.log('error');
			},
			dataType:'json',
			success:function (data) {
				var dataJson = JSON.parse(data);
				var respuesta = dataJson[0];
				if (respuesta.estado === 'error') {
					$('#modalMensaje').modal('show');
					return false;
				} else {
					limpiarDatos();
				}
			},
			type:'POST'
		});
		return false;
	});
	$('#editarIngreso').click(function() {
		$('#modalEditarIngreso').modal('show');
	});
	$('#fechaIngreso').change(function() {
		$.ajax({
			url:baseUrl + '/getHoraIngreso',
			data:'id=' + $('#personal').val() + '&fecha=' + $('#fechaIngreso').val(),
			error:function () {
				//console.log('error');
			},
			dataType:'json',
			success:function (data) {
				$('#horaIngreso').val(data[0].hora).show('slow');
			},
			type:'POST'
		});
	});
});

function botones(estado) {
	$('#email').val('');
	$('#clave').val('');
	$('#bloqueSignIn').toggle();
	$('#bloqueSignOut').toggle();
	if (estado === 'S') {
		$('#salida').show();
	} else {
		$('#salida').hide();
	}
}

function limpiarDatos() {
	personal.id = null;
	personal.nombre = '';
	personal.hora = '';
	$('#nombre').html('');
	$('#hora').html('');
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function cargarAsistencias() {
	$.ajax({
		url:baseUrl + '/ultimasAsistencias',
		data:'id=' + personal.id,
		error:function () {
			//console.log('error');
		},
		dataType:'json',
		success:function (data) {
			var contador = 1;
			var html = '';
			$('#listado').html('');
			$.each(data, function(i, item) {
				html += '<tr>';
				html += '<td>' + contador + '</td>';
				html += '<td>' + item.dia + '</td>';
				html += '<td>' + item.entrada + '</td>';
				if (item.entrada !== item.salida)
					html += '<td>' + item.salida + '</td>';
				else
					html += '<td class="warning">00:00:00</td>';
				html += '</tr>';
				contador++;
			});
			$('#listado').html(html);
		},
		type:'POST'
	});
}
