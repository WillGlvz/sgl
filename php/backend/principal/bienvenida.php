<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT estado_sesion FROM administradores WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res6 = $st->fetch();
	if ($res6['estado_sesion'] == 0) {
		echo "<script>window.alert('Se ha cerrado la sesión');</script>";
		echo "<script>window.location='http://localhost/SGL/admin/log-out';</script>";
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body class="welcome">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<br><br><br><br><br><br><br>
				<img src="../img/sgl-logo.png" class="img-responsive animated zoomIn" alt="Responsive image">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<br><br><br><br><br>
				<div id="progressTimer"></div>
			</div>
		</div>
	</div>
<?php include '../maestros/scrbody.php';?>
<script>
	$("#progressTimer").progressTimer({
    	timeLimit: 4,
    	warningThreshold: 10,
   	 	baseStyle: 'progress-bar-warning',
    	warningStyle: 'progress-bar-danger',
    	completeStyle: 'progress-bar-info',
    	onFinish: function() {
        	swal({   
				title: "¡Completado!",   
				text: "Bienvenido " + "<?php echo $_SESSION['nombre']; ?>",   
				type: "info",      
				confirmButtonColor: "#31b0d5",   
				confirmButtonText: "Aceptar",   
				closeOnConfirm: true 
			}, 
			function(isConfirm){   
				if (isConfirm) {     
					 window.location="http://localhost/SGL/admin/cpanel";
				} 
			});
    	}
	});
</script>
</body>
</html>