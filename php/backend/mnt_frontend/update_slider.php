<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT permiso_front FROM administradores a INNER JOIN tipos_usuarios t ON
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_front'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin-login-system-sgl';</script>";
	}
	$st = $cn->prepare("SELECT url_imagen FROM slider WHERE id_slider = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res3 = $st->fetch();
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
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:80px; background-color: #F0E7C0;">
	<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="row">
			<br>
			<div class="col-md-4 col-md-offset-2">
				<img src="http://localhost/SGL/img/<?php echo $res3['url_imagen']; ?>" class="center-block" width="700" height="430">
				<br>
				<label style="color:#000;">Seleccione una imagen de perfil</label>
        	<form method="post" enctype="multipart/form-data">
        		<input id="file" type="file" name="fileperfil" required>
          	<br>
          	<button type="submit" name="btnmodi" class="btn btn-danger btn-block">Modificar imagen de perfil</button>
        	</form>
			</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>

<?php
	if (isset($_POST['btnmodi'])) {
		$file = $_FILES['fileperfil'];
		$nombre = $file['name'];
		$tipo = $file['type'];
		$ruta = $file['tmp_name'];
		$tamanio = $file['size'];
		$dimensiones = getimagesize($ruta);
		$anchura = $dimensiones[0];
		$altura = $dimensiones[1];
		if ($tipo != "image/jpg" && $tipo != "image/png" && $tipo != "image/gif" && $tipo != "image/jpeg") {
			echo "<script>swal('¡Aviso!', 'Tipo de archivo incorrecto.', 'warning');</script>";
		}else if ($tamanio > 1000000) {
			echo "<script>swal('¡Aviso!', 'El tamaño debe ser menor a 1MB.', 'warning');</script>";
		}else if ($anchura < 1352 || $altura < 666) {
			echo "<script>swal('¡Obligatoriamente!', 'Las dimensiones de la imagen deben ser de 1352x666.'+' Suba una imagen con las dimensiones solicitadas.', 'warning');</script>";
		}else if ($anchura > 1352 || $altura > 666) {
			echo "<script>swal('¡Obligatoriamente!', 'Las dimensiones de la imagen deben ser de 1352x666.'+' Suba una imagen con las dimensiones solicitadas.', 'warning');</script>";
		}else{
				$ruta = "img/";
				unlink("../../../img/".$res3['url_imagen']);
				$tipo2 = explode(".", $_FILES['fileperfil']['name']);
				$num = count($tipo2);
				$extencion = $tipo2[$num - 1];
				$rutaF = $ruta.$Codigo.".".$extencion;
				$rutaF2 = $Codigo.".".$extencion;
				if (!file_exists($rutaF)) {
					$st = $cn->prepare("UPDATE slider SET url_imagen = ? WHERE id_slider = ?");
					$st->bindParam(1, $rutaF2);
					$st->bindParam(2, $_GET['id']);
					if ($st->execute()) {
						move_uploaded_file($_FILES['fileperfil']['tmp_name'], "../../../".$rutaF);
						echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
						echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-slider'; }, 2000);</script>";
					}else{
						echo "<script>swal('¡Error!', 'Al parecer a ocurrido un error.', 'error');</script>";
					}
				}
		}
	}
?>
