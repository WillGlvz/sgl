/* 
								▒█▄░▒█ █▀▀█ 　 █▀▀█ █▀▀█ █▀▀▄ █▀▀█ █▀▀█ █▀▀█ █▀▀ 　 
								▒█▒█▒█ █░░█ 　 █▄▄▀ █░░█ █▀▀▄ █▄▄█ █▄▄▀ █▄▄█ ▀▀█ 　 
								▒█░░▀█ ▀▀▀▀ 　 ▀░▀▀ ▀▀▀▀ ▀▀▀░ ▀░░▀ ▀░▀▀ ▀░░▀ ▀▀▀ 　 

								█▀▀ █░░ 　 █▀▀ █▀▀█ █▀▀▄ ░▀░ █▀▀▀ █▀▀█ 　 █▀▀▄ █▀▀ 
								█▀▀ █░░ 　 █░░ █░░█ █░░█ ▀█▀ █░▀█ █░░█ 　 █░░█ █▀▀ 
								▀▀▀ ▀▀▀ 　 ▀▀▀ ▀▀▀▀ ▀▀▀░ ▀▀▀ ▀▀▀▀ ▀▀▀▀ 　 ▀▀▀░ ▀▀▀ 

								▀▀█▀▀ █░░█ 　 █▀▀█ █▀▀█ █▀▀█ ░░▀ ░▀░ █▀▄▀█ █▀▀█ 
								░░█░░ █░░█ 　 █░░█ █▄▄▀ █░░█ ░░█ ▀█▀ █░▀░█ █░░█ 
								░░▀░░ ░▀▀▀ 　 █▀▀▀ ▀░▀▀ ▀▀▀▀ █▄█ ▀▀▀ ▀░░░▀ ▀▀▀▀ 
*/

function validar(){
	var correo = document.getElementById("correo").value;
	var asunto = document.getElementById("asunto").value;
	var mensaje = document.getElementById("mensaje").value;
	if (correo == "" || asunto == "" || mensaje == "") {
		camposVacios();
		return false;
	}
}

function validar2(){
	var nit = document.getElementById("nit").value;
	var pass = document.getElementById("pass").value;
	if(nit == "" || pass == ""){
		camposVacios();
		return false;
	}
}

function Patron(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
	if (tecla==9) return true;
	if (tecla==11) return true;
    patron = /[1234567890-\s\t]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}