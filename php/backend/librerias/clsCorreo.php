<?php
	function mthEnviar($name, $de, $para, $asunto, $mensaje){
		include_once("class.phpmailer.php");
		include_once("class.smtp.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->FromName = $name;
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->from = $de;
		$mail->AddAddress($para);
		$mail->Username = "easyparkingsystem7@gmail.com";
		$mail->Password = "will01king";
		$mail->Subject = $asunto;
		$mail->Body = $mensaje;
		$mail->WordWrap = 50;
		$mail->MsgHTML($mensaje);
		$mail->Send();
	}

	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$numerodeletras=20;
	$Codigo = "";
	for($i=0;$i<$numerodeletras;$i++){
		$Codigo .= substr($caracteres,rand(0,strlen($caracteres)),1);
	}
?>