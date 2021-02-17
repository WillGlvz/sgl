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
	$st = $cn->prepare("SELECT COUNT(*) AS total FROM administradores");
	$st->execute();
	$res1 = $st->fetch();
	$st = $cn->prepare("SELECT COUNT(*) AS total FROM empresas");
	$st->execute();
	$res2 = $st->fetch();
	$st = $cn->prepare("SELECT id_admin, img_admin FROM administradores WHERE nombres_admin = ?");
	$st->bindParam(1, $_SESSION['nombre']);
	$st->execute();
	$res3 = $st->fetch();
	$st = $cn->prepare("SELECT SUM(cant_cajas_merc) AS total FROM mercancias");
	$st->execute();
	$res4 = $st->fetch();
	$st = $cn->prepare("SELECT SUM(cantidad_cajas) AS total FROM comprobantes");
	$st->execute();
	$res5 = $st->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:90px; background-color: #F0E7C0;">
	<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contenedor">
					<img src="<?php echo $res3['img_admin']; ?>" class="center-block" width="555" height="420">
				</div>
				<ul class="list-group">
					<li class="list-group-item list-group-item-danger text-center"><strong class="subtitulo2">Hola, <?php echo $_SESSION['nombre']; ?></strong></li>
				<ul>
			</div>
			<br>
			<div class="col-md-6">
				<li class="list-group-item list-group-item-success text-center"><strong class="subtitulo2">Panel de administración</strong></li>
				<li class="list-group-item list-group-item-info text-center"><p class="text-justify letra4">
					Este es el panel de administración reservado solamente para el administrador principal del sistema,
					desde esta interfáz podrá realizar los cambios que desee de todos los registros del sistema. Asimismo
					Podrá visualizar toda actividad que empresas y otros administradores realizen en este sistema.
				</p></li>
				<li class="list-group-item list-group-item-warning text-center">
					<img src="../img/sgl-logo.png" class="img-responsive center-block" width="550" height="550">	
				</li>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<br><br><br>
				<div class="panel panel-primary">
					<div class="panel-heading"><p class="letra5">Usuarios registrados</p></div>
					<br>
					<p class="text-center letra4">Administradores registrados actualmente: <?php  echo $res1['total'];?></p>
					<br>
					<p class="text-center letra4">Empresas registradas actualmente: <?php  echo $res2['total'];?></p>
				</div>
			</div>
			<div class="col-md-6 ">
				<br><br><br>
				<div class="panel panel-info">
					<div class="panel-heading"><p class="letra5">Mercancías</p></div>
					<br>
					<p class="text-center letra4">Total de cajas registradas en el despósito fiscal: <?php  echo $res4['total'];?></p>
					<br>
					<p class="text-center letra4">Total de cajas retiradas del depósito fiscal: <?php  echo $res5['total'];?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<br><br>
				<div class="panel panel-success">
					<div class="panel-heading"><p class="letra5">Localización actual</p></div>
					<br>
					<p class="text-center letra4">El siguiente mapa muestra una ubicación proxima a tu localización actual</p>
					<br>
					<div id="geo" class="center-block"></div>
					<div id="mapholder" class="center-block"></div>
					<br>
					<div class="row">
						<div class="col-xs-4 col-xs-offset-4">
							<button type="button" onclick="cargarmap()" class="btn btn-danger btn-block">Mostrar mapa</button>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var x=document.getElementById("geo");
		function cargarmap(){
		navigator.geolocation.getCurrentPosition(showPosition,showError);
		function showPosition(position)
		  {
		  lat=position.coords.latitude;
		  lon=position.coords.longitude;
		  latlon=new google.maps.LatLng(lat, lon)
		  mapholder=document.getElementById('mapholder')
		  mapholder.style.height='500px';
		  mapholder.style.width='800px';
		  var myOptions={
		  center:latlon,zoom:10,
		  mapTypeId:google.maps.MapTypeId.ROADMAP,
		  mapTypeControl:false,
		  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
		  };
		  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
		  var marker=new google.maps.Marker({position:latlon,map:map,title:"¡Tu localización!"});
		  }
		function showError(error)
		  {
		  switch(error.code)
		    {
		    case error.PERMISSION_DENIED:
		      swal("Lo sentimos", "Denegada la peticion de Geolocalización en el navegador.", "warning");
		      break;
		    case error.POSITION_UNAVAILABLE:
		      swal("Lo sentimos", "La información de la localización no esta disponible.", "warning");
		      break;
		    case error.TIMEOUT:
		      swal("Lo sentimos", "El tiempo de petición ha expirado.", "warning");
		      break;
		    case error.UNKNOWN_ERROR:
		      swal("Lo sentimos", "Ha ocurrido un error desconocido.", "warning");
		      break;
		    }
		  }}
	</script>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>
