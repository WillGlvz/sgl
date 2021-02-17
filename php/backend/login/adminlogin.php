<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (isset($_SESSION['nombre'])) {
		header('Location: ../principal/index.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body class="fon3">
	<div id="particles-js"></div>
	<br><br><br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 center-block">
				<div class="panel panel-info">
				  <div class="panel-heading letra5"><p class="text-center">Desprendimientos</p></div>
				  <div class="panel-body">
				    <form method="post">
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">NIT (Sin guíones)</label>
              					<input type="text" id="nit" onkeypress="return Patron(event);" autocomplete="off" maxlength="14" onCopy="return false;" onPaste="return false;" class="form-control" name="txtnit" placeholder="Ingrese su NIT" required>
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
             					<a href="../../../index.php"><p class="text-center">Regresar</p></a>
            				</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
             					<a href="#frmRestablecer"><p class="text-center">¿Olvidaste tu contraseña?</p></a>
            				</div>
				    	</div>
            			<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
            				<div class="form-group">
             					<button type="submit" name="btnentrar" class="btn btn-info btn-block">Ingresar</button>
            				</div>
            			</div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div id="frmRestablecer2" class="aspecto">
		<div class="caja deslizar">
			<a href="#cerrar" title="Cerrar" class="cerrar">X</a>
			<h2 class="titul text-center">Ingresa tus datos</h2>
			<br>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label style="color:#000;">Nombres</label>
              		<input type="text" class="form-control" name="txtnombre" placeholder="Ingrese sus nombres" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">Apellidos</label>
              		<input type="text" class="form-control" name="txtapellido" placeholder="Ingrese sus apellidos" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">NIT (Sin guíones)</label>
              		<input type="number" class="form-control" name="txtusuario" placeholder="Ingrese su usuario" autocomplete="off" maxlength="14" onkeypress="return Patron(event);" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">Correo</label>
              		<input type="email" class="form-control" name="txtcorreo" placeholder="Ingrese su correo" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">Contraseña</label>
              		<input type="password" class="form-control" name="txtcontra" placeholder="Ingrese su contraseña" required>
				</div>
				<div class="form-group">
					<label style="color:#000;">Seleccione una imagen de perfil</label>
              		<input id="file" type="file" name="fileperfil" required>
				</div>
				<div class="centrar">
					<button type="submit" name="btnagregar" class="btn btn-info btn-block">Agregar</button>
				</div>
			</form>
		</div>
	</div>
	<div id="frmRestablecer" class="aspecto">
		<div class="caja rodar">
			<a href="#cerrar" title="Cerrar" class="cerrar">X</a>
			<h2 class="titul text-center">Recuperación de contraseña</h2>
			<br>
			<form action="php/recuperar.php" method="post" enctype="multipart/form-data">
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
</body>
</html>

<?php  
	$st = $cn->prepare("SELECT id_admin FROM administradores");
	$st->execute();
	$resultado = $st->fetch();
	if($resultado['id_admin'] <= 0){
		?>
		<script>
			swal({   
				title: "¡No hay administradores!",   
				text: "Se ha detectado que no hay administradores registrados." + "\n¿Desea crear al primer administrador?",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#31b0d5",   
				confirmButtonText: "Aceptar",   
				cancelButtonText: "Cancelar",   
				closeOnConfirm: true,   
				closeOnCancel: false }, 
				function(isConfirm){   
					if (isConfirm) {     
						window.location="#frmRestablecer2";   
					} else {     
						swal("¡Aviso!", "No podrás ingresar al sistema si no te registras.", "error");
						setTimeout(function(){ window.location="../../../index.php"; }, 2000);   
					} 
				});
		</script>
		<?php
	}
	if (isset($_POST['btnagregar'])) {
		require('../librerias/clsCorreo.php');
		$nombres = htmlentities(utf8_decode($_POST['txtnombre']));
		$apellidos = htmlentities(utf8_decode($_POST['txtapellido']));
		$usuario = htmlentities(utf8_decode($_POST['txtusuario']));
		$correo = htmlentities(utf8_decode($_POST['txtcorreo']));
		$contra = htmlentities(utf8_decode($_POST['txtcontra']));
		$codigoAct = 0;
		$verifica1 = TRUE;
		$ruta = "../img/";
		$Verifica = 'Administrador';
		$url = "http://localhost/SGL/php/backend/login/adminlogin.php";
		$Mensaje = utf8_decode("Gracias por registrarte en nuestro sistema, para ser un usuario oficial debes ingresar el siguiente código para así poder iniciar sesión: ").$Codigo.utf8_decode("<br>"."Para iniciar sesión como administrador debes ingresar a la siguiente url: ").$url.utf8_decode("<br>"."Al ingresar deberás ingresar el siguiente usuario: Diamond; y la siguiente clave: 19720716");
		if(!$_FILES['fileperfil']['error'] > 0){
			if (!($_FILES['fileperfil']['type'] === "image/jpeg" || $_FILES['fileperfil']['type'] === "image/gif" || $_FILES['fileperfil']['type'] === "image/png" || $_FILES['fileperfil']['type'] === "image/jpg")) {
				echo "<script>swal('¡Error!', 'Formato de archivo no permitido.', 'error');</script>";
				$verifica1 = FALSE;
			}else{
				if ($_FILES['fileperfil']['size'] > 2000000) {
					echo "<script>swal('¡Error!', 'El tamaño de la imagen debe ser menor a 2MB.', 'error');</script>";
					$verifica1 = FALSE;
				}else{
					if ($verifica1) {
						$tipo2 = explode(".", $_FILES['fileperfil']['name']);
						$num = count($tipo2);
						$extencion = $tipo2[$num - 1];
						$rutaF = $ruta.$Codigo.".".$extencion;
						if (!file_exists($rutaF)) {
							$st = $cn->prepare("ALTER TABLE tipos_usuarios AUTO_INCREMENT = 1");
							$st->execute();
							$st = $cn->prepare("INSERT INTO tipos_usuarios(nombre_tipo_usuario, descripcion_tipo_usuario,
								identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, permiso_merc, permiso_unim,
								permiso_tipom, permiso_comprob) VALUES('Administrador', 'Administrador del sistema', 'Jefe', 1, 1, 1, 1, 1, 1, 1)");
							if ($st->execute()) {
								$st = $cn->prepare("SELECT id_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
								$st->bindParam(1, $Verifica);
								$st->execute();
								$resultado = $st->fetch();
								$idAdmin = $resultado['id_tipo_usuario'];
								$st = $cn->prepare("INSERT INTO administradores(nombres_admin, apellidos_admin, nit_admin, correo_admin,
									img_admin, codigo_confirmacion, codigo_activacion, url_login_admin, contrasenia_admin, id_tipo_usuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?, md5(sha1(?)), ?)");
								$st->bindParam(1, $nombres);
								$st->bindParam(2, $apellidos);
								$st->bindParam(3, $usuario);
								$st->bindParam(4, $correo);
								$st->bindParam(5, $rutaF);
								$st->bindParam(6, $Codigo);
								$st->bindParam(7, $codigoAct);
								$st->bindParam(8, $url);
								$st->bindParam(9, $contra);
								$st->bindParam(10, $idAdmin);
								if($st->execute()){
									move_uploaded_file($_FILES['fileperfil']['tmp_name'], $rutaF);
									$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $correo, utf8_decode("Activación de cuenta"), $Mensaje);
									?>
									<script>
										swal("¡Completado!", "Datos agregados con éxito." + "\nInicie sesión para continuar.", "success");
										window.location="#cerrar";
									</script>
									<?php
								}else{
									echo "<script>swal('¡Error!', 'Al parecer hubo un error.', 'error');</script>";
								}
							}
						}
					}
				}
			}
		}
	}

	if (isset($_POST['btnentrar'])) {
		$nit = utf8_decode($_POST['txtnit']);
		$contra = utf8_decode($_POST['txtcontrase']);
		$st = $cn->prepare("SELECT codigo_activacion FROM administradores WHERE nit_admin = ? AND codigo_activacion = 0");
		$st->bindParam(1, $nit);
		$st->execute();
		if($st->fetch()){
			?>
			<script>
				var closable = alertify.dialog('prompt').setting('closable');
				alertify.dialog('prompt')
  				.set({
  					'title': 'Activación de cuenta',
    				'labels':{ok:'Verificar', cancel:'Cancelar'},
    				'message': 'Ingrese el código que la empresa le ha proporcionado',
    				'onok': function(evt, value){ 
    					var variable = value;
    					$.ajax({
    						url: "activacion.php?co="+variable,
    						success: function(data){
    							if (data == 1) {
    								alertify.success('Tu cuenta ha sido activada con éxito, inicia sesión para continuar.');
    							}else if(data == 0){
    								alertify.error('El código que has ingresado es incorrecto.');
    							}
    						},
    						error: function(data){
    							alert('Algo salio mal');
    						}
    					});
    				},
    				'oncancel': function(){ alertify.error('No podrás iniciar sesión si no activas tu cuenta.');},
  				}).show();
			</script>
			<?php
		}else{
			$st = $cn->prepare("SELECT id_admin, nombres_admin, nit_admin, contrasenia_admin FROM administradores WHERE nit_admin = ? AND contrasenia_admin = md5(sha1(?))");
			$st->bindParam(1, $nit);
			$st->bindParam(2, $contra);
			$st->execute();
			$res = $st->fetch();
			if ($res) {
				$_SESSION['id'] = $res['id_admin'];
				$_SESSION['nombre'] = $res['nombres_admin'];
				?>
				<script>
					window.location="../principal/bienvenida.php";
				</script>
				<?php
			}else{
				echo "<script>swal('¡AVISO!', 'Los datos que has ingresado son incorrectos.', 'error');</script>";
			}
		}
	}
?>