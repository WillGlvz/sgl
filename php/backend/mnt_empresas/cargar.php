<?php  
	session_start();
	include '../maestros/conexion_chat.php';
	$con = new Database();
	$st = $con->prepare("SELECT usuario, mensaje FROM mensajes");
	$st->execute();
	$res = $st->fetchAll();
	foreach ($res as $key => $value) {
		echo '<p><b>'.$value['usuario'].': '.'</b>'.$value['mensaje'].'</p>';
	}
?>