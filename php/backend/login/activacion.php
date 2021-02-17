<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$cod = $_GET['co']; 
	$NuevoCo = 1;
	$st = $cn->prepare("SELECT usuario_admin FROM administradores WHERE codigo_confirmacion = ?");
	$st->bindParam(1, $cod);
	$st->execute();
	$result = $st->fetch();
	if ($result) {
		$nombre = $result['usuario_admin'];
		$st = $cn->prepare("SELECT codigo_confirmacion FROM administradores WHERE usuario_admin = ? AND codigo_confirmacion = ?");
		$st->bindParam(1, $nombre);
		$st->bindParam(2, $cod);
		$st->execute();
		if($st->fetch()){
			$st = $cn->prepare("UPDATE administradores SET codigo_activacion = ? WHERE codigo_confirmacion = ?");
			$st->bindParam(1, $NuevoCo);
			$st->bindParam(2, $cod);
			if ($st->execute()) {
				echo 1;
			}
		}
	}else{
		echo 0;
	}
?>