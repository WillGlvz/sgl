<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-sgl');
	}
	$st = $cn->prepare("SELECT permiso_front FROM administradores a INNER JOIN tipos_usuarios t ON
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_front'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin-login-sgl';</script>";
	}
	$st = $cn->prepare("SELECT titulo_seccion, descripcion, img_seccion FROM secciones WHERE id_seccion = 1");
	$st->execute();
  	$result = $st->fetch();
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
		<div class="panel panel-success" style="margin-top:80px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Seccion empresarial</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-5 col-md-offset-3">
		    		<h2 class="text-center letra4x">Modifique los datos a su gusto</h2>
		    	</div>
		    </div>
		    <br>
		    <form method="post" enctype="multipart/form-data">
			    <div class="row">
			    	<div class="col-md-6">
			    		<div>
							<label class="laabel">Titulo:</label>
							<br>
							<input type="text" id="tit" name="txttitulo" class="form-control" pattern=".{3,}" required placeholder="Titulo de la seccion" autocomplete="off" value="<?php echo $result['titulo_seccion']; ?>" />
						</div>
						<div class="espa">
							<label class="laabel">Descripcion (*):</label>
							<br>
							<textarea class="form-control" id="descr" name="txtdescripcion" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="6" required autocomplete="off"><?php echo utf8_encode($result['descripcion']); ?></textarea>
						</div>
						<div class="espa">
							<button type="submit" name="btnmodi" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
						</div>
			    	</div>
					<div class="col-md-6">
			    		<img src="http://localhost/SGL/img/<?php echo $result['img_seccion']; ?>"  width="500" height="200">
			    		<input id="file" type="file" name="fileperfil">
			    		<br>
			    		<a href="index.php" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
			    	</div>
			    </div>
		    </form>
		  </div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>

<?php
	if (isset($_POST['btnmodi'])) {
		$file = $_FILES['fileperfil'];
		$nombre = $file['name'];
		$titulo = htmlentities(utf8_decode($_POST['txttitulo']));
		$descripcion = utf8_decode($_POST['txtdescripcion']);
		$img = "sgl-logo.png";
		if ($nombre == "") {
			$st = $cn->prepare("UPDATE secciones SET titulo_seccion = ?, descripcion = ?, img_seccion = ? WHERE id_seccion = 1");
			$st->bindParam(1, $titulo);
			$st->bindParam(2, $descripcion);
			$st->bindParam(3, $img);
			if ($st->execute()) {
				echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
				echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-description'; }, 2000);</script>";
			}else{
				echo "<script>swal('¡Aviso!', 'Al parecer a ocurrido algun error.', 'warning');</script>";
			}
		}else{
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
			}else{
				$ruta = "img/";
				unlink("../../../img/".$result['img_seccion']);
				$tipo2 = explode(".", $_FILES['fileperfil']['name']);
				$num = count($tipo2);
				$extencion = $tipo2[$num - 1];
				$rutaF = $ruta.$Codigo.".".$extencion;
				$rutaF2 = $Codigo.".".$extencion;
				if (!file_exists($rutaF)) {
					$st = $cn->prepare("UPDATE secciones SET titulo_seccion = ?, descripcion = ?, img_seccion = ? WHERE id_seccion = 1");
					$st->bindParam(1, $titulo);
					$st->bindParam(2, $descripcion);
					$st->bindParam(3, $rutaF2);
					if ($st->execute()) {
						move_uploaded_file($_FILES['fileperfil']['tmp_name'], '../../../'.$rutaF);
						echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
						echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-description'; }, 2000);</script>";
					}else{
						echo "<script>swal('¡Error!', 'Al parecer a ocurrido un error.', 'error');</script>";
					}
				}
			}
		}
	}
?>
