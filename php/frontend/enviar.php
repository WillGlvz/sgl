<?php   
	require('../backend/librerias/clsCorreo.php');
	$captcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfKfQMTAAAAAKGfD9seoTGtCv6y2Y_rxu7XnIsm&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']),TRUE); 
	if($captcha['success'] === TRUE){ 
		$Mensaje = $_POST['txtmensaje'];
		$Correo = $_POST['txtcorreo'];
		$Asunto = $_POST['txtasunto'];
		$Enviar = mthEnviar(utf8_decode("Consulta de clientes SGL"), $Correo, "edugal_01@outlook.com", utf8_decode($Asunto), utf8_decode($Mensaje));
		echo 1;
	} else { 
		echo 2; 
	} 
?>