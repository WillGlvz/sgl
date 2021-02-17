<?php  
	session_start();
	include '../../maestros/conexion.php';
	$cn = new Database();
	$id = null;
	$id = $_GET['id'];
	$idadmin = null;
	$idadmin = $_SESSION['id'];
	if ($id == $idadmin) {
		echo 1;
	}else{
		try {
			$st = $cn->prepare("DELETE FROM tipos_usuarios WHERE id_tipo_usuario = ?");
			$st->bindParam(1, $id);
			if($st->execute()){
				echo 3;
			}else{
				echo 4;
			}
		} catch (Exception $e) {
			echo 2;
		}
	}
?>