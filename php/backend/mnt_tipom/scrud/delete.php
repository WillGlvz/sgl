<?php  
	session_start();
	include '../../maestros/conexion.php';
	$cn = new Database();
	$id = null;
	$id = $_GET['id'];
	try {
		$st = $cn->prepare("DELETE FROM tipo_mercancias WHERE id_tipo_merc = ?");
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