<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	date_default_timezone_set("America/El_Salvador");
	$nit = utf8_decode($_POST['txtnit']);
	$contra = utf8_decode($_POST['txtcontrase']);
	$fecha = date("Y-m-d");
	$cerrar = 1;
	$hora = date("H:i:s");
	$st = $cn->prepare("SELECT codigo_activacion FROM administradores WHERE usuario_admin = ? AND codigo_activacion = 0");
	$st->bindParam(1, $nit);
	$st->execute();
	if($st->fetch()){
		echo 1;
	}else{
		$st = $cn->prepare("SELECT id_admin, nombres_admin, usuario_admin, contrasenia_admin FROM administradores WHERE usuario_admin = ? AND contrasenia_admin = md5(sha1(?))");
		$st->bindParam(1, $nit);
		$st->bindParam(2, $contra);
		$st->execute();
		$res = $st->fetch();
		if ($res) {
			$st = $cn->prepare("INSERT INTO historiales(fecha_historial, hora_historial, nom_admin) 
			VALUES(?, ?, ?)");
			$st->bindParam(1, $fecha);
			$st->bindParam(2, $hora);
			$st->bindParam(3, $res['nombres_admin']);
			if ($st->execute()) {
				$st = $cn->prepare("SELECT estado_sesion FROM administradores WHERE usuario_admin = ?");
				$st->bindParam(1, $nit);
				$st->execute();
				$estado = $st->fetch();
				if ($estado['estado_sesion'] == 1) {
					$_SESSION['id'] = $res['id_admin'];
					$_SESSION['nombre'] = $res['nombres_admin'];
					echo 4;
				}else{
					$_SESSION['id'] = $res['id_admin'];
					$_SESSION['nombre'] = $res['nombres_admin'];
					$st = $cn->prepare("UPDATE administradores SET estado_sesion = ? WHERE id_admin = ?");
					$st->bindParam(1, $cerrar);
					$st->bindParam(2, $res['id_admin']);
					$st->execute();
					echo 2;
				}
			}
		}else{
			echo 3;
		}
	}
?>