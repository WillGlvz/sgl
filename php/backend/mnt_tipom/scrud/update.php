<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombre = htmlentities(utf8_decode($_POST['txtnombre2']));
	$descripcion = htmlentities(utf8_decode($_POST['txtdescripcion2']));
	$id = null;
	$id = $_GET['id'];
	$st = $cn->prepare("SELECT nombre_tipo_mercancia FROM tipo_mercancias WHERE nombre_tipo_mercancia = ? AND !(id_tipo_merc = ?)");
	$st->bindParam(1, $nombre);
	$st->bindParam(2, $id);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		$st = $cn->prepare("UPDATE tipo_mercancias SET nombre_tipo_mercancia = ?, descripcion_tipo_mercancia = ? WHERE id_tipo_merc = ?");
		$st->bindParam(1, $nombre);
		$st->bindParam(2, $descripcion);
		$st->bindParam(3, $id);
		if ($st->execute()) {
			echo 2;
		}else{
			echo 3;
		}
	}
?>