<?php  
	include '../../maestros/conexion_chat.php';
	$cn = new Database();
	$st = $cn->prepare("TRUNCATE TABLE mensajes");
	if ($st->execute()) {
		echo 1;
	}else{
		echo 2;
	}
?>