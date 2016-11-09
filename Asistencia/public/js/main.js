var personal = {};
personal.login = null;
personal.name = '';
personal.email = '';
personal.image = '';

// Create two variable with the names of the months and days in an array
var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
var dayNames = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"]
// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year

$(document).ready(function () {
	$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
	setInterval(function () {
		// Create a newDate() object and extract the seconds of the current time on the visitor's
		var seconds = new Date().getSeconds();
		// Add a leading zero to seconds value
		$("#sec").html((seconds < 10 ? "0" : "") + seconds);
	}, 1000);
	setInterval(function () {
		// Create a newDate() object and extract the minutes of the current time on the visitor's
		var minutes = new Date().getMinutes();
		// Add a leading zero to the minutes value
		$("#min").html((minutes < 10 ? "0" : "") + minutes);
	}, 1000);
	setInterval(function () {
		// Create a newDate() object and extract the hours of the current time on the visitor's
		var hours = new Date().getHours();
		// Add a leading zero to the hours value
		$("#hours").html((hours < 10 ? "0" : "") + hours);
	}, 1000);

	$('#fbLogin').click(function(){
		fbLogin();
		return false;
	});
	$('#salir').click(function () {
		if (personal.login == 'google') {
			signOut();
		} else if (personal.login == 'facebook') {
			fbLogOut();
		}
		return false;
	});
});

function botones() {
	$('#bloqueSignIn').toggle();
	$('#bloqueSignOut').toggle();
}

function verDatos() {
	$('#imagen').attr('src', personal.image);
	$('#nombre').html(personal.name);
	registrarAsistencia();
}

function registrarAsistencia() {
	if (personal.login != null) {
		$.ajax({
			url:baseUrl + '/registrarAsistencia',
			data:'login='+personal.login+'&email=' + personal.email,
			error:function () {
				//console.log('error');
			},
			dataType:'text',
			success:function (data) {
				$('#hora').html(data);
			},
			type:'POST'
		});
	}
}

// SDK DE GOOGLE
function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	personal.login = 'google';
	personal.name = profile.getName();
	personal.email = profile.getEmail();
	personal.image = profile.getImageUrl();
	botones();
	verDatos();
}

function signOut() {
	botones();
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		//console.log('User signed out.');
	});
}

// SDK DE FACEBOOK
window.fbAsyncInit = function () {
	FB.init({
		appId: '1238616539531033',
		cookie: true, // enable cookies to allow the server to access 
		// the session
		xfbml: true, // parse social plugins on this page
		version: 'v2.5' // use graph api version 2.5
	});
};

function fbLogin() {
	FB.login(function (response) {
		if (response.authResponse) {
			FB.api('/me', { locale: 'es_LA', fields: 'name, email' }, function (response) {
				personal.login = 'facebook';
				personal.name = response.name;
				personal.email = response.email;
				personal.image = 'http://graph.facebook.com/' + response.id + '/picture?type=normal';
				botones();
				verDatos();
			});
		} else {
			personal.login = null;
		}
	});
}

function fbLogOut() {
	botones();
	FB.logout(function(response) {
		// user is now logged out
	});
}
