<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombre = htmlentities(utf8_decode($_POST['txtnombre']));
	$descripcion = htmlentities(utf8_decode($_POST['txtdescripcion']));
	$st = $cn->prepare("SELECT nombre_tipo_mercancia FROM tipo_mercancias WHERE nombre_tipo_mercancia = ?");
	$st->bindParam(1, $nombre);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		try {
			$st = $cn->prepare("INSERT INTO tipo_mercancias(nombre_tipo_mercancia, descripcion_tipo_mercancia) VALUES(?, ?)");
			$st->bindParam(1, $nombre);
			$st->bindParam(2, $descripcion);
			if ($st->execute()) {
				echo 2;
			}else{
				echo 3;
			}		
		} catch (Exception $e) {
			echo 4;
		}		
	}
?>