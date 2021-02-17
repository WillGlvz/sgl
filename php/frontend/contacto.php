<?php
	include('clsCorreo.php');
	$Correo = utf8_decode($_POST['txtcorreo']);
	$Asunto = utf8_decode($_POST['txtasunto']);
	$Mensaje = utf8_decode($_POST['txtmensaje']);
	mthEnviar(utf8_decode("Clientes"), $Correo, "will01.king9@gmail.com", utf8_decode($Asunto), utf8_decode($Mensaje));
	echo "Mensaje enviado";
?>