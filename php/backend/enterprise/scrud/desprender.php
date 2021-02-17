<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dm = $_POST['txtdm'];
	$nombre = utf8_decode(htmlentities($_POST['txtnombre']));
	$cajas_actuales = $_POST['txtcajasact'];
	$cajas_nuevas = $_POST['txtcantnueva'];
	$cajas_retirar = $_POST['txtretirar'];
	$preciou = $_POST['txtpreciou'];
	$preciov = $_POST['txtpreciov'];
	$porc_alch = $_POST['txtporc'];
	$id_merc = $_POST['id3'];
	$empresa = utf8_decode(htmlentities($_POST['txtempresa']));
	$IdEmpresa = null;
	$IdDm = null;
	$st = $cn->prepare("SELECT * FROM mercancias WHERE id_merc = ?");
	$st->bindParam(1, $id_merc);
	$st->execute();
	$res = $st->fetch();
	$st = $cn->prepare("SELECT fob, flete, seguros, gastos FROM numerosdm WHERE numero_dm = ?");
	$st->bindParam(1, $dm);
	$st->execute();
	$res2 = $st->fetch();
	$st = $cn->prepare("SELECT id_empresa FROM empresas WHERE  nombre_empresa = ?");
	$st->bindParam(1, $empresa);
	$st->execute();
	$res3 = $st->fetch();
	$IdEmpresa = $res3['id_empresa'];
	$st = $cn->prepare("SELECT id_dm FROM numerosdm WHERE numero_dm = ?");
	$st->bindParam(1, $dm);
	$st->execute();
	$res4 = $st->fetch();
	$IdDm = $res4['id_dm'];
	$Valor = $cajas_retirar * $preciou;
	$Botellas = $cajas_retirar * $res['cant_caja_merc'];
	$Litros = ($Botellas * $res['ml_merc']) / 1000;
	$Pbc = ($res['bruto_ti_merc'] / $res['cant_inicial']) * $cajas_retirar;
	$Alicuota = $Litros * $res['porc_alch_merc'] * $res['porc_alic'];
	$Elc = ($preciov * $Botellas * $res['porc_elc']) / 100;
	$Flete = ($res2['flete'] / $res2['fob']) * $Valor;
	$Seguro = ($res2['seguros'] / $res2['fob']) * $Valor;
	$Gasto = ($res2['gastos'] / $res2['fob']) * $Valor;
	$Cif = $Valor + $Flete + $Gasto + $Seguro;
	$Dai = ($Cif * $res['porc_dai']) / 100;
	try {
		date_default_timezone_set("America/El_Salvador");
		$fecha = date("Y-m-d");
		$st = $cn->prepare("INSERT INTO comprobantes(codigo_compr, nombre_merc_c, cantidad_cajas, 
				precio_unitario, valor, precio_venta, cantx_caja, mililitros, porcentaje_alch,
				botellas_m, litros_m, bruto_total, pbc_m, porcentaje_ali, alicuota_m, porcentaje_elc, elc_m, flete_m, seguros_m, gastos_m, cif_m, porcentaje_dai,
				dai_m, fecha_retiro, id_empresa, id_dm) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$st->bindParam(1, $res['codigo_merc']);
		$st->bindParam(2, $nombre);
		$st->bindParam(3, $cajas_retirar);
		$st->bindParam(4, $preciou);
		$st->bindParam(5, $Valor);
		$st->bindParam(6, $preciov);
		$st->bindParam(7, $res['cant_caja_merc']);
		$st->bindParam(8, $res['ml_merc']);
		$st->bindParam(9, $porc_alch);
		$st->bindParam(10, $Botellas);
		$st->bindParam(11, $Litros);
		$st->bindParam(12, $res['bruto_ti_merc']);
		$st->bindParam(13, $Pbc);
		$st->bindParam(14, $res['porc_alic']);
		$st->bindParam(15, $Alicuota);
		$st->bindParam(16, $res['porc_elc']);
		$st->bindParam(17, $Elc);
		$st->bindParam(18, $Flete);
		$st->bindParam(19, $Seguro);
		$st->bindParam(20, $Gasto);
		$st->bindParam(21, $Cif);
		$st->bindParam(22, $res['porc_dai']);
		$st->bindParam(23, $Dai);
		$st->bindParam(24, $fecha);
		$st->bindParam(25, $IdEmpresa);
		$st->bindParam(26, $IdDm);
		if($st->execute()){
			$CajasNuevas = $cajas_actuales - $cajas_retirar;
			$NuevoValor = $CajasNuevas * $preciou;
			$NuevasBotellas = $CajasNuevas * $res['cant_caja_merc'];
			$NuevosLitros = ($NuevasBotellas * $res['ml_merc']) / 1000;
			$NuevoPbc = ($res['bruto_ti_merc'] / $res['cant_inicial']) * $cajas_retirar;
			$NuevaAlicuota = $NuevosLitros * $porc_alch * $res['porc_alic'];
			$NuevoElc = ($preciov * $NuevasBotellas * $res['porc_elc']) / 100;
			$NuevoFlete = ($res2['flete'] / $res2['fob']) * $NuevoValor;
			$NuevoSeguro = ($res2['seguros'] / $res2['fob']) * $NuevoValor;
			$NuevoGasto = ($res2['gastos'] / $res2['fob']) * $NuevoValor;
			$NuevoCif = $NuevoValor + $NuevoFlete + $NuevoGasto + $NuevoSeguro;
			$NuevoDai = ($NuevoCif * $res['porc_dai']) / 100;			
			$st = $cn->prepare("UPDATE mercancias SET codigo_merc = ?, nombre_merc = ?, cant_cajas_merc = ?, 
			precio_unitario_merc = ?, valor_merc = ?, precio_venta_merc = ?, cant_caja_merc = ?, ml_merc = ?, porc_alch_merc = ?,
			botellas = ?, litros = ?, bruto_ti_merc = ?, pbc = ?, porc_alic = ?, alicuota = ?, porc_elc = ?, elc = ?, flete = ?, seguro = ?, gastos = ?, cif = ?, porc_dai = ?,
			dai = ?, id_empresa = ?, id_dm = ? WHERE id_merc = ?");
			$st->bindParam(1, $res['codigo_merc']);
			$st->bindParam(2, $nombre);
			$st->bindParam(3, $CajasNuevas);
			$st->bindParam(4, $preciou);
			$st->bindParam(5, $NuevoValor);
			$st->bindParam(6, $preciov);
			$st->bindParam(7, $res['cant_caja_merc']);
			$st->bindParam(8, $res['ml_merc']);
			$st->bindParam(9, $porc_alch);
			$st->bindParam(10, $NuevasBotellas);
			$st->bindParam(11, $NuevosLitros);
			$st->bindParam(12, $res['bruto_ti_merc']);
			$st->bindParam(13, $NuevoPbc);
			$st->bindParam(14, $res['porc_alic']);
			$st->bindParam(15, $NuevaAlicuota);
			$st->bindParam(16, $res['porc_elc']);
			$st->bindParam(17, $NuevoElc);
			$st->bindParam(18, $NuevoFlete);
			$st->bindParam(19, $NuevoSeguro);
			$st->bindParam(20, $NuevoGasto);
			$st->bindParam(21, $NuevoCif);
			$st->bindParam(22, $res['porc_dai']);
			$st->bindParam(23, $NuevoDai);
			$st->bindParam(24, $IdEmpresa);
			$st->bindParam(25, $IdDm);
			$st->bindParam(26, $id_merc);
			if ($st->execute()) {
				$st = $cn->prepare("SELECT cant_cajas_merc FROM mercancias m INNER JOIN numerosdm n ON m.id_dm=n.id_dm WHERE numero_dm = ?");
				$st->bindParam(1, $dm);
				$st->execute();
				$cantidad = $st->fetch();
				if ($cantidad['cant_cajas_merc'] <= 0) {
					$st = $cn->prepare("DELETE FROM mercancias WHERE id_merc = ?");
					$st->bindParam(1, $id_merc);
					if ($st->execute()) {
						echo 2;
					}
				}else{
					echo 2;
				}
			}else{
				echo 3;
			}
		}
	} catch (Exception $e) {echo 1; echo $e;}
?>