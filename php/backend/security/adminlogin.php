<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin/cpanel');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body class="fonadm">
	<script>
		var closable = alertify.dialog('prompt').setting('closable');
		alertify.dialog('prompt')
		.set({
			'title': 'Area restringida, solo personal autorizado.',
			'labels':{ok:'Verificar', cancel:'Cancelar'},
			'message': 'Ingrese el usuario que recibió en su correo electrónico',
			'onok': function(evt, value){ 
				var variable = value;
				var usuario = "Diamond";
				if(variable == usuario){
					var contra = parseInt(prompt("Ingrese la clave que recibió en su correo electrónico"));
					if(contra == 19720716){}else{alert("Clave incorrecta"); window.location="http://localhost/SGL";}
				}else{
					alert("Usuario incorrecto");
					window.location="http://localhost/SGL";
				}   					
			},
			'oncancel': function(){ 
				window.location="http://localhost/SGL";
			},
		}).show();
	</script>
	<div id="particles-js"></div>
	<br><br><br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 center-block">
				<div class="panel panel-primary">
				  <div class="panel-heading letra5"><p class="text-center">Administradores</p></div>
				  <div class="panel-body">
				    <form method="post">
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">Usuario</label>
              					<input type="text" id="nit" autocomplete="off" maxlength="14" onCopy="return false;" onPaste="return false;" class="form-control" name="txtnit" placeholder="Ingrese su usuario" required>
				    		</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">Contraseña</label>
              					<input type="password" id="pass" class="form-control" name="txtcontrase" placeholder="Ingrese su contraseña" required>
				    		</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
             					<a href="http://localhost/SGL"><p class="text-center">Regresar</p></a>
            				</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
             					<a href="#frmRestablecer"><p class="text-center">¿Olvidaste tu contraseña?</p></a>
            				</div>
				    	</div>
            			<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
            				<div class="form-group">
             					<button type="button" id="entrar" name="btnentrar" class="btn btn-primary btn-block">Ingresar</button>
            				</div>
            			</div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div id="frmRestablecer" class="aspecto">
		<div class="caja rodar">
			<a href="#cerrar" title="Cerrar" class="cerrar">X</a>
			<h2 class="titul text-center">Recuperación de contraseña</h2>
			<br>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label style="color:#000;">Usuario</label>
             		<input type="text" class="form-control" name="txtusu" placeholder="Ingrese su usuario" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">Correo</label>
             		<input type="email" class="form-control" name="txtcorr" placeholder="Ingrese su correo" autocomplete="off" required>
				</div>
				<div>
					<button type="submit" name="btnenviar" class="btn btn-info btn-block">Enviar nueva contraseña</button>
				</div>
			</form>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
	<script>
		$(document).ready(function(){
			$("#entrar").click(function(){
				var usuario = document.getElementById("nit").value;
				var contraj = document.getElementById("pass").value;
				if(usuario == "" || contraj == ""){
					swal('¡Campos en blanco!', 'Hay campos vacíos.', 'warning');
				}else{
					$.ajax({
						url: "http://localhost/SGL/php/backend/security/entrar.php",
						type: "POST",
						data: ("txtnit="+usuario+"&txtcontrase="+contraj),
						success: function(data){
							console.log(data);
							if(data == 1){
								var closable = alertify.dialog('prompt').setting('closable');
								alertify.dialog('prompt')
				  				.set({
				  					'title': 'Activación de cuenta',
				    				'labels':{ok:'Verificar', cancel:'Cancelar'},
				    				'message': 'Ingrese el código que la empresa le ha proporcionado',
				    				'onok': function(evt, value){ 
				    					var variable = value;
				    					$.ajax({
				    						url: "http://localhost/SGL/php/backend/login/activacion.php?co="+variable,
				    						success: function(data2){
				    							if (data2 == 1) {
				    								document.getElementById("nit").value = "";
				    								document.getElementById("pass").value = "";
				    								alertify.success('Tu cuenta ha sido activada con éxito, inicia sesión para continuar.');
				    							}else if(data2 == 0){
				    								document.getElementById("nit").value = "";
				    								document.getElementById("pass").value = "";
				    								alertify.error('El código que has ingresado es incorrecto.');
				    							}
				    						},
				    						error: function(data2){
				    							alert('Algo salio mal');
				    							document.getElementById("nit").value = "";
				    							document.getElementById("pass").value = "";
				    						}
				    					});
				    				},
				    				'oncancel': function(){ 
				    					document.getElementById("nit").value = "";
				    					document.getElementById("pass").value = "";
				    					alertify.error('No podrás iniciar sesión si no activas tu cuenta.');
				    				},
				  				}).show();
							}else if(data == 2){
								window.location="http://localhost/SGL/admin/welcome";
							}else if(data == 3){
								document.getElementById("nit").value = "";
				    			document.getElementById("pass").value = "";
								swal('¡AVISO!', 'Datos incorrectos.', 'error');
							}else if(data == 4){
								window.location="http://localhost/SGL/php/backend/security/sesion_activa.php";
							}
						},
						error: function(data){
							console.log(data);
						}
					});
				}
			});
		});
	</script>
</body>
</html>

<?php  
	if (isset($_POST['btnenviar'])) {
		require('../librerias/clsCorreo.php');
		$Usuario = utf8_decode($_POST['txtusu']);
		$Correo = $_POST['txtcorr'];
		$st = $cn->prepare("SELECT id_admin FROM administradores WHERE usuario_admin = ? AND correo_admin = ?");
		$st->bindParam(1, $Usuario);
		$st->bindParam(2, $Correo);
		$st->execute();
		$resultado = $st->fetch();
		if($resultado){
			$st2 = $cn->prepare("UPDATE administradores SET contrasenia_admin = md5(sha1(?)) WHERE id_admin = ?");
			$st2->bindParam(1, $Codigo);
			$st2->bindParam(2, $resultado['id_admin']);
			if ($st2->execute()) {
				$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $Correo, utf8_decode("Recuperación de contraseña"), 
					utf8_decode("Este es el proceso de recuperación de clave, para completar este proceso sigue las siguientes indicaciones:"."<br>"."<br>"."1) Inicia sesión con tu usuario y con esta nueva clave: ".$Codigo."<br>"."<br>"."2) Al ingresar al sistema, ve a la opción CAMBIAR CLAVE"."<br>"."<br>"."3) Copia y pega la clave que has recibido en este correo y luego escribe tu propia clave personalizada."."<br>"."<br>"."Gracias, intenta no perder tu clave nuevamente."));
				echo "<script>swal('¡Completado!', 'Su nueva clave ha sido enviada a su correo.', 'success');</script>";
				echo "<script>setTimeout(function(){location.href='http://localhost/SGL/admin-login-system-sgl';}, 2000);</script>";
			}
		}else{
			echo "<script>swal('¡AVISO!', 'Datos incorrectos.', 'error');</script>";
			echo "<script>setTimeout(function(){location.href='http://localhost/SGL/admin-login-system-sgl';}, 2000);</script>";
		}
	}
?>