<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	$contra = htmlentities($_POST['txtcontra0']);
	$nuevacontra = htmlentities($_POST['txtcontra']);
	$id = null;
	$id = $_SESSION['id'];
	$st = $cn->prepare("SELECT id_admin FROM administradores WHERE id_admin = ? AND contrasenia_admin = md5(sha1(?))");
	$st->bindParam(1, $id);
	$st->bindParam(2, $contra);
	$st->execute();
	if($st->fetch()){
		$stm = $cn->prepare("UPDATE administradores SET contrasenia_admin = md5(sha1(?)) WHERE id_admin = ?");
		$stm->bindParam(1, $nuevacontra);
		$stm->bindParam(2, $id);
		if ($stm->execute()) {
			echo 1;
		}else{
			echo 2;
			
		}
	}else{
		echo 3;
	}
?>