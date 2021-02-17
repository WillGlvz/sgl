<?php  
	session_start();
	include '../maestros/conexion_chat.php';
	$con = new Database();
	date_default_timezone_set("America/El_Salvador");
	$fecha = date("Y-m-d");
	$hora = date("H:i:s");
	$id = $_SESSION['id'];
	$usu = $_SESSION['nombre'];
	$st = $con->prepare("SELECT COUNT(*) AS Total FROM mensajes");
	$st->execute();
	$res = $st->fetch();
		if ($res['Total'] <= 0) {
			$mensaje = utf8_decode(htmlentities($_POST['txtmensaje']));
			$st = $con->prepare("INSERT INTO mensajes(usuario, mensaje, fecha_mensaje, hora_mensaje, id) VALUES(?, ?, ?, ?, ?)");
			$st->bindParam(1, $usu);
			$st->bindParam(2, $mensaje);
			$st->bindParam(3, $fecha);
			$st->bindParam(4, $hora);
			$st->bindParam(5, $id);
			$st->execute();	
		}else{
			$mensaje = utf8_decode(htmlentities($_POST['txtmensaje']));
			$st = $con->prepare("INSERT INTO mensajes(usuario, mensaje, fecha_mensaje, hora_mensaje, id) VALUES(?, ?, ?, ?, ?)");
			$st->bindParam(1, $usu);
			$st->bindParam(2, $mensaje);
			$st->bindParam(3, $fecha);
			$st->bindParam(4, $hora);
			$st->bindParam(5, $id);
			$st->execute();			
		}
?>