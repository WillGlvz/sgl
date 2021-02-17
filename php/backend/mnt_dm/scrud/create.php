<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dm = $_POST['txtnumero'];
	$fob = $_POST['txtfob'];
	$flete = $_POST['txtflete'];
	$seguros = $_POST['txtseguros'];
	$gastos = $_POST['txtgastos'];
	$cif = $_POST['txtcif'];
	$bultos = $_POST['txtbultos'];
	$empresa = "nulo";
	$st = $cn->prepare("SELECT numero_dm FROM numerosdm WHERE numero_dm = ?");
	$st->bindParam(1, $dm);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		try {
			$st = $cn->prepare("INSERT INTO numerosdm(numero_dm, fob, flete, seguros, gastos, cif, bultos, empresa) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
			$st->bindParam(1, $dm);
			$st->bindParam(2, $fob);
			$st->bindParam(3, $flete);
			$st->bindParam(4, $seguros);
			$st->bindParam(5, $gastos);
			$st->bindParam(6, $cif);
			$st->bindParam(7, $bultos);
			$st->bindParam(8, $empresa);
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