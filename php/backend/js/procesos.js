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

function PrimerAdmin(){
	var nombre = document.getElementById("nom").value;
	var apellidos = document.getElementById("ape").value;
	var usuario = document.getElementById("usu").value;
	var correo = document.getElementById("corr").value;
	var pass = document.getElementById("passx1").value;
	var pass1 = document.getElementById("passx2").value;
	var ruta = "http://localhost/SGL/php/backend/img/default.jpg";
	if(!(pass == pass1)){
		swal("¡Aviso!", "Las claves no coinciden.", "warning");
		document.getElementById("passx2").value = "";
		document.getElementById("passx1").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/security/primeradmin.php',
			data: ("txtnombre="+nombre+"&txtapellidos="+apellidos+"&txtusuario="+usuario+"&txtcorreo="+correo+"&txtcontra="+pass),
			success: function(data){
				console.log(data);
				if(data == 1){
					swal("¡Completado!", "Datos agregados con éxito." + "\nIngrese a "+ correo + " para continuar.", "success");
					setTimeout(function(){ window.location="http://localhost/SGL"; }, 10000);
				}else if(data == 2){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}else if(data == 3){
					swal("¡Completado!", "Datos agregados con éxito." + "\nIngrese a "+ correo + " para continuar.", "success");
					setTimeout(function(){ window.location="http://localhost/SGL"; }, 10000);
				}else if(data == 4){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function ChangePass(){
	var actual = document.getElementById("passx0").value;
	var pass = document.getElementById("passx1").value;
	var pass1 = document.getElementById("passx2").value;
	if(!(pass == pass1)){
		swal("¡Aviso!", "Las claves no coinciden.", "warning");
		document.getElementById("passx2").value = "";
		document.getElementById("passx1").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'cambiar_contra2.php',
			data: ("txtcontra0="+actual+"&txtcontra="+pass),
			success: function(data){
				console.log(data);
				if(data == 1){
					swal("¡Completado!", "Clave modificada con exito, se cerrará la sesión", "success");
					setTimeout(function(){ window.location="http://localhost/SGL/admin/log-out"; }, 3000);
				}else if(data == 2){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}else if(data == 3){
					swal("¡Atención!", "Datos incorrectos", "warning");
					document.getElementById("passx0").value = "";
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function AgregarAdmin(){
	var nombre = document.getElementById("nombr").value;
	var apellidos = document.getElementById("apell").value;
	var nir = document.getElementById("nit").value;
	var correo = document.getElementById("correo").value;
	var tipo = document.getElementById("tipo").value;
	var estado = document.getElementById("estado").value;
	var pass = document.getElementById("pass").value;
	var pass1 = document.getElementById("pass1").value;
	var ruta = "http://localhost/SGL/php/backend/img/default.jpg";
	if(!(pass == pass1)){
		swal("¡Aviso!", "Las claves no coinciden.", "warning");
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_admin/scrud/create.php',
			data: ("txtnombre="+nombre+"&txtapellidos="+apellidos+"&txtnit="+nir+"&txtcorreo="
				+correo+"&fileperfil="+ruta+"&cmbtipo="+tipo+"&cmbestado="+estado+"&txtpass="+pass),
			success: function(data){
				if (data == 1) {
					swal("¡Aviso!", "El usuario que ingresaste ya existe, ingresa otro.", "error");
					document.getElementById("nit").value = "";
					document.getElementById("nit").focus();
				}else if(data == 2){
					swal("¡Aviso!", "El correo que ingresaste ya existe, ingresa otro.", "error");
					document.getElementById("correo").value = "";
					document.getElementById("correo").focus();
				}else if(data == 3){
					swal("¡Completado!", "Datos agregados con éxito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/users";}, 2000);
				}else if(data == 4){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function AgregarMerc(){
	var numdm = document.getElementById("dm").value;
	var codigo = document.getElementById("cod").value;
	var nombre = document.getElementById("nombre").value;
	var preciou = document.getElementById("preciou").value;
	var preciov = document.getElementById("preciov").value;
	var numcajas = document.getElementById("cajas").value;
	var canxcaja = document.getElementById("cantcaja").value;
	var ml = document.getElementById("ml").value;
	var porcalc = document.getElementById("porc").value;
	var brutoti = document.getElementById("bru").value;
	var tipo = document.getElementById("tipo").value;
	var empre = document.getElementById("empre").value;
	var porcali = document.getElementById("porcalc").value;
	var porcelc = document.getElementById("porcelc").value;
	var porcdai = document.getElementById("porcdai").value;
	var fob = document.getElementById("fob").value;
	var seguros = document.getElementById("seguros").value;
	var gastos = document.getElementById("gastos").value;
	var flete = document.getElementById("flete").value;
	var valor = parseFloat(numcajas) * parseFloat(preciou);
	var botellas = parseInt(numcajas) * parseInt(canxcaja);
	var litros = (parseFloat(botellas) * parseFloat(ml)) / 1000;
	var alicuota = (parseFloat(litros) * parseFloat(porcalc)) * parseFloat(porcali);
	var elc = ((parseFloat(preciov) * parseFloat(botellas)) * parseFloat(porcelc)) / 100;
	var pbc = (parseFloat(brutoti) / parseFloat(numcajas)) * parseFloat(numcajas);
	var flete1 = (parseFloat(flete) / parseFloat(fob)) * parseFloat(valor);
	var seguros1 = (parseFloat(seguros) / parseFloat(fob)) * parseFloat(valor);
	var gastos1 = (parseFloat(gastos) / parseFloat(fob)) * parseFloat(valor);
	var cif1 = parseFloat(valor) + parseFloat(flete1) + parseFloat(seguros1) + parseFloat(gastos1);
	var Cif = document.getElementById("cif").value = cif1;
	var Pbc = document.getElementById("pbc").value = pbc;
	var dai = (parseFloat(cif1) * parseFloat(porcdai)) / 100;
	var Dai = document.getElementById("dai").value = dai;
	var Flete = document.getElementById("flete1").value = flete1;
	var Gastos = document.getElementById("gastos1").value = gastos1;
	var Seguros = document.getElementById("seguros1").value = seguros1;
	var Valor = document.getElementById("valor").value = valor;
	var Botellas = document.getElementById("botellas").value = botellas;
	var Litros = document.getElementById("litros").value = litros;
	var Alicuota = document.getElementById("alicuota").value = alicuota;
	var Elc = document.getElementById("elc").value = elc;
	if(parseInt(codigo) <= 0){
		swal("¡Aviso!", "El código de mercancía debe ser mayor a 0", "error");
		document.getElementById("cod").value = "";
	}else if(parseInt(codigo) > 9999999999){
		swal("¡Aviso!", "Ingrese un numero de mercancía menor", "error");
		document.getElementById("cod").value = "";
	}else if(parseInt(numcajas) <= 0){
		swal("¡Aviso!", "El número de cajas debe ser mayor a 0", "error");
		document.getElementById("cajas").value = "";
	}else if(parseInt(numcajas) > 9999999999){
		swal("¡Aviso!", "El número de cajas debe ser menor a 9999999999", "error");
		document.getElementById("cajas").value= "";
	}else if(parseFloat(preciou) <= 0){
		swal("¡Aviso!", "El precio unitario debe ser mayor a 0", "error");
		document.getElementById("preciou").value = "";
	}else if(parseFloat(preciou) > 9999.99){
		swal("¡Aviso!", "Ingrese un precio unitario menor", "error");
		document.getElementById("preciou").value = "";
	}else if(parseFloat(preciov) > 9999.99){
		swal("¡Aviso!", "Ingrese un precio de venta menor", "error");
		document.getElementById("preciov").value = "";
	}else if(parseInt(canxcaja) <= 0){
		swal("¡Aviso!", "La cantidad de unidades por caja debe ser mayor a 0", "error");
		document.getElementById("cantcaja").value = "";
	}else if(parseInt(canxcaja) > 48){
		swal("¡Aviso!", "La cantidad de unidades por caja debe ser menor a 48", "error");
		document.getElementById("cantcaja").value = "";
	}else if(parseInt(ml) <= 0){
		swal("¡Aviso!", "Los mililítros deben ser mayor a 0", "error");
		document.getElementById("ml").value = "";
	}else if(parseInt(ml) > 99999){
		swal("¡Aviso!", "Los mililítros debe ser menor a 99999", "error");
		document.getElementById("ml").value = "";
	}else if(parseFloat(porcalc) > 9999.99){
		swal("¡Aviso!", "El porcentaje de alcohol debe ser menor a 9999.99", "error");
		document.getElementById("porc").value = "";
	}else if(parseFloat(brutoti) <= 0){
		swal("¡Aviso!", "El bruto TI debe ser mayor a 0", "error");
		document.getElementById("bru").value = "";
	}else if(parseFloat(brutoti) > 99999.99){
		swal("¡Aviso!", "El bruto TI debe ser menor a 99999.99", "error");
		document.getElementById("bru").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_merc/scrud/create.php',
			data: ("txtcodigo="+codigo+"&txtnombre="+nombre+"&txtcajas="+numcajas+"&txtpreciou="+preciou+"&txtvalor="+Valor+
				"&txtpreciov="+preciov+"&txtcantcaja="+canxcaja+"&txtml="+ml+"&txtporc="+porcalc+"&txtbotellas="+Botellas+
				"&txtlitros="+Litros+"&txtbru="+brutoti+"&txtpbc="+Pbc+"&txtporcalc="+porcali+"&txtalicuota="+Alicuota+"&txtporcelc="+porcelc+
				"&txtelc="+Elc+"&txtflete1="+Flete+"&txtgastos1="+Gastos+"&txtseguros1="+Seguros+"&txtcif="+Cif+"&txtporcdai="+porcdai+
				"&txtdai="+Dai+"&cmbtipo="+tipo+"&cmbempre="+empre+"&cmbdm="+numdm),
			success: function(data){
				console.log(data);
				if (data == 1) {
					swal("¡Aviso!", "El número DM que escogiste ya esta en úso, escoge otro", "error");
				}else if(data == 2){
					swal("¡Completado!", "Datos agregados con éxito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight";}, 2000);
				}else if(data == 3){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				console.log(data);
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function AgregarDM(){
	var numero = document.getElementById("numero").value;
	var fob = document.getElementById("fob").value;
	var flete = document.getElementById("flete").value;
	var seguros = document.getElementById("seguros").value;
	var gastos = document.getElementById("gastos").value;
	var bultos = document.getElementById("bultos").value;
	var suma = parseFloat(fob) + parseFloat(flete) + parseFloat(seguros) + parseFloat(gastos);
	var cif = document.getElementById("cif").value = suma;
	var fecha = new Date();
	var anio = fecha.getFullYear();
	var num3 = anio - 1;
	var num4 = num3 * 10000;
	var num5 = num4 + 9999;
	var num = anio * 10000;
	var num2 = num + 9999;
	if(parseFloat(numero) <= num5){
		swal("¡Aviso!", "El número debe ser mayor a " + num5, "warning");
		document.getElementById("numero").value = "";
	}else if(parseFloat(flete) <= 0){
		swal("¡Aviso!", "El Flete debe ser mayor a 0", "warning");
		document.getElementById("flete").value = "";
	}else if(parseFloat(seguros) <= 0){
		swal("¡Aviso!", "El Seguro debe ser mayor a 0", "warning");
		document.getElementById("seguros").value = "";
	}else if(parseFloat(gastos) < 0){
		swal("¡Aviso!", "El gasto debe ser mayor o igual a 0", "warning");
		document.getElementById("gastos").value = "";
	}else if(parseInt(numero) > num2){
		swal("¡Aviso!", "El número no puede ser mayor a "+num2, "error");
		document.getElementById("numero").value = "";
	}else if(parseInt(flete) > 9999999.99){
		swal("¡Aviso!", "El Flete no puede ser mayor a 9999999.99", "error");
		document.getElementById("flete").value = "";
	}else if(parseInt(seguros) > 9999999.99){
		swal("¡Aviso!", "El Seguro no puede ser mayor a 9999999.99", "error");
		document.getElementById("seguros").value = "";
	}else if(parseInt(gastos) > 9999999.99){
		swal("¡Aviso!", "El gasto no puede ser mayor a 9999999.99", "error");
		document.getElementById("gastos").value = "";
	}else if(parseInt(bultos) <= 0){
		swal("¡Aviso!", "Los bultos deben ser mayor a 0", "warning");
		document.getElementById("bultos").value = "";
	}else if(parseInt(bultos) > 9999999){
		swal("¡Aviso!", "El gasto no puede ser mayor a 9999999", "error");
		document.getElementById("bultos").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_dm/scrud/create.php',
			data: ("txtnumero="+numero+"&txtfob="+fob+"&txtflete="+flete+"&txtseguros="+seguros+"&txtgastos="+gastos+"&txtbultos="+bultos+"&txtcif="+cif),
			success: function(data){
				console.log(data);
				if (data == 1) {
					swal("¡Aviso!", "El número que ingresaste ya existe, ingresa otro.", "error");
					document.getElementById("numero").value = "";
					document.getElementById("numero").focus();
				}else if(data == 2){
					swal("¡Completado!", "Datos agregados con éxito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/dm-number";}, 2000);
				}else if(data == 3){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}else if(data == 4){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				console.log(data);
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function AgregarTipom(){
	var nombre = document.getElementById("nombr").value;
	var descripcion = document.getElementById("descr").value;
	$.ajax({
		type: 'POST',
		url: 'http://localhost/SGL/php/backend/mnt_tipom/scrud/create.php',
		data: ("txtnombre="+nombre+"&txtdescripcion="+descripcion),
		success: function(data){
			if (data == 1) {
				swal("¡Aviso!", "El tipo de mercancía que ingresaste ya existe, ingresa otro.", "error");
				document.getElementById("nombr").value = "";
				document.getElementById("nombr").focus();
			}else if(data == 2){
				swal("¡Completado!", "Datos agregados con éxito.", "success");
				setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight-kinds";}, 2000);
			}else if(data == 3){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}else if(data == 4){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		},
		error: function(data){
			swal("¡Aviso!", "Ha ocurrido algún error.", "error");
		}
	});
}

function AgregarEmpre(){
	var nombre = document.getElementById("nombr").value;
	var descripcion = document.getElementById("descr").value;
	var direccion = document.getElementById("dir").value;
	var telefono = document.getElementById("tel").value;
	var correo = document.getElementById("correo").value;
	var nit = document.getElementById("nit").value;
	var nrc = document.getElementById("nrc").value;
	var contacto = document.getElementById("cont").value;
	var telcont = document.getElementById("conttel").value;
	var corcont = document.getElementById("cortel").value;
	var muni = document.getElementById("muni").value;
	var pass1 = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass1").value;
	if(!(pass1 == pass2)){
		swal("¡Aviso!", "Las contraseñas no coinciden.", "warning");
		document.getElementById("pass").value = "";
		document.getElementById("pass1").value = "";
		document.getElementById("pass").focus();
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_empresas/scrud/create.php',
			data: ("txtnombre="+nombre+"&txtdescripcion="+descripcion+"&txtdireccion="+direccion+"&txttel="
				+telefono+"&txtcorreo="+correo+"&txtnit="+nit+"&txtnrc="+nrc+"&txtcont="+contacto+"&txtcontel="+telcont
				+"&txtconcor="+corcont+"&cmbmunicipios="+muni+"&txtpass="+pass1),
			success: function(data){
				console.log(data);
				if (data == 1) {
					swal("¡Aviso!", "El nombre de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("nombr").value = "";
					document.getElementById("nombr").focus();
				}else if(data == 2){
					swal("¡Aviso!", "El teléfono de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("tel").value = "";
					document.getElementById("tel").focus();
				}else if(data == 3){
					swal("¡Aviso!", "El correo de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("correo").value = "";
					document.getElementById("correo").focus();
				}else if(data == 4){
					swal("¡Aviso!", "El NIT de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("nit").value = "";
					document.getElementById("nit").focus();
				}else if(data == 5){
					swal("¡Aviso!", "El NRC de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("nrc").value = "";
					document.getElementById("nrc").focus();
				}else if(data == 6){
					swal("¡Aviso!", "El teléfono del contacto de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("conttel").value = "";
					document.getElementById("conttel").focus();
				}else if(data == 7){
					swal("¡Aviso!", "El correo del contacto de la empresa que ingresaste ya existe, ingresa otro.", "warning");
					document.getElementById("cortel").value = "";
					document.getElementById("cortel").focus();
				}else if(data == 8){
					document.getElementById("cortel").value = "";
					swal("¡Completado!", "Datos agregados con éxito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/enterprise";}, 2000);
				}else if(data == 9){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function ModificarEmpre(){
	var nombre = document.getElementById("nombr2").value;
	var descripcion = document.getElementById("descr2").value;
	var direccion = document.getElementById("dir2").value;
	var telefono = document.getElementById("tel2").value;
	var correo = document.getElementById("correo2").value;
	var nit = document.getElementById("nit2").value;
	var nrc = document.getElementById("nrc2").value;
	var contacto = document.getElementById("cont2").value;
	var telcont = document.getElementById("conttel2").value;
	var corcont = document.getElementById("cortel2").value;
	var muni = document.getElementById("muni2").value;
	var idd = document.getElementById("id3").value;
	$.ajax({
		type: 'POST',
		url: 'http://localhost/SGL/php/backend/mnt_empresas/scrud/update.php?id='+idd,
		data: ("txtnombre2="+nombre+"&txtdescripcion2="+descripcion+"&txtdireccion2="+direccion+"&txttel2="
			+telefono+"&txtcorreo2="+correo+"&txtnit2="+nit+"&txtnrc2="+nrc+"&txtcont2="+contacto+"&txtcontel2="+telcont
			+"&txtconcor2="+corcont+"&cmbmunicipios2="+muni+"&id3="+idd),
		success: function(data){
			if (data == 1) {
				swal("¡Aviso!", "El nombre de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("nombr2").value = "";
				document.getElementById("nombr2").focus();
			}else if(data == 2){
				swal("¡Aviso!", "El teléfono de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("tel2").value = "";
				document.getElementById("tel2").focus();
			}else if(data == 3){
				swal("¡Aviso!", "El correo de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("correo2").value = "";
				document.getElementById("correo2").focus();
			}else if(data == 4){
				swal("¡Aviso!", "El NIT de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("nit2").value = "";
				document.getElementById("nit2").focus();
			}else if(data == 5){
				swal("¡Aviso!", "El NRC de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("nrc2").value = "";
				document.getElementById("nrc2").focus();
			}else if(data == 6){
				swal("¡Aviso!", "El teléfono del contacto de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("conttel2").value = "";
				document.getElementById("conttel2").focus();
			}else if(data == 7){
				swal("¡Aviso!", "El correo del contacto de la empresa que ingresaste ya existe, ingresa otro.", "warning");
				document.getElementById("cortel2").value = "";
				document.getElementById("cortel2").focus();
			}else if(data == 8){
				swal("¡Completado!", "Datos modificados con éxito.", "success");
				setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/enterprise";}, 2000);
			}else if(data == 9){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		},
		error: function(data){
			swal("¡Aviso!", "Ha ocurrido algún error.", "error");
		}
	});
}

function ModificarMerc(){
	var numdm = document.getElementById("dm2").value;
	var codigo = document.getElementById("cod2").value;
	var nombre = document.getElementById("nombre2").value;
	var preciou = document.getElementById("preciou2").value;
	var preciov = document.getElementById("preciov2").value;
	var numcajas = document.getElementById("cajas2").value;
	var canxcaja = document.getElementById("cantcaja2").value;
	var ml = document.getElementById("ml2").value;
	var porcalc = document.getElementById("porc2").value;
	var brutoti = document.getElementById("bru2").value;
	var tipo = document.getElementById("tipo2").value;
	var empre = document.getElementById("empre2").value;
	var porcali = document.getElementById("porcalc2").value;
	var porcelc = document.getElementById("porcelc2").value;
	var porcdai = document.getElementById("porcdai2").value;
	var fob = document.getElementById("fob2").value;
	var seguros = document.getElementById("seguros2").value;
	var gastos = document.getElementById("gastos2").value;
	var flete = document.getElementById("flete2").value;
	var idd = document.getElementById("id3").value;
	var valor = parseFloat(numcajas) * parseFloat(preciou);
	var botellas = parseInt(numcajas) * parseInt(canxcaja);
	var litros = (parseFloat(botellas) * parseFloat(ml)) / 1000;
	var alicuota = (parseFloat(litros) * parseFloat(porcalc)) * parseFloat(porcali);
	var elc = ((parseFloat(preciov) * parseFloat(botellas)) * parseFloat(porcelc)) / 100;
	var pbc = (parseFloat(brutoti) / parseFloat(numcajas)) * parseFloat(numcajas);
	var flete1 = (parseFloat(flete) / parseFloat(fob)) * parseFloat(valor);
	var seguros1 = (parseFloat(seguros) / parseFloat(fob)) * parseFloat(valor);
	var gastos1 = (parseFloat(gastos) / parseFloat(fob)) * parseFloat(valor);
	var cif1 = parseFloat(valor) + parseFloat(flete1) + parseFloat(seguros1) + parseFloat(gastos1);
	var Cif = document.getElementById("cif2").value = cif1;
	var Pbc = document.getElementById("pbc2").value = pbc;
	var dai = (parseFloat(cif1) * parseFloat(porcdai)) / 100;
	var Dai = document.getElementById("dai2").value = dai;
	var Flete = document.getElementById("flete12").value = flete1;
	var Gastos = document.getElementById("gastos12").value = gastos1;
	var Seguros = document.getElementById("seguros12").value = seguros1;
	var Valor = document.getElementById("valor2").value = valor;
	var Botellas = document.getElementById("botellas2").value = botellas;
	var Litros = document.getElementById("litros2").value = litros;
	var Alicuota = document.getElementById("alicuota2").value = alicuota;
	var Elc = document.getElementById("elc2").value = elc;
	if(parseInt(codigo) <= 0){
		swal("¡Aviso!", "El código de mercancía debe ser mayor a 0", "error");
		document.getElementById("cod2").value = "";
	}else if(parseInt(codigo) > 9999999999){
		swal("¡Aviso!", "Ingrese un numero de mercancía menor", "error");
		document.getElementById("cod2").value = "";
	}else if(parseInt(numcajas) <= 0){
		swal("¡Aviso!", "El número de cajas debe ser mayor a 0", "error");
		document.getElementById("cajas2").value = "";
	}else if(parseInt(numcajas) > 9999999999){
		swal("¡Aviso!", "El número de cajas debe ser menor a 9999999999", "error");
		document.getElementById("cajas2").value= "";
	}else if(parseFloat(preciou) <= 0){
		swal("¡Aviso!", "El precio unitario debe ser mayor a 0", "error");
		document.getElementById("preciou2").value = "";
	}else if(parseFloat(preciou) > 9999.99){
		swal("¡Aviso!", "Ingrese un precio unitario menor", "error");
		document.getElementById("preciou2").value = "";
	}else if(parseFloat(preciov) > 9999.99){
		swal("¡Aviso!", "Ingrese un precio de venta menor", "error");
		document.getElementById("preciov2").value = "";
	}else if(parseInt(canxcaja) <= 0){
		swal("¡Aviso!", "La cantidad de unidades por caja debe ser mayor a 0", "error");
		document.getElementById("cantcaja2").value = "";
	}else if(parseInt(canxcaja) > 48){
		swal("¡Aviso!", "La cantidad de unidades por caja debe ser menor a 48", "error");
		document.getElementById("cantcaja2").value = "";
	}else if(parseInt(ml) <= 0){
		swal("¡Aviso!", "Los mililítros deben ser mayor a 0", "error");
		document.getElementById("ml2").value = "";
	}else if(parseInt(ml) > 99999){
		swal("¡Aviso!", "Los mililítros debe ser menor a 99999", "error");
		document.getElementById("ml2").value = "";
	}else if(parseFloat(porcalc) > 9999.99){
		swal("¡Aviso!", "El porcentaje de alcohol debe ser menor a 9999.99", "error");
		document.getElementById("porc2").value = "";
	}else if(parseFloat(brutoti) <= 0){
		swal("¡Aviso!", "El bruto TI debe ser mayor a 0", "error");
		document.getElementById("bru2").value = "";
	}else if(parseFloat(brutoti) > 99999.99){
		swal("¡Aviso!", "El bruto TI debe ser menor a 99999.99", "error");
		document.getElementById("bru2").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_merc/scrud/update.php',
			data: ("txtcodigo2="+codigo+"&txtnombre2="+nombre+"&txtcajas2="+numcajas+"&txtpreciou2="+preciou+"&txtvalor2="+Valor+
				"&txtpreciov2="+preciov+"&txtcantcaja2="+canxcaja+"&txtml2="+ml+"&txtporc2="+porcalc+"&txtbotellas2="+Botellas+
				"&txtlitros2="+Litros+"&txtbru2="+brutoti+"&txtpbc2="+Pbc+"&txtporcalc2="+porcali+"&txtalicuota2="+Alicuota+"&txtporcelc2="+porcelc+
				"&txtelc2="+Elc+"&txtflete12="+Flete+"&txtgastos12="+Gastos+"&txtseguros12="+Seguros+"&txtcif2="+Cif+"&txtporcdai2="+porcdai+
				"&txtdai2="+Dai+"&cmbtipo2="+tipo+"&cmbempre2="+empre+"&cmbdm2="+numdm+"&id3="+idd),
			success: function(data){
				if (data == 1) {
					swal("¡Completado!", "Datos modificados con exito", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight/"+numdm;}, 2000);
				}else if(data == 2){
					swal("¡Error!", "Al parecer no se pudieron agregar los datos", "errrors");
				}
			},
			error: function(data){
				console.log(data);
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function cambiarV(){
	if(document.getElementById("tipou").checked == true){
		document.getElementById("tipou").value = "Tipos usuarios";
	}else if(document.getElementById("tipou").checked == false){
		document.getElementById("tipou").value = "";
	}
	if(document.getElementById("admin").checked == true){
		document.getElementById("admin").value = "Administradores";
	}else if(document.getElementById("admin").checked == false){
		document.getElementById("admin").value = "";
	}
	if(document.getElementById("empre").checked == true){
		document.getElementById("empre").value = "Empresas";
	}else if(document.getElementById("empre").checked == false){
		document.getElementById("empre").value = "";
	}
	if(document.getElementById("merc").checked == true){
		document.getElementById("merc").value = "Mercancías";
	}else if(document.getElementById("merc").checked == false){
		document.getElementById("merc").value = "";
	}
	if(document.getElementById("unim").checked == true){
		document.getElementById("unim").value = "Unidades de medida";
	}else if(document.getElementById("unim").checked == false){
		document.getElementById("unim").value = "";
	}
	if(document.getElementById("tipom").checked == true){
		document.getElementById("tipom").value = "Tipo mercancías";
	}else if(document.getElementById("tipom").checked == false){
		document.getElementById("tipom").value = "";
	}
	if(document.getElementById("comprob").checked == true){
		document.getElementById("comprob").value = "Comprobantes";
	}else if(document.getElementById("comprob").checked == false){
		document.getElementById("comprob").value = "";
	}
	if(document.getElementById("front").checked == true){
		document.getElementById("front").value = "Frontend";
	}else if(document.getElementById("front").checked == false){
		document.getElementById("front").value = "";
	}
}

function cambiarV2(){
	if(document.getElementById("tipou3").checked == true){
		document.getElementById("tipou3").value = "Tipos usuarios";
	}else if(document.getElementById("tipou3").checked == false){
		document.getElementById("tipou3").value = "";
	}
	if(document.getElementById("admin3").checked == true){
		document.getElementById("admin3").value = "Administradores";
	}else if(document.getElementById("admin3").checked == false){
		document.getElementById("admin3").value = "";
	}
	if(document.getElementById("empre3").checked == true){
		document.getElementById("empre3").value = "Empresas";
	}else if(document.getElementById("empre3").checked == false){
		document.getElementById("empre3").value = "";
	}
	if(document.getElementById("merc3").checked == true){
		document.getElementById("merc3").value = "Mercancías";
	}else if(document.getElementById("merc3").checked == false){
		document.getElementById("merc3").value = "";
	}
	if(document.getElementById("unim3").checked == true){
		document.getElementById("unim3").value = "Unidades de medida";
	}else if(document.getElementById("unim3").checked == false){
		document.getElementById("unim3").value = "";
	}
	if(document.getElementById("tipom3").checked == true){
		document.getElementById("tipom3").value = "Tipo mercancías";
	}else if(document.getElementById("tipom3").checked == false){
		document.getElementById("tipom3").value = "";
	}
	if(document.getElementById("comprob3").checked == true){
		document.getElementById("comprob3").value = "Comprobantes";
	}else if(document.getElementById("comprob3").checked == false){
		document.getElementById("comprob3").value = "";
	}
	if(document.getElementById("front3").checked == true){
		document.getElementById("front3").value = "Frontend";
	}else if(document.getElementById("front3").checked == false){
		document.getElementById("front3").value = "";
	}
}

function AgregarTipoAdmin(){
	var nombre = document.getElementById("nombr").value;
	var descripcion = document.getElementById("descr").value;
	var cargo = document.getElementById("cargo").value;
	var tipou = document.getElementById("tipou").value;
	var admin = document.getElementById("admin").value;
	var empre = document.getElementById("empre").value;
	var merc = document.getElementById("merc").value;
	var unim = document.getElementById("unim").value;
	var tipom = document.getElementById("tipom").value;
	var comprob = document.getElementById("comprob").value;
	var front = document.getElementById("front").value;
	if (!(document.getElementById("tipou").checked || document.getElementById("admin").checked ||
		document.getElementById("empre").checked || document.getElementById("merc").checked ||
		document.getElementById("unim").checked || document.getElementById("tipom").checked ||
		document.getElementById("comprob").checked || document.getElementById("front").checked)){
		swal("¡Aviso!", "Debes seleccionar al menos un permiso.", "warning");
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_tipoadmin/scrud/create.php',
			data: ("txtnombre="+nombre+"&txtdescripcion="+descripcion+"&cmbcargo="+cargo+"&chktipou="
				+tipou+"&chkadmin="+admin+"&chkempre="+empre+"&chkmerc="+merc+"&chkunim="+unim+"&chktipom="
				+tipom+"&chkcomprob="+comprob+"&chkfront="+front),
			success: function(data){
				if (data == 1){
					swal("¡Aviso!", "Este tipo de usuario ya existe, ingresa otro.", "warning");
					document.getElementById("nombr").value = "";
					document.getElementById("nombr").focus();
				}else if(data == 2){
					swal("¡Completado!", "Datos agregados con exito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/userprofiles"}, 2000);
				}else if(data == 3){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function ModificarAdmin(){
	var nombre2 = document.getElementById("nom").value;
	var apellidos2 = document.getElementById("ape").value;
	var nir2 = document.getElementById("ni").value;
	var correo2 = document.getElementById("cor").value;
	var tipo2 = document.getElementById("tip").value;
	var estado2 = document.getElementById("est").value;
	var idd = document.getElementById("id").value;
	$.ajax({
		type: 'POST',
		url: 'http://localhost/SGL/php/backend/mnt_admin/scrud/update.php?id='+idd,
		data: ("txtnombre2="+nombre2+"&txtapellidos2="+apellidos2+"&txtnit2="+nir2+"&txtcorreo2="
			+correo2+"&cmbtipo2="+tipo2+"&cmbestado2="+estado2+"&id2="+idd),
		success: function(data1){
			if (data1 == 1) {
				swal("¡Aviso!", "El usuario que ingresaste ya existe, ingresa otro.", "error");
				document.getElementById("ni").value = "";
				document.getElementById("ni").focus();
			}else if(data1 == 2){
				swal("¡Aviso!", "El correo que ingresaste ya existe, ingresa otro.", "error");
				document.getElementById("cor").value = "";
				document.getElementById("cor").focus();
			}else if(data1 == 3){
				swal("¡Completado!", "Datos modificados con éxito.", "success");
				objetoajax2(idd);
				objetoajax3(idd);
				setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/users";}, 2000);
			}else if(data1 == 4){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		},
		error: function(data1){
			swal("¡Aviso!", "Ha ocurrido algún error.", "error");
		}
	});
}

function ModificarDM(){
	var numero = document.getElementById("numero2").value;
	var fob = document.getElementById("fob2").value;
	var flete = document.getElementById("flete2").value;
	var seguros = document.getElementById("seguros2").value;
	var gastos = document.getElementById("gastos2").value;
	var suma = parseFloat(fob) + parseFloat(flete) + parseFloat(seguros) + parseFloat(gastos);
	var cif = document.getElementById("cif2").value = suma;
	var idd = document.getElementById("id").value;
	var fecha = new Date();
	var anio = fecha.getFullYear();
	var num3 = anio - 1;
	var num4 = num3 * 10000;
	var num5 = num4 + 9999;
	var num = anio * 10000;
	var num2 = num + 9999;
	if(parseFloat(numero) <= num5){
		swal("¡Aviso!", "El número debe ser mayor a " + num5, "warning");
		document.getElementById("numero2").value = "";
	}else if(parseFloat(fob) <= 0){
		swal("¡Aviso!", "El FOB debe ser mayor a 0", "warning");
		document.getElementById("fob2").value = "";
	}else if(parseFloat(flete) <= 0){
		swal("¡Aviso!", "El Flete debe ser mayor a 0", "warning");
		document.getElementById("flete2").value = "";
	}else if(parseFloat(seguros) <= 0){
		swal("¡Aviso!", "El Seguro debe ser mayor a 0", "warning");
		document.getElementById("seguros2").value = "";
	}else if(parseInt(numero) > num2){
		swal("¡Aviso!", "El número no puede ser mayor a "+num2, "error");
		document.getElementById("numero2").value = "";
	}else if(parseInt(fob) > 9999999.99){
		swal("¡Aviso!", "El FOB no puede ser mayor a 9999999.99", "error");
		document.getElementById("fob2").value = "";
	}else if(parseInt(flete) > 9999999.99){
		swal("¡Aviso!", "El Flete no puede ser mayor a 9999999.99", "error");
		document.getElementById("flete2").value = "";
	}else if(parseInt(seguros) > 9999999.99){
		swal("¡Aviso!", "El Seguro no puede ser mayor a 9999999.99", "error");
		document.getElementById("seguros2").value = "";
	}else if(parseInt(gastos) > 9999999.99){
		swal("¡Aviso!", "El gasto no puede ser mayor a 9999999.99", "error");
		document.getElementById("gastos2").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_dm/scrud/update.php?id='+idd,
			data: ("txtnumero2="+numero+"&txtfob2="+fob+"&txtflete2="+flete+"&txtseguros2="+seguros+"&txtgastos2="+gastos+"&txtcif2="+cif+"&id2="+idd),
			success: function(data){
				console.log(data);
				if (data == 1) {
					swal("¡Aviso!", "El número que ingresaste ya existe, ingresa otro.", "error");
					document.getElementById("numero2").value = "";
					document.getElementById("numero2").focus();
				}else if(data == 2){
					swal("¡Completado!", "Datos modificados con éxito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/dm-number";}, 2000);
				}else if(data == 3){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}else if(data == 4){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data1){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function ModificarTipom(){
	var nombre2 = document.getElementById("nom").value;
	var descripcion2 = document.getElementById("descr2").value;
	var idd = document.getElementById("id").value;
	$.ajax({
		type: 'POST',
		url: 'http://localhost/SGL/php/backend/mnt_tipom/scrud/update.php?id='+idd,
		data: ("txtnombre2="+nombre2+"&txtdescripcion2="+descripcion2+"&id2="+idd),
		success: function(data1){
			if (data1 == 1) {
				swal("¡Aviso!", "El tipo de mercancía que ingresaste ya existe, ingresa otro.", "error");
				document.getElementById("nom").value = "";
				document.getElementById("nom").focus();
			}else if(data1 == 2){
				swal("¡Completado!", "Datos modificados con éxito.", "success");
				setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight-kinds";}, 2000);
			}else if(data1 == 3){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		},
		error: function(data1){
			swal("¡Aviso!", "Ha ocurrido algún error.", "error");
		}
	});
}

function ModificarTipoAdmin(){
	var nombre = document.getElementById("nombr3").value;
	var descripcion = document.getElementById("descr3").value;
	var cargo = document.getElementById("cargo3").value;
	var tipou = document.getElementById("tipou3").value;
	var admin = document.getElementById("admin3").value;
	var empre = document.getElementById("empre3").value;
	var merc = document.getElementById("merc3").value;
	var unim = document.getElementById("unim3").value;
	var tipom = document.getElementById("tipom3").value;
	var comprob = document.getElementById("comprob3").value;
	var front = document.getElementById("front3").value;
	var idd = document.getElementById("id3").value;
	if (!(document.getElementById("tipou3").checked || document.getElementById("admin3").checked ||
		document.getElementById("empre3").checked || document.getElementById("merc3").checked ||
		document.getElementById("unim3").checked || document.getElementById("tipom3").checked ||
		document.getElementById("comprob3").checked || document.getElementById("front3").checked)){
		swal("¡Aviso!", "Debes seleccionar al menos un permiso.", "warning");
	}else{
		$.ajax({
			type: 'POST',
			url: 'http://localhost/SGL/php/backend/mnt_tipoadmin/scrud/update.php?id='+idd,
			data: ("txtnombre3="+nombre+"&txtdescripcion3="+descripcion+"&cmbcargo3="+cargo+"&chktipou3="
				+tipou+"&chkadmin3="+admin+"&chkempre3="+empre+"&chkmerc3="+merc+"&chkunim3="+unim+"&chktipom3="
				+tipom+"&chkcomprob3="+comprob+"&chkfront3="+front+"&id3="+idd),
			success: function(data){
				if (data == 1){
					swal("¡Aviso!", "Este tipo de usuario ya existe, ingresa otro.", "warning");
					document.getElementById("nombr3").value = "";
					document.getElementById("nombr3").focus();
				}else if(data == 2){
					swal("¡Completado!", "Datos modificados con exito.", "success");
					setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/userprofiles"}, 2000);
				}else if(data == 3){
					swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				}
			},
			error: function(data){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
			}
		});
	}
}

function objetoAjaxx(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {

	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function Search(){
	Q = document.getElementById("search").value;
	R = document.getElementById("ctime");
	ObjAjax = objetoAjaxx();
	ObjAjax.open("GET", "process.php?id="+Q);
	ObjAjax.onreadystatechange = function() {
		if(ObjAjax.readyState == 4){
			R.innerHTML = ObjAjax.responseText;
		}
	}
	ObjAjax.send(null);
}

function MostrarMerc(){
	var numerodm = document.getElementById("numberdm").value;
	if(numerodm == ""){
		swal("¡Aviso!", "Debe elegir un número.", "warning");
	}else{
		window.location="http://localhost/SGL/admin/cpanel/freight/"+numerodm;
	}
}

function MostrarMerca(){
	var numerodm = document.getElementById("numberdm").value;
	if(numerodm == ""){
		swal("¡Aviso!", "Debe elegir un número.", "warning");
	}else{
		window.location="http://localhost/SGL/php/backend/enterprise/mercancias.php?dm="+numerodm;
	}
}

function objetoajax(){
	var segundos = 2;
	var url = "proceso.php";
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ctime').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function objetoajax2(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_tipoadmin/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function actadmin(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_admin/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function actempre(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_empresas/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function actdm(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_dm/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function acttipom(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_tipom/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function actmerc(para2){
	var segundos = 50000;
	var url = "http://localhost/SGL/php/backend/mnt_merc/actualizar.php?id="+para2;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax2()',segundos*1000);
         }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function objetoajax3(param){
	var segundos = 500000;
	var url = "http://localhost/SGL/php/backend/mnt_tipoadmin/scrud/read.php?id="+param;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct2').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax3()',segundos*1000);
         }
    }
    xmlHttp.open(null,url,true);
    xmlHttp.send(null);
    pass2 = null;
}

function verfica(){
	var segundos = 1;
	var url = "http://localhost/SGL/php/backend/enterprise/verfica.php";
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('veri').innerHTML=xmlHttp.responseText;
            setTimeout('verfica()',segundos*1000);
         }
    }
    xmlHttp.open(null,url,true);
    xmlHttp.send(null);
    pass2 = null;
}

function mostraradmin(param){
	var segundos = 500000;
	var url = "http://localhost/SGL/php/backend/mnt_admin/scrud/read.php?id="+param;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct2').innerHTML=xmlHttp.responseText;
            setTimeout('objetoajax3()',segundos*1000);
         }
    }
    xmlHttp.open(null,url,true);
    xmlHttp.send(null);
    pass2 = null;
}

function mostrarempre(param){
	var segundos = 500000;
	var url = "http://localhost/SGL/php/backend/mnt_empresas/scrud/read.php?id="+param;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct2').innerHTML=xmlHttp.responseText;
            setTimeout('mostrarempre()',segundos*1000);
         }
    }
    xmlHttp.open(null,url,true);
    xmlHttp.send(null);
    pass2 = null;
}

function mostrarmerc(param){
	var segundos = 500000;
	var url = "http://localhost/SGL/php/backend/mnt_merc/scrud/read.php?id="+param;
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
			document.getElementById('ct2').innerHTML=xmlHttp.responseText;
            setTimeout('mostrarempre()',segundos*1000);
         }
    }
    xmlHttp.open(null,url,true);
    xmlHttp.send(null);
    pass2 = null;
}

function ir(para){
	objetoajax3(para);
	$('.nav-tabs li:eq(5) a').tab('show')
}

function irmerc(para){
	mostrarmerc(para);
	$('.nav-tabs li:eq(5) a').tab('show')
}

function irempre(para){
	mostrarempre(para);
	$('.nav-tabs li:eq(5) a').tab('show')
}

function iradmin(para){
	mostraradmin(para);
	$('.nav-tabs li:eq(5) a').tab('show')
}

function ir2(para){
	objetoajax2(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function ir2merc(para){
	actmerc(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function ir2tipom(para){
	acttipom(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function ir2dm(para){
	actdm(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function ir2empre(para){
	actempre(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function ir2admin(para){
	actadmin(para);
	$('.nav-tabs li:eq(4) a').tab('show')
}

function EliminarAdmin(parame){
	swal({
		title: "¡Eliminar administrador!",
		text: "¿Realmente desea eliminar este administrador?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_admin/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						console.log(data2);
						if(data2 == 1){
							swal("¡Aviso!", "No puedes eliminar tu propio usuario.", "error");
						}else if(data2 == 2){
							swal("¡Aviso!", "No puedes eliminar al administrador principal.", "error");
						}else if(data2 == 3){
							swal("¡Completado!", "Administrador eliminado con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/users";}, 2000);
						}else if(data2 == 4){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						console.log(data2);
					}
				});
			} else {}
		});
}

function EliminarMercRet(parame){
	swal({
		title: "¡Eliminar mercancía retirada!",
		text: "¿Realmente desea eliminar esta mercancía?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/enterprise/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						console.log(data2);
						if(data2 == 3){
							swal("¡Completado!", "Mercancía eliminada con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/php/backend/enterprise/comprobante.php";}, 2000);
						}else if(data2 == 4){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						console.log(data2);
					}
				});
			} else {}
		});
}

function EliminarMerc(parame){
	swal({
		title: "¡Eliminar mercancía!",
		text: "¿Realmente desea eliminar esta mercancía?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_merc/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						if(data2 == 1){
							swal("¡Completado!", "Mercancía eliminada con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight/"+numdm;}, 2000);
						}else if(data2 == 2){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}else if(data2 == 3){
							swal("¡Excepción!", "No puedes eliminar esta mercancía, esta ligada con otro registro.", "success");
						}
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
					}
				});
			} else {}
		});
}

function EliminarDM(parame){
	swal({
		title: "¡Eliminar número DM!",
		text: "¿Realmente desea eliminar este número?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_dm/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						if(data2 == 1){
							swal("¡Completado!", "Número Dm eliminado con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/dm-number";}, 2000);
						}else if(data2 == 2){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}else if(data2 == 3){
							swal("¡Excepción!", "El número DM que quieres eliminar esta ligado con otro registro.", "error");
						}
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
					}
				});
			} else {}
		});
}

function EliminarTipom(parame){
	swal({
		title: "¡Eliminar tipo mercancía!",
		text: "¿Realmente desea eliminar este tipo?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_tipom/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						if(data2 == 1){
							swal("¡Completado!", "Tipo de mercancía eliminado con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/freight-kinds";}, 2000);
						}else if(data2 == 2){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}else if(data2 == 3){
							swal("¡Excepción!", "El tipo de mercancía que quieres eliminar esta ligada con otro registro.", "error");
						}
						console.log(data2);
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						console.log(data2);
					}
				});
			} else {}
		});
}

function EliminarEmpre(parame){
	swal({
		title: "¡Eliminar empresa!",
		text: "¿Realmente desea eliminar esta empresa?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_empresas/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						if(data2 == 1){
							swal("¡Completado!", "Empresa eliminada con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/enterprise";}, 2000);
						}else if(data2 == 2){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}else if(data2 == 3){
							swal("¡Excepción!", "No puedes eliminar esta empresa, esta ligada con otros registros.", "error");
						}
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
					}
				});
			} else {}
		});
}

function EliminarTipoUsu(parame){
	swal({
		title: "¡Eliminar tipo usuario!",
		text: "¿Realmente desea eliminar este tipo de usuario?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#31b0d5",
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true },
		function(isConfirm){
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					url: 'http://localhost/SGL/php/backend/mnt_tipoadmin/scrud/delete.php?id='+parame,
					data: 'hidx='+parame,
					success: function(data2){
						if(data2 == 1){
							swal("¡Aviso!", "No puedes eliminar al tipo principal de usuario.", "error");
						}else if(data2 == 3){
							swal("¡Completado!", "Tipo de usuario eliminado con éxito.", "success");
							setTimeout(function(){window.location="http://localhost/SGL/admin/cpanel/userprofiles";}, 2000);
						}else if(data2 == 4){
							swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						}else if(data2 == 2){
							swal("¡Excepción!", "El tipo de usuario que quieres eliminar esta ligado con otro registro.", "error");
						}
						console.log(data2);
					},
					error: function(data2){
						swal("¡Aviso!", "Ha ocurrido algún error.", "error");
						console.log(data2);
					}
				});
			} else {}
		});
}

function RetirarMerc(){
	var dm = document.getElementById("dm").value;
	var nombre = document.getElementById("nombre").value;
	var cantactual = document.getElementById("cajasact").value;
	var cantretirar = document.getElementById("retirar").value;
	var preciou = document.getElementById("preciou").value;
	var preciov = document.getElementById("preciov").value;
	var porc_alch = document.getElementById("porc").value;
	var cajasnuevas = parseInt(cantactual) - parseInt(cantretirar);
	var Nuevas = document.getElementById("nueva").value = cajasnuevas;
	var id3 = document.getElementById("id-merc").value;
	var dm2 = document.getElementById("dm").value;
	var empresa = document.getElementById("empresa").value;
	if (parseInt(cantretirar) > parseInt(cantactual)) {
		swal("¡Atención!", "La cantidad a retirar supera la cantidad actual.", "warning");
		document.getElementById("retirar").value = "";
	}else{
		$.ajax({
			type: 'POST',
			url: 'scrud/desprender.php',
			data: ("txtdm="+dm+"&txtnombre="+nombre+"&txtcajasact="+cantactual+"&txtcantnueva="+Nuevas+"&txtretirar="+cantretirar+"&txtpreciou="+
				preciou+"&txtpreciov="+preciov+"&txtporc="+porc_alch+"&id3="+id3+"&txtdm="+dm2+"&txtempresa="+empresa),
			success: function(data2){
				if(data2 == 1){
					swal("¡Excepción!", "Hay una excepcion.", "error");
				}else if(data2 == 2){
					swal("¡Completado!", "Mercancía retirada con éxito.", "success");
					setTimeout(function(){window.open('reporte.php?dm='+dm,'','width=800,height=600,left=50,top=50,toolbar=yes');void 0}, 1000);
					setTimeout(function(){window.location="index.php";}, 2000);
				}else if(data2 == 3){
					swal("¡Excepción!", "Ha ocurrido algún error.", "error");
				}
				console.log(data2);
			},
			error: function(data2){
				swal("¡Aviso!", "Ha ocurrido algún error.", "error");
				console.log(data2);
			}
		});
	}
}

function validar(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	patron =/[A-Za-z\s]/;
	te = String.fromCharCode(tecla);
	return patron.test(te);
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

function numeros(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8) return true;
	patron = /\d/;
	te = String.fromCharCode(tecla);
	return patron.test(te);
}

$('#caj').on('keyup', function(){
	var dato = $('#caj').val();
	var url = 'http://localhost/SGL/php/backend/mnt_admin/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj').on('keyup', function(){
	var dato = $('#caj').val();
	var url = 'http://localhost/SGL/php/backend/mnt_admin/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj1').on('keyup', function(){
	var dato = $('#caj1').val();
	var url = 'http://localhost/SGL/php/backend/mnt_tipoadmin/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj2').on('keyup', function(){
	var dato = $('#caj2').val();
	var url = 'http://localhost/SGL/php/backend/mnt_empresas/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj3').on('keyup', function(){
	var dato = $('#caj3').val();
	var url = 'http://localhost/SGL/php/backend/mnt_dm/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj4').on('keyup', function(){
	var dato = $('#caj4').val();
	var url = 'http://localhost/SGL/php/backend/mnt_tipom/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj4').on('keyup', function(){
	var dato = $('#caj4').val();
	var url = 'http://localhost/SGL/php/backend/mnt_tipom/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

$('#caj5').on('keyup', function(){
	var dato = $('#caj5').val();
	var get = $('#get').val();
	var url = 'http://localhost/SGL/php/backend/mnt_merc/scrud/search.php';
	$.ajax({
		type: 'post',
		url: url,
		data: 'txtdato1='+dato+"&txtget="+get,
		success: function(datos){
			$('#ctime').html(datos);
		}
	});
	return false;
});

var numdm = document.getElementById("get").value;