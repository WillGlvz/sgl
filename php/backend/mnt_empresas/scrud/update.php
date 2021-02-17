<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$nombre = htmlentities(utf8_decode($_POST['txtnombre2']));
	$descripcion = htmlentities(utf8_decode($_POST['txtdescripcion2']));
	$direccion = htmlentities(utf8_decode($_POST['txtdireccion2']));
	$correo = htmlentities($_POST['txtcorreo2']);
	$telefono = htmlentities($_POST['txttel2']);
	$nit = $_POST['txtnit2'];
	$nrc = $_POST['txtnrc2'];
	$nombrecont = htmlentities(utf8_decode($_POST['txtcont2']));
	$telcont = htmlentities($_POST['txtcontel2']);
	$corcont = htmlentities($_POST['txtconcor2']);
	$municipios = htmlentities($_POST['cmbmunicipios2']);
	$idTipo = null;
	$idTipo = 2;
	$idMuni = null;
	$id = null;
	$id = $_GET['id'];
	$st = $cn->prepare("SELECT nombre_municipio FROM municipios WHERE id_municipio = ?");
	$st->bindParam(1, $municipios);
	$st->execute();
	$rs2 = $st->fetch();
	$NombreMuni = $rs2['nombre_municipio'];
	$st = $cn->prepare("SELECT nombre_empresa FROM empresas WHERE nombre_empresa = ? AND !(id_empresa = ?)");
	$st->bindParam(1, $nombre);
	$st->bindParam(2, $id);
	$st->execute();
	if ($st->fetch()) {
		echo 1;
	}else{
		$st = $cn->prepare("SELECT telefono_empresa FROM empresas WHERE telefono_empresa = ? AND !(id_empresa = ?)");
		$st->bindParam(1, $telefono);
		$st->bindParam(2, $id);
		$st->execute();
		if ($st->fetch()) {
			echo 2;
		}else{
			$st = $cn->prepare("SELECT correo_empresa FROM empresas WHERE correo_empresa = ? AND !(id_empresa = ?)");
			$st->bindParam(1, $correo);
			$st->bindParam(2, $id);
			$st->execute();
			if ($st->fetch()) {
				echo 3;
			}
			else{
				$st = $cn->prepare("SELECT nit_empresa FROM empresas WHERE nit_empresa = ? AND !(id_empresa = ?)");
				$st->bindParam(1, $nit);
				$st->bindParam(2, $id);
				$st->execute();
				if ($st->fetch()) {
					echo 4;
				}else{
					$st = $cn->prepare("SELECT nrc_empresa FROM empresas WHERE nrc_empresa = ? AND !(id_empresa = ?)");
					$st->bindParam(1, $nrc);
					$st->bindParam(2, $id);
					$st->execute();
					if ($st->fetch()) {
						echo 5;
					}else{
						$st = $cn->prepare("SELECT telf_contacto_empresa FROM empresas WHERE telf_contacto_empresa = ? AND !(id_empresa = ?)");
						$st->bindParam(1, $telcont);
						$st->bindParam(2, $id);
						$st->execute();
						if ($st->fetch()) {
							echo 6;
						}else{
							$st = $cn->prepare("SELECT correo_contacto_empresa FROM empresas WHERE correo_contacto_empresa = ? AND !(id_empresa = ?)");
							$st->bindParam(1, $corcont);
							$st->bindParam(2, $id);
							$st->execute();
							if ($st->fetch()) {
								echo 7;
							}else{
								$st = $cn->prepare("SELECT id_municipio FROM municipios WHERE nombre_municipio = ?");
								$st->bindParam(1, $NombreMuni);
								$st->execute();
								$result3 = $st->fetch();
								$idMuni = $result3['id_municipio'];
								$st = $cn->prepare("UPDATE empresas SET nombre_empresa = ?, descripcion_empresa = ?, direccion_empresa = ?, telefono_empresa = ?, correo_empresa = ?, nit_empresa = ?, nrc_empresa = ?, 
									contacto_empresa = ?, telf_contacto_empresa = ?, correo_contacto_empresa = ?, id_tipo_usuario = ?, id_municipio = ? WHERE id_empresa = ?");
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
								$st->bindParam(11, $idTipo);
								$st->bindParam(12, $idMuni);
								$st->bindParam(13, $id);
								if ($st->execute()) {
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