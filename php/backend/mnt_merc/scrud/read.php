<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT numero_dm, codigo_merc, nombre_merc, cant_cajas_merc, precio_unitario_merc,
		precio_venta_merc, botellas, litros, cant_caja_merc, valor_merc, ml_merc, pbc, porc_alic, alicuota, porc_elc, elc,
		porc_alch_merc, bruto_ti_merc, nombre_tipo_mercancia, nombre_empresa, porc_dai, dai
		FROM mercancias m INNER JOIN tipo_mercancias t INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_tipo_merc=t.id_tipo_merc 
		AND m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm WHERE id_merc = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	$num = $res['numero_dm'];
    $st = $cn->prepare("SELECT flete, seguro, gastos, cif FROM mercancias WHERE id_merc = ?");
    $st->bindParam(1, $_GET['id']);
    $st->execute();
    $res3 = $st->fetch();
    ?>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Código: </strong><?php echo $res['codigo_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Nombre: </strong><?php echo utf8_encode($res['nombre_merc']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Cajas: </strong><?php echo $res['cant_cajas_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Precio unitario: </strong>$<?php echo $res['precio_unitario_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Valor: </strong>$<?php echo $res['valor_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Precio venta: </strong>$<?php echo $res['precio_venta_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Cantidad por caja: </strong><?php echo $res['cant_caja_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Mililítros: </strong><?php echo $res['ml_merc']; ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Porcentaje alcohol: </strong><?php echo $res['porc_alch_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Botellas totales: </strong><?php echo $res['botellas']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Litros: </strong><?php echo $res['litros']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Bruto total: </strong>$<?php echo $res['bruto_ti_merc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>PBC: </strong>$<?php echo $res['pbc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Porcentaje alicuota: </strong><?php echo $res['porc_alic']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Alicuota: </strong>$<?php echo $res['alicuota']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Porcentaje ELC: </strong><?php echo $res['porc_elc']; ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>ELC: </strong>$<?php echo $res['elc']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Flete: </strong>$<?php echo $res3['flete']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Seguros: </strong>$<?php echo $res3['seguro']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Gastos: </strong>$<?php echo $res3['gastos']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>CIF: </strong>$<?php echo $res3['cif']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Porcentaje DAI: </strong><?php echo $res['porc_dai']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>DAI: </strong>$<?php echo $res['dai']; ?></li>
            <div class="espa">
                <a href="http://localhost/SGL/admin/cpanel/freight/<?php echo $num; ?>" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
            </div>
        </ul>
    </div>
	<?php
?>