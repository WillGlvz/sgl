<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	$cerrar = 0;
	$st = $cn->prepare("UPDATE administradores SET estado_sesion = ? WHERE id_admin = ?");
	$st->bindParam(1, $cerrar);
	$st->bindParam(2, $_SESSION['id']);
	$st->execute();
	unset($_SESSION['id']);
	unset($_SESSION['nombre']);
	echo "<script>window.location='http://localhost/SGL/admin-login-system-sgl';</script>";
?>