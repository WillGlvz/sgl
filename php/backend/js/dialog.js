function exito(){
	swal({   
		title: "Mensaje de éxito",   
		text: "Este es un mensaje de éxito",   
		type: "success",   
		confirmButtonText: "Aceptar" 
	});
}

function atencion(){
	swal({   
		title: "Atención",   
		text: "Este es un mensaje de atención",   
		type: "info",   
		confirmButtonText: "Aceptar" 
	});
}

function error(){
	swal({   
		title: "Error",   
		text: "Este es un mensaje de error",   
		type: "error",   
		confirmButtonText: "Aceptar" 
	});
}

function camposVacios(){
	swal({   
		title: "Campos vacíos",   
		text: "!No puedes dejar campos en blanco¡",   
		type: "warning",   
		confirmButtonText: "Aceptar" 
	});
}