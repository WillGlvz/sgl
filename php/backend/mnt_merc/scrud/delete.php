<?php  
	session_start();
	include '../../maestros/conexion.php';
	$cn = new Database();
	$id = null;
	$id = $_GET['id'];
	$state = "nulo";
	try {
		$st = $cn->prepare("SELECT nombre_empresa FROM mercancias m INNER JOIN empresas e ON m.id_empresa=e.id_empresa WHERE id_merc = ?");
		$st->bindParam(1, $id);
		$st->execute();
		$res = $st->fetch();
		$st = $cn->prepare("SELECT numero_dm FROM mercancias m INNER JOIN numerosdm n ON m.id_dm=n.id_dm WHERE id_merc = ?");
		$st->bindParam(1, $id);
		$st->execute();
		$res3 = $st->fetch();
		$st = $cn->prepare("SELECT id_dm FROM numerosdm WHERE numero_dm = ?");
		$st->bindParam(1, $res3['numero_dm']);
		$st->execute();
		$res4 = $st->fetch();
		$st = $cn->prepare("DELETE FROM mercancias WHERE id_merc = ?");
		$st->bindParam(1, $id);
		if($st->execute()){
			$st = $cn->prepare("SELECT COUNT(*) AS Total FROM mercancias m INNER JOIN empresas e ON m.id_empresa=e.id_empresa WHERE nombre_empresa = ?");
			$st->bindParam(1, $res['nombre_empresa']);
			$st->execute();
			$res2 = $st->fetch();
			if($res2['Total'] <= 0){
				$st = $cn->prepare("UPDATE numerosdm SET empresa = ? WHERE id_dm = ?");
				$st->bindParam(1, $state);
				$st->bindParam(2, $res4['id_dm']);
				$st->execute();
			}
			echo 1;
		}else{
			echo 2;
		}
	} catch (Exception $e) {
		echo 3;
	}
?>