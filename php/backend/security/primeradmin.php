<?php
	include '../librerias/clsCorreo.php';
	include '../maestros/conexion.php';
	$cn = new Database();
	$nombres = htmlentities(utf8_decode($_POST['txtnombre']));
	$apellidos = htmlentities(utf8_decode($_POST['txtapellidos']));
	$usuario = htmlentities(utf8_decode($_POST['txtusuario']));
	$correo = htmlentities(utf8_decode($_POST['txtcorreo']));
	$contra = htmlentities(utf8_decode($_POST['txtcontra']));
	$codigoAct = 0;
	$rutaF = "http://localhost/SGL/php/backend/img/default.jpg";
	$Verifica = 'Administrador';
	$url = "http://localhost/SGL/admin-login-system-sgl";
	$Mensaje = utf8_decode("Gracias por registrarte en nuestro sistema, para ser un usuario oficial debes seguir las siguientes indicaciones: "."<br>"."<br>"."1) Ingresa al siguiente enlace reservado exclusivamente para administradores: "."<a href='$url'>Login de administración</a>").utf8_decode("<br>"."<br>"."2) Al entrar se te pedirán un usuario y una clave, cabe destacar que estos datos que se te piden NO son los que anteriormente has registrado, deberás ingresar los siguientes datos:"."<br>"."Usuario: Diamond"."<br>"."Clave: 19720716").utf8_decode("<br>"."<br>"."3) Si has ingresado los datos correctamente, ahora deberás iniciar sesión con tu usuario y contraseña."."<br>"."<br>"."4) Finalmente el sistema te pedirá el siguiente código de activación: ").$Codigo;
	$st = $cn->prepare("SELECT COUNT(*) AS Total2 FROM tipos_usuarios");
	$st->execute();
	$resul = $st->fetch();
	if($resul['Total2'] <= 0){
		$st = $cn->prepare("ALTER TABLE tipos_usuarios AUTO_INCREMENT = 1");
		$st->execute();
		$st = $cn->prepare("INSERT INTO tipos_usuarios(nombre_tipo_usuario, descripcion_tipo_usuario,
			identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, permiso_merc, permiso_unim,
			permiso_tipom, permiso_comprob) VALUES('Administrador', 'Administrador del sistema', 'Jefe', 1, 1, 1, 1, 1, 1, 1)");
		if ($st->execute()) {
			$st = $cn->prepare("INSERT INTO tipos_usuarios(nombre_tipo_usuario, descripcion_tipo_usuario,
			identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, permiso_merc, permiso_unim,
			permiso_tipom, permiso_comprob) VALUES('Empresas', 'Empresa cliente del sistema', 'Cliente', 0, 0, 0, 0, 0, 0, 0)");
			if ($st->execute()) {
				$st = $cn->prepare("SELECT id_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
				$st->bindParam(1, $Verifica);
				$st->execute();
				$resultado = $st->fetch();
				$idAdmin = $resultado['id_tipo_usuario'];
				$st = $cn->prepare("INSERT INTO administradores(nombres_admin, apellidos_admin, usuario_admin, correo_admin,
					img_admin, codigo_confirmacion, codigo_activacion, url_login_admin, contrasenia_admin, id_tipo_usuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?, md5(sha1(?)), ?)");
				$st->bindParam(1, $nombres);
				$st->bindParam(2, $apellidos);
				$st->bindParam(3, $usuario);
				$st->bindParam(4, $correo);
				$st->bindParam(5, $rutaF);
				$st->bindParam(6, $Codigo);
				$st->bindParam(7, $codigoAct);
				$st->bindParam(8, $url);
				$st->bindParam(9, $contra);
				$st->bindParam(10, $idAdmin);
				if($st->execute()){
					$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $correo, utf8_decode("Activación de cuenta"), $Mensaje);
					echo 1;
				}else{
					echo 2;
				}
			}
		}
	}else{
		$st = $cn->prepare("ALTER TABLE administradores AUTO_INCREMENT = 1");
		$st->execute();
		$st = $cn->prepare("SELECT id_tipo_usuario FROM tipos_usuarios WHERE nombre_tipo_usuario = ?");
		$st->bindParam(1, $Verifica);
		$st->execute();
		$resultado = $st->fetch();
		$idAdmin = $resultado['id_tipo_usuario'];
		$st = $cn->prepare("INSERT INTO administradores(nombres_admin, apellidos_admin, usuario_admin, correo_admin,
			img_admin, codigo_confirmacion, codigo_activacion, url_login_admin, contrasenia_admin, id_tipo_usuario) VALUES(?, ?, ?, ?, ?, ?, ?, ?, md5(sha1(?)), ?)");
		$st->bindParam(1, $nombres);
		$st->bindParam(2, $apellidos);
		$st->bindParam(3, $usuario);
		$st->bindParam(4, $correo);
		$st->bindParam(5, $rutaF);
		$st->bindParam(6, $Codigo);
		$st->bindParam(7, $codigoAct);
		$st->bindParam(8, $url);
		$st->bindParam(9, $contra);
		$st->bindParam(10, $idAdmin);
		if($st->execute()){
			$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $correo, utf8_decode("Activación de cuenta"), $Mensaje);
			echo 3;
		}else{
			echo 4;
		}
	}
?>