<?php 
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT img_admin FROM administradores WHERE id_admin = ?");
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
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:80px; background-color: #F0E7C0;">
	<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="row">
			<br>
			<div class="col-md-5 col-md-offset-3">
				<img src="<?php echo $res3['img_admin']; ?>" class="center-block" width="555" height="444">
				<br>
				<label style="color:#000;">Seleccione una imagen de perfil</label>
              	<form method="post" enctype="multipart/form-data">
              		<input id="file" type="file" name="fileperfil" required>
	              	<br>
	              	<button type="submit" name="btnmodi" class="btn btn-danger btn-block">Modificar imagen de perfil</button>
              	</form>
			</div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>

<?php  
	if (isset($_POST['btnmodi'])) {
		$verifica1 = TRUE;
		$ruta = "img/";
		$id = null;
		$id = $_GET['id'];
		if(!$_FILES['fileperfil']['error'] > 0){
			if (!($_FILES['fileperfil']['type'] === "image/jpeg" || $_FILES['fileperfil']['type'] === "image/gif" || $_FILES['fileperfil']['type'] === "image/png" || $_FILES['fileperfil']['type'] === "image/jpg")) {
				echo "<script>swal('¡Error!', 'Formato de archivo no permitido.', 'error');</script>";
				$verifica1 = FALSE;
			}else{
				if ($_FILES['fileperfil']['size'] > 2000000) {
					echo "<script>swal('¡Error!', 'El tamaño de la imagen debe ser menor a 2MB.', 'error');</script>";
					$verifica1 = FALSE;
				}else{
					if($res3['img_admin'] == "http://localhost/SGL/php/backend/img/default.jpg"){
						if ($verifica1) {
							$tipo2 = explode(".", $_FILES['fileperfil']['name']);
							$num = count($tipo2);
							$extencion = $tipo2[$num - 1];
							$rutaF = $ruta.$Codigo.".".$extencion;
							if (!file_exists($rutaF)) {
								$XD = 'http://localhost/SGL/php/backend/'.$rutaF;
								$st = $cn->prepare("UPDATE administradores SET img_admin = ? WHERE id_admin = ?");
								$st->bindParam(1, $XD);
								$st->bindParam(2, $id);
								if ($st->execute()) {
									move_uploaded_file($_FILES['fileperfil']['tmp_name'], '../'.$rutaF);
									?>
									<script>
										swal("¡Completado!", "Imagen modificada con éxito", "success");
										setTimeout(function(){ window.location="http://localhost/SGL/admin/cpanel"; }, 2000);
									</script>
									<?php
								}
							}
						}
					}else{
						if ($verifica1) {
							$len = strlen("http://localhost/SGL/php/backend/");
							$new_path = substr($res3['img_admin'], $len, strlen($res3['img_admin'])-$len);
							unlink('../'.$new_path);
							$tipo2 = explode(".", $_FILES['fileperfil']['name']);
							$num = count($tipo2);
							$extencion = $tipo2[$num - 1];
							$rutaF = $ruta.$Codigo.".".$extencion;
							if (!file_exists($rutaF)) {
								$XD = 'http://localhost/SGL/php/backend/'.$rutaF;
								$st = $cn->prepare("UPDATE administradores SET img_admin = ? WHERE id_admin = ?");
								$st->bindParam(1, $XD);
								$st->bindParam(2, $id);
								if ($st->execute()) {
									move_uploaded_file($_FILES['fileperfil']['tmp_name'], '../'.$rutaF);
									?>
									<script>
										swal("¡Completado!", "Imagen modificada con éxito", "success");
										setTimeout(function(){ window.location="http://localhost/SGL/admin/cpanel"; }, 2000);
									</script>
									<?php
								}
							}
						}
					}
				}
			}
		}
	}
?>