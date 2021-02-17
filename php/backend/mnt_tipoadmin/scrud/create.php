<?php
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombres = htmlentities(utf8_decode($_POST['txtnombre']));
	$descripcion = htmlentities(utf8_decode($_POST['txtdescripcion']));
	$cargo = $_POST['cmbcargo'];
	$tipou = $_POST['chktipou'];
	$admin = $_POST['chkadmin'];
	$empre = $_POST['chkempre'];
	$merc = utf8_decode($_POST['chkmerc']);
	$unim = $_POST['chkunim'];
	$tipom = utf8_decode($_POST['chktipom']);
	$comprob = $_POST['chkcomprob'];
	$front = $_POST['chkfront'];
	$valortipou = FALSE;
	$valoradmin = FALSE;
	$valorempre = FALSE;
	$valormerc = FALSE;
	$valorunim = FALSE;
	$valortipom = FALSE;
	$valorcomprob = FALSE;
	$valorfront = FALSE;
	$st = $cn->prepare("SELECT nombre_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
	$st->bindParam(1, $nombres);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		if ($tipou == "Tipos usuarios")
			$valortipou = TRUE;
		if ($front == "Frontend")
			$valorfront = TRUE;
		if($admin == "Administradores")
			$valoradmin = TRUE;
		if($empre == "Empresas")
			$valorempre = TRUE;
		if($unim == "Unidades de medida")
			$valorunim = TRUE;
		if($tipom == utf8_decode("Tipo mercancías"))
			$valortipom = TRUE;
		if($comprob == "Comprobantes")
			$valorcomprob = TRUE;
		if ($merc == utf8_decode("Mercancías")){
			$valormerc = TRUE;
		}
		$st = $cn->prepare("INSERT INTO tipos_usuarios(nombre_tipo_usuario, descripcion_tipo_usuario,
			identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, permiso_merc,
			permiso_unim, permiso_tipom, permiso_comprob, permiso_front) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$st->bindParam(1, $nombres);
		$st->bindParam(2, $descripcion);
		$st->bindParam(3, $cargo);
		$st->bindParam(4, $valortipou);
		$st->bindParam(5, $valoradmin);
		$st->bindParam(6, $valorempre);
		$st->bindParam(7, $valormerc);
		$st->bindParam(8, $valorunim);
		$st->bindParam(9, $valortipom);
		$st->bindParam(10, $valorcomprob);
		$st->bindParam(11, $valorfront);
		if ($st->execute()) {
			$st = $cn->prepare("SELECT count(id_tipo_usuario) AS sum FROM tipos_usuarios");
			$st->bindParam(1, $nombres);
			$st->execute();
			$last = $st->fetch();
			if ($last['sum'] >= 1) {
				$st = $cn->prepare("UPDATE tipos_usuarios SET id_tipo_usuario = ? WHERE nombre_tipo_usuario = ?");
				$st->bindParam(1, $last['sum'], PDO::PARAM_INT);
				$st->bindParam(2, $nombres);
				$st->execute();
				echo 2;
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}
	}
?>
