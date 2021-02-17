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
		if($id == 1){
			echo 2;
		}else{
			$st = $cn->prepare("DELETE FROM administradores WHERE id_admin = ?");
			$st->bindParam(1, $id);
			if($st->execute()){
				echo 3;
			}else{
				echo 4;
			}
		}
	}
?>