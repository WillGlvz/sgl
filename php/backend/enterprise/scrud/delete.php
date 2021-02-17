<?php  
	session_start();
	include '../../maestros/conexion.php';
	$cn = new Database();
	$id = null;
	$id = $_GET['id'];
	try {
		$st = $cn->prepare("DELETE FROM comprobantes WHERE id_comprobante = ?");
		$st->bindParam(1, $id);
		if($st->execute()){
			echo 3;
		}else{
			echo 4;
		}
	} catch (Exception $e) {
		echo 2;
	}
?>