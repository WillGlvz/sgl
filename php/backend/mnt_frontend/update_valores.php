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
	$st = $cn->prepare("SELECT valor, img_valor FROM valores WHERE id_valor = 1");
	$st->execute();
  	$result = $st->fetch();
  	$st = $cn->prepare("SELECT valor, img_valor FROM valores WHERE id_valor = 2");
	$st->execute();
  	$result2 = $st->fetch();
  	$st = $cn->prepare("SELECT valor, img_valor FROM valores WHERE id_valor = 3");
	$st->execute();
  	$result3 = $st->fetch();
  	$st = $cn->prepare("SELECT valor, img_valor FROM valores WHERE id_valor = 4");
	$st->execute();
  	$result4 = $st->fetch();
  	$st = $cn->prepare("SELECT valor, img_valor FROM valores WHERE id_valor = 5");
	$st->execute();
  	$result5 = $st->fetch();
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
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Valores empresariales</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-12 ">
		    		<h2 class="text-center letra4x">Por cuestion de orden solo podrá agregar un valor adicional.</h2>
		    	</div>
		    </div>
		    <br>
		    <form method="post" enctype="multipart/form-data">
			    <div class="row">
			    	<div class="col-md-6">
			    		<div>
							<input type="text" name="txtv1" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result['valor']); ?>" />
						</div>
						<div class="espa">
							<input type="text" name="txtv2" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result2['valor']); ?>"/>
						</div>
						<div class="espa">
							<input type="text" name="txtv3" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result3['valor']); ?>"/>
						</div>
						<div class="espa">
							<input type="text" name="txtv4" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result4['valor']); ?>"/>
						</div>
						<div class="espa">
							<input type="text" name="txtv5" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result5['valor']); ?>"/>
						</div>
						<div class="espa">
							<input type="text" name="txtv6" pattern=".{3,}" autocomplete="off"/>
						</div>
						<div class="col-md-5">
							<div class="espa">
								<button type="submit" name="btnmodi" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
								<br>
				    			<a href="http://localhost/SGL/admin/cpanel/frontend-strategy" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
							</div>
						</div>
			    	</div>
					<div class="col-md-6">
			    		<img src="http://localhost/SGL/img/<?php echo $result['img_valor']; ?>"  width="400" height="300">
			    		<input id="file" type="file" name="fileperfil">
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
		$valor1 = htmlentities(utf8_decode($_POST['txtv1']));
		$valor2 = htmlentities(utf8_decode($_POST['txtv2']));
		$valor3 = htmlentities(utf8_decode($_POST['txtv3']));
		$valor4 = htmlentities(utf8_decode($_POST['txtv4']));
		$valor5 = htmlentities(utf8_decode($_POST['txtv5']));
		$valor6 = htmlentities(utf8_decode($_POST['txtv6']));
		if ($valor6 == "") {
			$img = "valores.jpg";
			if ($nombre == "") {
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 1");
				$st->bindParam(1, $valor1);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 2");
				$st->bindParam(1, $valor2);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 3");
				$st->bindParam(1, $valor3);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 4");
				$st->bindParam(1, $valor4);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 5");
				$st->bindParam(1, $valor5);
				$st->bindParam(2, $img);
				if ($st->execute()) {
					echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
					echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-update-valores'; }, 2000);</script>";
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
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 1");
						$st->bindParam(1, $valor1);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 2");
						$st->bindParam(1, $valor2);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 3");
						$st->bindParam(1, $valor3);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 4");
						$st->bindParam(1, $valor4);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 5");
						$st->bindParam(1, $valor5);
						$st->bindParam(2, $rutaF2);
						if ($st->execute()) {
							move_uploaded_file($_FILES['fileperfil']['tmp_name'], "../../../".$rutaF);
							echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
							echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-update-valores'; }, 2000);</script>";
						}else{
							echo "<script>swal('¡Error!', 'Al parecer a ocurrido un error.', 'error');</script>";
						}
					}
				}
			}
		}else{
			$img = "valores.jpg";
			if ($nombre == "") {
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 1");
				$st->bindParam(1, $valor1);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 2");
				$st->bindParam(1, $valor2);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 3");
				$st->bindParam(1, $valor3);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 4");
				$st->bindParam(1, $valor4);
				$st->bindParam(2, $img);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 6");
				$st->bindParam(1, $valor6);
				$st->bindParam(2, $rutaF2);
				$st->execute();
				$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 5");
				$st->bindParam(1, $valor5);
				$st->bindParam(2, $img);
				if ($st->execute()) {
					echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
					echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-update-valores'; }, 2000);</script>";
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
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 1");
						$st->bindParam(1, $valor1);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 2");
						$st->bindParam(1, $valor2);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 3");
						$st->bindParam(1, $valor3);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 4");
						$st->bindParam(1, $valor4);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 6");
						$st->bindParam(1, $valor6);
						$st->bindParam(2, $rutaF2);
						$st->execute();
						$st = $cn->prepare("UPDATE valores SET valor = ?, img_valor = ? WHERE id_valor = 5");
						$st->bindParam(1, $valor5);
						$st->bindParam(2, $rutaF2);
						if ($st->execute()) {
							move_uploaded_file($_FILES['fileperfil']['tmp_name'], "../../../".$rutaF);
							echo "<script>swal('¡Completado!', 'Datos modificados con exito.', 'success');</script>";
							echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-update-valores'; }, 2000);</script>";
						}else{
							echo "<script>swal('¡Error!', 'Al parecer a ocurrido un error.', 'error');</script>";
						}
					}
				}
			}
		}
	}
?>
