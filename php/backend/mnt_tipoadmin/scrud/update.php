<?php
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombres = utf8_decode(htmlentities($_POST['txtnombre3']));
	$descripcion = utf8_decode(htmlentities($_POST['txtdescripcion3']));
	$cargo = $_POST['cmbcargo3'];
	$tipou = $_POST['chktipou3'];
	$admin = $_POST['chkadmin3'];
	$empre = $_POST['chkempre3'];
	$merc = utf8_decode($_POST['chkmerc3']);
	$unim = $_POST['chkunim3'];
	$tipom = utf8_decode($_POST['chktipom3']);
	$comprob = $_POST['chkcomprob3'];
	$front = $_POST['chkfront3'];
	$valortipou = FALSE;
	$valoradmin = FALSE;
	$valorempre = FALSE;
	$valormerc = FALSE;
	$valorunim = FALSE;
	$valortipom = FALSE;
	$valorcomprob = FALSE;
	$valorfront = FALSE;
	$id = null;
	$id = $_GET['id'];
	$st = $cn->prepare("SELECT nombre_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ? AND !(id_tipo_usuario = ?)");
	$st->bindParam(1, $nombres);
	$st->bindParam(2, $id);
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
		$st = $cn->prepare("UPDATE tipos_usuarios SET nombre_tipo_usuario = ?, descripcion_tipo_usuario = ?,
			identificador_tipo_usuario = ?, permiso_tipou = ?, permiso_admin = ?, permiso_empre = ?,
			permiso_merc = ?, permiso_unim = ?, permiso_tipom = ?, permiso_comprob = ?, permiso_front = ? WHERE id_tipo_usuario = ?");
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
		$st->bindParam(12, $id);
		if ($st->execute()) {
			echo 2;
		}else{
			echo 3;
		}
	}
?>
