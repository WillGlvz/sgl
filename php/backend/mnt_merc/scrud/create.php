<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dmnumero = $_POST['cmbdm'];
	$codigomerc = $_POST['txtcodigo'];
	$nombre = utf8_decode(htmlentities($_POST['txtnombre']));
	$numcajas = $_POST['txtcajas'];
	$preciou = $_POST['txtpreciou'];
	$preciov = $_POST['txtpreciov'];
	$cantxcaja = $_POST['txtcantcaja'];
	$ml = $_POST['txtml'];
	$porcalc = $_POST['txtporc'];
	$brutotl = $_POST['txtbru'];
	$valor = $_POST['txtvalor'];
	$botellas = $_POST['txtbotellas'];
	$litros = $_POST['txtlitros'];
	$alicuota = $_POST['txtalicuota'];
	$elc = $_POST['txtelc'];
	$pbc = $_POST['txtpbc'];
	$cif = $_POST['txtcif'];
	$dai = $_POST['txtdai'];
	$flete = $_POST['txtflete1'];
	$seguros = $_POST['txtseguros1'];
	$gastos = $_POST['txtgastos1'];
	$porcali = $_POST['txtporcalc'];
	$porcelc = $_POST['txtporcelc'];
	$porcdai = $_POST['txtporcdai'];
	$tipo = utf8_decode($_POST['cmbtipo']);
	$empresa = utf8_decode($_POST['cmbempre']);
	$idTipo = null;
	$idEmpre = null;
	$idDM = null;
	$empre = "nulo";
	$st = $cn->prepare("SELECT empresa FROM numerosdm WHERE empresa = ? AND numero_dm = ?");
	$st->bindParam(1, $empre);
	$st->bindParam(2, $dmnumero);
	$st->execute();
	if ($st->fetch()) {
		$st = $cn->prepare("UPDATE numerosdm SET empresa = ? WHERE numero_dm = ?");
		$st->bindParam(1, $empresa);
		$st->bindParam(2, $dmnumero);
		if($st->execute()){
			$st = $cn->prepare("SELECT id_tipo_merc FROM tipo_mercancias WHERE nombre_tipo_mercancia = ?");
			$st->bindParam(1, $tipo);
			$st->execute();
			$result = $st->fetch();
			$idTipo = $result['id_tipo_merc'];
			$st = $cn->prepare("SELECT id_empresa FROM empresas WHERE nombre_empresa = ?");
			$st->bindParam(1, $empresa);
			$st->execute();
			$result1 = $st->fetch();
			$idEmpre = $result1['id_empresa'];
			$st = $cn->prepare("SELECT * FROM numerosdm WHERE numero_dm = ?");
			$st->bindParam(1, $dmnumero);
			$st->execute();
			$result2 = $st->fetchAll();
			$idDM = $result2['id_dm'];
			$st = $cn->prepare("INSERT INTO mercancias(codigo_merc, nombre_merc, cant_cajas_merc, 
			precio_unitario_merc, valor_merc, precio_venta_merc, cant_caja_merc, ml_merc, porc_alch_merc,
			botellas, litros, bruto_ti_merc, pbc, porc_alic, alicuota, porc_elc, elc, flete, seguro, gastos, cif, porc_dai,
			dai, cant_inicial, id_tipo_merc, id_empresa, id_dm) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$st->bindParam(1, $codigomerc);
			$st->bindParam(2, $nombre);
			$st->bindParam(3, $numcajas);
			$st->bindParam(4, $preciou);
			$st->bindParam(5, $valor);
			$st->bindParam(6, $preciov);
			$st->bindParam(7, $cantxcaja);
			$st->bindParam(8, $ml);
			$st->bindParam(9, $porcalc);
			$st->bindParam(10, $botellas);
			$st->bindParam(11, $litros);
			$st->bindParam(12, $brutotl);
			$st->bindParam(13, $pbc);
			$st->bindParam(14, $porcali);
			$st->bindParam(15, $alicuota);
			$st->bindParam(16, $porcelc);
			$st->bindParam(17, $elc);
			$st->bindParam(18, $flete);
			$st->bindParam(19, $seguros);
			$st->bindParam(20, $gastos);
			$st->bindParam(21, $cif);
			$st->bindParam(22, $porcdai);
			$st->bindParam(23, $dai);
			$st->bindParam(24, $numcajas);
			$st->bindParam(25, $idTipo);
			$st->bindParam(26, $idEmpre);
			$st->bindParam(27, $idDM);
			if ($st->execute()) {
				echo 2;
			}else{
				echo 3;
			}
		}
	}else{
		$st = $cn->prepare("SELECT empresa FROM numerosdm WHERE empresa = ? AND numero_dm = ?");
		$st->bindParam(1, $empresa);
		$st->bindParam(2, $dmnumero);
		$st->execute();
		if ($st->fetch()) {
			$st = $cn->prepare("SELECT id_tipo_merc FROM tipo_mercancias WHERE nombre_tipo_mercancia = ?");
			$st->bindParam(1, $tipo);
			$st->execute();
			$result = $st->fetch();
			$idTipo = $result['id_tipo_merc'];
			$st = $cn->prepare("SELECT id_empresa FROM empresas WHERE nombre_empresa = ?");
			$st->bindParam(1, $empresa);
			$st->execute();
			$result1 = $st->fetch();
			$idEmpre = $result1['id_empresa'];
			$st = $cn->prepare("SELECT id_dm FROM numerosdm WHERE numero_dm = ?");
			$st->bindParam(1, $dmnumero);
			$st->execute();
			$result2 = $st->fetch();
			$idDM = $result2['id_dm'];
			$st = $cn->prepare("INSERT INTO mercancias(codigo_merc, nombre_merc, cant_cajas_merc, 
			precio_unitario_merc, valor_merc, precio_venta_merc, cant_caja_merc, ml_merc, porc_alch_merc,
			botellas, litros, bruto_ti_merc, pbc, porc_alic, alicuota, porc_elc, elc, flete, seguro, gastos, cif, porc_dai, dai, cant_inicial,
			id_tipo_merc, id_empresa, id_dm) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$st->bindParam(1, $codigomerc);
			$st->bindParam(2, $nombre);
			$st->bindParam(3, $numcajas);
			$st->bindParam(4, $preciou);
			$st->bindParam(5, $valor);
			$st->bindParam(6, $preciov);
			$st->bindParam(7, $cantxcaja);
			$st->bindParam(8, $ml);
			$st->bindParam(9, $porcalc);
			$st->bindParam(10, $botellas);
			$st->bindParam(11, $litros);
			$st->bindParam(12, $brutotl);
			$st->bindParam(13, $pbc);
			$st->bindParam(14, $porcali);
			$st->bindParam(15, $alicuota);
			$st->bindParam(16, $porcelc);
			$st->bindParam(17, $elc);
			$st->bindParam(18, $flete);
			$st->bindParam(19, $seguros);
			$st->bindParam(20, $gastos);
			$st->bindParam(21, $cif);
			$st->bindParam(22, $porcdai);
			$st->bindParam(23, $dai);
			$st->bindParam(24, $numcajas);
			$st->bindParam(25, $idTipo);
			$st->bindParam(26, $idEmpre);
			$st->bindParam(27, $idDM);
			if ($st->execute()) {
				echo 2;
			}else{
				echo 3;
			}
		}else{
			echo 1;
		}
	}
?>