<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin');
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
<html lang="en">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php'; ?>
</head>
<body class="fondocontra">
	<div id="particles-js"></div>
	<br><br><br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 center-block">
				<div class="panel panel-danger">
				  <div class="panel-heading letra5"><p class="text-center">Cambiar clave</p></div>
				  <div class="panel-body">
				    <form method="post">
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">Clave actual</label>
              					<input type="password" autocomplete="off" maxlength="20" onCopy="return false;" class="form-control" name="txtcontra" placeholder="Ingrese su clave actual" required>
				    		</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">Nueva clave</label>
              					<input type="password" class="form-control" name="txtcontranueva" placeholder="Ingrese su nueva clave" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas">
				    		</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
				    			<label style="color:#000;">Confirmar nueva clave</label>
              					<input type="password" class="form-control" name="txtconfirmar" placeholder="Confirme su nueva clave" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas">
				    		</div>
				    	</div>
				    	<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
				    		<div class="form-group">
             					<a href="http://localhost/SGL/admin/cpanel"><p class="text-center">Regresar</p></a>
            				</div>
				    	</div>
            			<div class="col-xs-8 col-md-offset-2 col-xs-offset-2">
            				<div class="form-group">
             					<button type="submit" class="btn btn-danger btn-block">Cambiar contraseña</button>
            				</div>
            			</div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php  
	if(!empty($_POST)){
		$contra = htmlentities($_POST['txtcontra']);
		$nuevacontra = htmlentities($_POST['txtcontranueva']);
		$confirmar = htmlentities($_POST['txtconfirmar']);
		$id = null;
		$id = $_SESSION['id'];
		if (!($nuevacontra == $confirmar)) {
			echo "<script>window.alert('Las claves no coinciden');</script>";
		}else{
			$st = $cn->prepare("SELECT id_admin FROM administradores WHERE id_admin = ? AND contrasenia_admin = md5(sha1(?))");
			$st->bindParam(1, $id);
			$st->bindParam(2, $contra);
			$st->execute();
			if($st->fetch()){
				$stm = $cn->prepare("UPDATE administradores SET contrasenia_admin = md5(sha1(?)) WHERE id_admin = ?");
				$stm->bindParam(1, $nuevacontra);
				$stm->bindParam(2, $id);
				if ($stm->execute()) {
					echo "<script>window.alert('Clave modificada con exito');</script>";
					echo "<script>window.location='http://localhost/SGL/admin/cpanel'</script>";
				}else{
					echo "<script>window.alert('No se pudo cambiar la clave');</script>";
					
				}
			}else{
				echo "<script>window.alert('Los datos que has ingresado son incorrectos');</script>";
			}
		}
	}
?>