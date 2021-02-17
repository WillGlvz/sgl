<?php  
	session_start();
	include '../../maestros/conexion.php';
	$cn = new Database();
	$id = null;
	$id = $_GET['id'];
	try {
		$st = $cn->prepare("DELETE FROM numerosdm WHERE id_dm = ?");
		$st->bindParam(1, $id);
		if($st->execute()){
			echo 1;
		}else{
			echo 2;
		}
	} catch (Exception $e) {
		echo 3;
	}
?>