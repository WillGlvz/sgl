<?php  
	include '../../maestros/conexion.php';
	require('../../librerias/clsCorreo.php');
	$cn = new Database();
	$nombres = htmlentities(utf8_decode($_POST['txtnombre']));
	$apellidos = htmlentities(utf8_decode($_POST['txtapellidos']));
	$nit = htmlentities($_POST['txtnit']);
	$correo = htmlentities($_POST['txtcorreo']);
	$tipo = htmlentities(utf8_decode($_POST['cmbtipo']));
	$estado = htmlentities($_POST['cmbestado']);
	$pass = htmlentities($_POST['txtpass']);
	$idTipo = null;
	$est1 = 1;
	$est2 = 0;
	$ruta = "http://localhost/SGL/php/backend/img/default.jpg";
	$url = "http://localhost/SGL/admin-login-systemn-sgl";
	$Mensaje = utf8_decode("Gracias por registrarte en nuestro sistema, para ser un usuario oficial debes seguir las siguientes indicaciones: "."<br>"."<br>"."1) Ingresa al siguiente enlace reservado exclusivamente para administradores: "."<a href='$url'>Login de administración</a>").utf8_decode("<br>"."<br>"."2) Al entrar se te pedirán un usuario y una clave, cabe destacar que estos datos que se te piden NO son los que anteriormente has registrado, deberás ingresar los siguientes datos:"."<br>"."Usuario: Diamond"."<br>"."Clave: 19720716").utf8_decode("<br>"."<br>"."3) Si has ingresado los datos correctamente, ahora deberás iniciar sesión con tu usuario y contraseña."."<br>"."<br>"."4) Finalmente el sistema te pedirá el siguiente código de activación: ").$Codigo;
	$st = $cn->prepare("SELECT usuario_admin FROM administradores WHERE usuario_admin = ?");
	$st->bindParam(1, $nit);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		$st = $cn->prepare("SELECT correo_admin FROM administradores WHERE correo_admin = ?");
		$st->bindParam(1, $correo);
		$st->execute();
		if ($st->fetch()) {
			echo 2;
		}else{
			$st = $cn->prepare("SELECT id_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
			$st->bindParam(1, $tipo);
			$st->execute();
			$result = $st->fetch();
			$idTipo = $result['id_tipo_usuario'];
			$st = $cn->prepare("INSERT INTO administradores(nombres_admin, apellidos_admin, usuario_admin, correo_admin, 
				img_admin, codigo_confirmacion, codigo_activacion, url_login_admin, contrasenia_admin, id_tipo_usuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?, md5(sha1(?)), ?)");
			$st->bindParam(1, $nombres);
			$st->bindParam(2, $apellidos);
			$st->bindParam(3, $nit);
			$st->bindParam(4, $correo);
			$st->bindParam(5, $ruta);
			$st->bindParam(6, $Codigo);
			if ($estado == 'Habilitado') {
				$st->bindParam(7, $est1);
			}else{
				$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $correo, utf8_decode("Activación de cuenta"), $Mensaje);
				$st->bindParam(7, $est2);
			}
			$st->bindParam(8, $url);
			$st->bindParam(9, $pass);
			$st->bindParam(10, $idTipo);
			if ($st->execute()) {
				echo 3;
			}else{
				echo 4;
			}		
		}
	}
?>