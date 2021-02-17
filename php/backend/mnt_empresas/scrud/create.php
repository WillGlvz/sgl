<?php  
	include '../../maestros/conexion.php';
	require('../../librerias/clsCorreo.php');
	$cn = new Database();
	$nombre = htmlentities(utf8_decode($_POST['txtnombre']));
	$descripcion = htmlentities(utf8_decode($_POST['txtdescripcion']));
	$direccion = htmlentities(utf8_decode($_POST['txtdireccion']));
	$correo = htmlentities($_POST['txtcorreo']);
	$telefono = htmlentities($_POST['txttel']);
	$nit = $_POST['txtnit'];
	$nrc = $_POST['txtnrc'];
	$nombrecont = htmlentities(utf8_decode($_POST['txtcont']));
	$telcont = htmlentities($_POST['txtcontel']);
	$corcont = htmlentities($_POST['txtconcor']);
	$municipios = $_POST['cmbmunicipios'];
	$pass = htmlentities(utf8_decode($_POST['txtpass']));
	$idTipo = 2;
	$idMuni = null;
	$Mensaje = utf8_decode("Gracias por elegir a Servicios Globales Logísticos, estos son los datos para que puedas ingresar a tu cuenta: "."<br>"."<br>"."NIT: ".$nit."<br>"."Clave: ".$pass."<br>"."<br>"."Gracias.");
	$st = $cn->prepare("SELECT nombre_municipio FROM municipios WHERE id_municipio = ?");
	$st->bindParam(1, $municipios);
	$st->execute();
	$rs2 = $st->fetch();
	$NombreMuni = $rs2['nombre_municipio'];
	$st = $cn->prepare("SELECT nombre_empresa FROM empresas WHERE nombre_empresa = ?");
	$st->bindParam(1, $nombre);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		$st = $cn->prepare("SELECT telefono_empresa FROM empresas WHERE telefono_empresa = ?");
		$st->bindParam(1, $telefono);
		$st->execute();
		if ($st->fetch()) {
			echo 2;
		}else{
			$st = $cn->prepare("SELECT correo_empresa FROM empresas WHERE correo_empresa = ?");
			$st->bindParam(1, $correo);
			$st->execute();
			if ($st->fetch()) {
				echo 3;
			}
			else{
				$st = $cn->prepare("SELECT nit_empresa FROM empresas WHERE nit_empresa = ?");
				$st->bindParam(1, $nit);
				$st->execute();
				if ($st->fetch()) {
					echo 4;
				}else{
					$st = $cn->prepare("SELECT nrc_empresa FROM empresas WHERE nrc_empresa = ?");
					$st->bindParam(1, $nrc);
					$st->execute();
					if ($st->fetch()) {
						echo 5;
					}else{
						$st = $cn->prepare("SELECT telf_contacto_empresa FROM empresas WHERE telf_contacto_empresa = ?");
						$st->bindParam(1, $telcont);
						$st->execute();
						if ($st->fetch()) {
							echo 6;
						}else{
							$st = $cn->prepare("SELECT correo_contacto_empresa FROM empresas WHERE correo_contacto_empresa = ?");
							$st->bindParam(1, $corcont);
							$st->execute();
							if ($st->fetch()) {
								echo 7;
							}else{
								$st = $cn->prepare("SELECT id_municipio FROM municipios WHERE nombre_municipio = ?");
								$st->bindParam(1, $NombreMuni);
								$st->execute();
								$result3 = $st->fetch();
								$idMuni = $result3['id_municipio'];
								$st = $cn->prepare("INSERT INTO empresas(nombre_empresa, descripcion_empresa, direccion_empresa, telefono_empresa, correo_empresa, nit_empresa, nrc_empresa, 
									contacto_empresa, telf_contacto_empresa, correo_contacto_empresa, contrasenia_empresa, id_tipo_usuario, id_municipio) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, md5(sha1(?)), ?, ?)");
								$st->bindParam(1, $nombre);
								$st->bindParam(2, $descripcion);
								$st->bindParam(3, $direccion);
								$st->bindParam(4, $telefono);
								$st->bindParam(5, $correo);
								$st->bindParam(6, $nit);
								$st->bindParam(7, $nrc);
								$st->bindParam(8, $nombrecont);
								$st->bindParam(9, $telcont);
								$st->bindParam(10, $corcont);
								$st->bindParam(11, $pass);
								$st->bindParam(12, $idTipo);
								$st->bindParam(13, $idMuni);
								if ($st->execute()) {
									$Enviar = mthEnviar(utf8_decode("Servicios Globales Logísticos"), "edugal_01@outlook.com", $correo, utf8_decode("Bievenido ".$nombre), $Mensaje);
									echo 8;
								}else{
									echo 9;
								}
							}	
						}
					}
				}
			}		
		}
	}
?>