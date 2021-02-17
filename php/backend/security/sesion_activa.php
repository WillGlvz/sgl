<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: ../security/adminlogin.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="background-color: #F0E7C0;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<img src="../img/warning.png" class="img-responsive center-block" alt="Responsive image">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center letraa3">Oops, al parecer ya hay una sesión iniciada con tu usuario.</h2>
				<h4 class="text-center">¿Que desea hacer?</h4>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<br>
						<a href="../principal/bienvenida.php" class="btn btn-success btn-block"><span class="icon-plus" style="margin-right:10px;"></span>Iniciar sesión normalmente</a>
						<br>
						<a href="#modal" class="btn btn-warning btn-block"><span class="icon-plus" style="margin-right:10px;"></span>Modificar clave</a>
						<br>
						<a href="../login/cerrar.php" class="btn btn-danger btn-block"><span class="icon-plus" style="margin-right:10px;"></span>Salir</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	  <div>
	    <h2 id="modal1Title">Modificar clave de acceso</h2>
	    <p id="modal1Desc">
	      <form method="post" onsubmit="ChangePass(); return false;">
	      	<div>
				<label class="laabel">Clave actual:</label>
				<input type="password" id="passx0" name="txtcontra0" class="iinput" pattern=".{3,}" required placeholder="Ingrese su clave actual" autocomplete="off"/>
			</div>
			<div class="espa">
				<label class="laabel">Nueva clave:</label>
				<input type="password" id="passx1" name="txtcontra" class="iinput" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Ingrese su nueva clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
			</div>
			<div class="espa">
				<label class="laabel">Confirmar nueva:</label>
				<input type="password" id="passx2" name="txtcontra2" class="iinput" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Confirmar clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
			</div>
	    </p>
	    <br>
	  <button data-remodal-action="cancel" class="remodal-cancel">Cancelar</button>
	  <button type="submit" class="remodal-confirm">Modificar</button>
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
</body>
</html>