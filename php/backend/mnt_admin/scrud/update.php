<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombres = htmlentities(utf8_decode($_POST['txtnombre2']));
	$apellidos = htmlentities(utf8_decode($_POST['txtapellidos2']));
	$nit = htmlentities($_POST['txtnit2']);
	$correo = htmlentities($_POST['txtcorreo2']);
	$tipo = htmlentities(utf8_decode($_POST['cmbtipo2']));
	$estado = htmlentities($_POST['cmbestado2']);
	$idTipo = null;
	$id = null;
	$id = $_GET['id'];
	$est1 = 1;
	$est2 = 0;
	$st = $cn->prepare("SELECT usuario_admin FROM administradores WHERE usuario_admin = ? AND !(id_admin = ?)");
	$st->bindParam(1, $nit);
	$st->bindParam(2, $id);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		$st = $cn->prepare("SELECT correo_admin FROM administradores WHERE correo_admin = ? AND !(id_admin = ?)");
		$st->bindParam(1, $correo);
		$st->bindParam(2, $id);
		$st->execute();
		if ($st->fetch()) {
			echo 2;
		}else{
			$st = $cn->prepare("SELECT id_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
			$st->bindParam(1, $tipo);
			$st->execute();
			$result = $st->fetch();
			$idTipo = $result['id_tipo_usuario'];
			$st = $cn->prepare("UPDATE administradores SET nombres_admin = ?, apellidos_admin = ?, usuario_admin = ?,
				correo_admin = ?, codigo_activacion = ?, id_tipo_usuario = ? WHERE id_admin = ?");
			$st->bindParam(1, $nombres);
			$st->bindParam(2, $apellidos);
			$st->bindParam(3, $nit);
			$st->bindParam(4, $correo);
			if ($estado == 'Habilitado') {
				$st->bindParam(5, $est1);
			}else{
				$st->bindParam(5, $est2);
			}
			$st->bindParam(6, $idTipo);
			$st->bindParam(7, $id);
			if ($st->execute()) {
				echo 3;
			}else{
				echo 4;
			}
		}
	}
?>