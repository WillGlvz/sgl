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
	$st = $cn->prepare("SELECT titulo_seccion FROM secciones WHERE id_seccion = 5");
	$st->execute();
  	$result = $st->fetch();
  	$st = $cn->prepare("SELECT * FROM servicios WHERE id_servicio = 1");
	$st->execute();
	$result2 = $st->fetch();
	$st = $cn->prepare("SELECT * FROM servicios WHERE id_servicio = 2");
	$st->execute();
	$result3 = $st->fetch();
	$st = $cn->prepare("SELECT * FROM servicios WHERE id_servicio = 3");
	$st->execute();
	$result4 = $st->fetch();
	$st = $cn->prepare("SELECT * FROM servicios WHERE id_servicio = 4");
	$st->execute();
	$result5 = $st->fetch();
	$st = $cn->prepare("SELECT * FROM servicios WHERE id_servicio = 5");
	$st->execute();
	$result6 = $st->fetch();
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
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Listado de servicios</p>
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
		    <br>
		    <div class="row">
		    	<div class="col-md-2">
		    		<input type="text" name="txtcarga" class="form-control" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result2['titulo_servicio']); ?>"/>
		    	</div>
		    	<div class="col-md-2">
		    		<input type="text" name="txtalmacenaje" class="form-control" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result3['titulo_servicio']); ?>"/>
		    	</div>
		    	<div class="col-md-2">
		    		<input type="text" name="txtaduana" class="form-control" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result4['titulo_servicio']); ?>"/>
		    	</div>
		    	<div class="col-md-2">
		    		<input type="text" name="txtseguros" class="form-control" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result5['titulo_servicio']); ?>"/>
		    	</div>
		    	<div class="col-md-2">
		    		<input type="text" name="txtpermisos" class="form-control" pattern=".{3,}" required autocomplete="off" value="<?php echo utf8_encode($result6['titulo_servicio']); ?>"/>
		    	</div>
		    	</form>
		    </div>
		    <br>
		    <div class="row">
		    	<div class="col-md-2">
		    		<a href=""><p class="text-center">ver detalles</p></a>
		    	</div>
		    	<div class="col-md-2">
		    		<a href=""><p class="text-center">ver detalles</p></a>
		    	</div>
		    	<div class="col-md-2">
		    		<a href=""><p class="text-center">ver detalles</p></a>
		    	</div>
		    	<div class="col-md-2">
		    		<a href=""><p class="text-center">ver detalles</p></a>
		    	</div>
		    	<div class="col-md-2">
		    		<a href=""><p class="text-center">ver detalles</p></a>
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
		$carga = htmlentities(utf8_decode($_POST['txtcarga']));
		$almacenaje = htmlentities(utf8_decode($_POST['txtalmacenaje']));
		$aduana = htmlentities(utf8_decode($_POST['txtaduana']));
		$seguros = htmlentities(utf8_decode($_POST['txtseguros']));
		$permisos = htmlentities(utf8_decode($_POST['txtpermisos']));
		$st = $cn->prepare("UPDATE secciones SET titulo_seccion = ? WHERE id_seccion = 5");
		$st->bindParam(1, $title);
		$st->execute();
		$st = $cn->prepare("UPDATE servicios SET titulo_servicio = ? WHERE id_servicio = 1");
		$st->bindParam(1, $carga);
		$st->execute();
		$st = $cn->prepare("UPDATE servicios SET titulo_servicio = ? WHERE id_servicio = 2");
		$st->bindParam(1, $almacenaje);
		$st->execute();
		$st = $cn->prepare("UPDATE servicios SET titulo_servicio = ? WHERE id_servicio = 3");
		$st->bindParam(1, $aduana);
		$st->execute();
		$st = $cn->prepare("UPDATE servicios SET titulo_servicio = ? WHERE id_servicio = 4");
		$st->bindParam(1, $seguros);
		$st->execute();
		$st = $cn->prepare("UPDATE servicios SET titulo_servicio = ? WHERE id_servicio = 5");
		$st->bindParam(1, $permisos);
		if ($st->execute()) {
			echo "<script>swal('¡Completado!', 'Titulo modificado con exito.', 'success');</script>";
			echo "<script>setTimeout(function(){ window.location='http://localhost/SGL/admin/cpanel/frontend-strategy'; }, 2000);</script>";
		}else{
			echo "<script>swal('¡Aviso!', 'Al parecer a ocurrido algun error.', 'error');</script>";
		}
	}
?>