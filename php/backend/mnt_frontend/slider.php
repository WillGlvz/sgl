<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin');
	}
	$st = $cn->prepare("SELECT permiso_front FROM administradores a INNER JOIN tipos_usuarios t ON
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_front'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin';</script>";
	}
  $st = $cn->prepare("SELECT id_slider, url_imagen FROM slider WHERE id_slider = 1");
	$st->execute();
  $result = $st->fetch();
  $st = $cn->prepare("SELECT id_slider, url_imagen FROM slider WHERE id_slider = 2");
	$st->execute();
  $result2 = $st->fetch();
  $st = $cn->prepare("SELECT id_slider, url_imagen FROM slider WHERE id_slider = 3");
	$st->execute();
  $result3 = $st->fetch();
  $st = $cn->prepare("SELECT id_slider, url_imagen FROM slider WHERE id_slider = 4");
	$st->execute();
  $result4 = $st->fetch();
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
		<div class="panel panel-success" style="margin-top:40px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Imagenes actuales del slider</p>
		  </div>
		  <div class="panel-body">
		    <br>
        <div class="row">
          <div class="col-md-6">
            <div class="contenedor">
              <img src="http://localhost/SGL/img/<?php echo $result['url_imagen']; ?>" with="200px" height="200px" class="center-block"/>
              <a href="http://localhost/SGL/admin/cpanel/frontend-update-slider/<?php echo $result['id_slider']; ?>"><p class="text-center" style="margin-top: 10px;">Modificar</p></a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contenedor2">
              <img src="http://localhost/SGL/img/<?php echo $result2['url_imagen']; ?>" with="200px" height="200px" class="center-block"/>
              <a href="http://localhost/SGL/admin/cpanel/frontend-update-slider/<?php echo $result2['id_slider']; ?>"><p class="text-center" style="margin-top: 10px;">Modificar</p></a>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="contenedor3">
              <img src="http://localhost/SGL/img/<?php echo $result3['url_imagen']; ?>" with="200px" height="200px" class="center-block"/>
              <a href="http://localhost/SGL/admin/cpanel/frontend-update-slider/<?php echo $result3['id_slider']; ?>"><p class="text-center" style="margin-top: 10px;">Modificar</p></a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contenedor4">
              <img src="http://localhost/SGL/img/<?php echo $result4['url_imagen']; ?>" with="200px" height="200px" class="center-block"/>
              <a href="http://localhost/SGL/admin/cpanel/frontend-update-slider/<?php echo $result4['id_slider']; ?>"><p class="text-center" style="margin-top: 10px;">Modificar</p></a>
            </div>
          </div>
        </div>
		  </div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>
