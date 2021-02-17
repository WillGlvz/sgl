<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dm =$_POST['txtnumero2'];
	$fob = $_POST['txtfob2'];
	$flete = $_POST['txtflete2'];
	$seguros = $_POST['txtseguros2'];
	$gastos = $_POST['txtgastos2'];
	$cif = $_POST['txtcif2'];
	$estado = 0;
	$id = null;
	$id = $_GET['id'];
	$st = $cn->prepare("SELECT numero_dm FROM numerosdm WHERE numero_dm = ? AND !(id_dm = ?)");
	$st->bindParam(1, $dm);
	$st->bindParam(2, $id);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		try {
			$st = $cn->prepare("UPDATE numerosdm SET numero_dm = ?, fob = ?, flete = ?, seguros = ?, gastos = ?, cif = ?  WHERE id_dm = ?");
			$st->bindParam(1, $dm);
			$st->bindParam(2, $fob);
			$st->bindParam(3, $flete);
			$st->bindParam(4, $seguros);
			$st->bindParam(5, $gastos);
			$st->bindParam(6, $cif);
			$st->bindParam(7, $id);
			if ($st->execute()) {
				echo 2;
			}else{
				echo 3;
			}		
		} catch (Exception $e) {
			echo 4;
		}		
	}
?>