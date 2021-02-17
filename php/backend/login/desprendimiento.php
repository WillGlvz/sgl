<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (isset($_SESSION['name'])) {
		header('Location: http://localhost/SGL/desprendimientos/empresas');
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
              					<input type="text" id="nit" onkeypress="return Patron(event);" autocomplete="off" maxlength="14" onCopy="return false;" class="form-control" name="txtnit" placeholder="Ingrese su NIT" required>
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
             					<a href="#modal2"><p class="text-center">¿Olvidaste tu contraseña?</p></a>
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
	<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	  <div>
	    <h2 id="modal1Title">Ingrese sus datos</h2>
	    <p id="modal1Desc">
	      <form method="post" onsubmit="PrimerAdmin(); return false;">
	      	<div>
				<label class="laabel">Nombres:</label>
				<input type="text" id="nom" name="txtnombre" onkeypress="return validar(event)" class="iinput" pattern=".{3,}" required placeholder="Ingrese sus nombre" autocomplete="off"/>
			</div>
			<div class="espa">
				<label class="laabel">Apellidos:</label>
				<input type="text" id="ape" name="txtapellidos" onkeypress="return validar(event)" class="iinput" pattern=".{3,}" required placeholder="Ingrese sus apellidos" autocomplete="off"/>
			</div>
			<div class="espa">
				<label class="laabel">Usuario:</label>
				<input type="text" id="usu" name="txtusuario" class="iinput" pattern=".{3,}" required placeholder="Ingrese su usuario" autocomplete="off"/>
			</div>
			<div class="espa">
				<label class="laabel">Correo:</label>
				<input type="text" id="corr" name="txtcorreo" class="iinput" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese su correo" autocomplete="off" />
			</div>
			<div class="espa">
				<label class="laabel">Clave:</label>
				<input type="password" id="passx1" name="txtcontra" class="iinput" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Ingrese su clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
			</div>
			<div class="espa">
				<label class="laabel">Confirmar:</label>
				<input type="password" id="passx2" name="txtcontra2" class="iinput" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Confirmar clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
			</div>
	    </p>
	    <br>
	  <button data-remodal-action="cancel" class="remodal-cancel">Cancelar</button>
	  <button type="submit" class="remodal-confirm">Agregar</button>
	  </form>
	  </div>
	</div>
    <div class="remodal" data-remodal-id="modal2" role="dialog" aria-labelledby="modal2Title" aria-describedby="modal2Desc">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div>
            <h2 id="modal2Title">Recuperar contraseña</h2>
            <p id="modal2Desc">
            <form method="post" onsubmit="PrimerAdmin(); return false;">
                <div>
                    <label class="laabel">Usuario:</label>
                    <input type="text" id="usu" name="txtusu" class="iinput" pattern=".{3,}" required placeholder="Ingrese su usuario" autocomplete="off"/>
                </div>
                <div class="espa">
                    <label class="laabel">Correo:</label>
                    <input type="text" id="correo" name="txtcorreo" class="iinput" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese su correo" autocomplete="off"/>
                </div>
            </p>
            <br>
            <button data-remodal-action="cancel" class="remodal-cancel">Cancelar</button>
            <button type="submit" class="remodal-confirm">Restablecer</button>
            </form>
        </div>
    </div>
	<script type="text/javascript">
		window.REMODAL_GLOBALS = {
	     NAMESPACE: 'remodal',
	     DEFAULTS: {
	       hashTracking: true,
	       closeOnConfirm: true,
	       closeOnCancel: true,
	       closeOnEscape: true,
	       closeOnOutsideClick: false,
	       modifier: ''
	     }
	   };

	</script>
	<?php include '../maestros/scrbody.php'; ?>
	<script type="text/javascript">
	  	$(document).on('closing', '.remodal', function (e) {
	    	swal("¡Aviso!", "No podrás ingresar al sistema si no te registras.", "error");
			setTimeout(function(){ window.location="http://localhost/SGL"; }, 2000);
	  	});
	</script>
</body>
</html>

<?php
	$st = $cn->prepare("SELECT COUNT(*) AS Total FROM administradores");
	$st->execute();
	$resultado = $st->fetch();
	if($resultado['Total'] <= 0){
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
						window.location="#modal";
					} else {
						swal("¡Aviso!", "No podrás ingresar al sistema si no te registras.", "error");
						setTimeout(function(){ window.location="http://localhost/SGL"; }, 2000);
					}
				});
		</script>
		<?php
	}

	if (isset($_POST['btnentrar'])) {
		$nit = utf8_decode($_POST['txtnit']);
		$contra = utf8_decode($_POST['txtcontrase']);
		date_default_timezone_set("America/El_Salvador");
		$fecha = date("Y-m-d");
		$hora = date("H:i:s");
		$st = $cn->prepare("SELECT id_empresa, nombre_empresa, nit_empresa, contrasenia_empresa FROM empresas WHERE nit_empresa = ? AND contrasenia_empresa = md5(sha1(?))");
		$st->bindParam(1, $nit);
		$st->bindParam(2, $contra);
		$st->execute();
		$res = $st->fetch();
		if ($res) {
			$st = $cn->prepare("INSERT INTO historiales(fecha_historial, hora_historial, nom_empresa)
			VALUES(?, ?, ?)");
			$st->bindParam(1, $fecha);
			$st->bindParam(2, $hora);
			$st->bindParam(3, $res['nombre_empresa']);
			if ($st->execute()) {
				$_SESSION['code'] = $res['id_empresa'];
				$_SESSION['name'] = $res['nombre_empresa'];
				echo "<script>window.location='http://localhost/SGL/desprendimientos/empresas';</script>";
			}
		}else{
			echo "<script>swal('¡AVISO!', 'Los datos que has ingresado son incorrectos.', 'error');</script>";
		}
	}
?>
