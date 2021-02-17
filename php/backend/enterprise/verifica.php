<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT estado_sesion FROM administradores");
	$st->execute();
	$res = $st->fetch();
	if ($res['estado_sesion'] == 1) {
		echo "<h2 class='text-center letra4x'>Administrador disponible</h2>";
	}else{
		echo "<h2 class='text-center letra4x'>No hay admin disponible</h2>";
	}
?>