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
	$st = $cn->prepare("SELECT titulo_seccion FROM secciones WHERE id_seccion = 4");
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
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor planificacion estrategica</p>
		  </div>
		  <div class="panel-body">
		  	<form method="post">
			    <div class="row">
			    	<div class="col-md-3 col-md-offset-3">
						<input type="text" id="tit" name="txttitulo" class="form-control" pattern=".{3,}" required placeholder="Titulo de la seccion" autocomplete="off" value="<?php echo utf8_encode($result['titulo_seccion']); ?>"/>
			    	</div>
			    	<div class="col-md-3">
			    		<button type="submit" name="btnmodi" class="btn btn-success"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
			    	</div>
			    </div>
		    </form>
		    <br>
		    <div class="row">
		    	<div class="col-md-3 col-md-offset-1">
		    		<a href="http://localhost/SGL/admin/cpanel/frontend-update-mision"><img src="http://localhost/SGL/php/backend/img/retirar.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Mision</h2>
		    	</div>
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/admin/cpanel/frontend-update-vision"><img src="http://localhost/SGL/php/backend/img/editar.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Vision</h2>
		    	</div>
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/admin/cpanel/frontend-update-valores"><img src="http://localhost/SGL/php/backend/img/check.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Valores</h2>
		    	</div>
		    </div>
		  </div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>

<?php  
	if (isset($_POST['btnmodi'])) {
		$title = htmlentities(utf8_decode($_POST['txttitulo']));
		$st = $cn->prepare("UPDATE secciones SET titulo_seccion = ? WHERE id_seccion = 4");
		$st->bindParam(1, $title);
		if ($st->execute()) {
			echo "<script>swal('¡Completado!', 'Titulo modificado con exito.', 'success');</script>";
			echo "<script>setTimeout(function(){ window.location='seccion_estrategia.php'; }, 2000);</script>";
		}else{
			echo "<script>swal('¡Aviso!', 'Al parecer a ocurrido algun error.', 'error');</script>";
		}
	}
?>