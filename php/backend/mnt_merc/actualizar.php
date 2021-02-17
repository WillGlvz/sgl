<?php
	include '../maestros/conexion.php';
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
    $res2 = $st->fetch();
	?>
    <form method="post" onsubmit="ModificarMerc(); return false;" name="frm2">
				<input type="hidden" id="id3" name="id3" value="<?php echo $_GET['id'];?>">
        <input type="hidden" id="valor2" name="txtvalor2" />
        <input type="hidden" id="botellas2" name="txtbotellas2" />
        <input type="hidden" id="litros2" name="txtlitros2" />
        <input type="hidden" id="alicuota2" name="txtalicuota2" />
        <input type="hidden" id="elc2" name="txtelc2" />
        <input type="hidden" id="pbc2" name="txtpbc2" />
        <input type="hidden" id="cif2" name="txtcif2" />
        <input type="hidden" id="dai2" name="txtdai2" />
        <input type="hidden" id="flete12" name="txtflete12" />
        <input type="hidden" id="gastos12" name="txtgastos12" />
        <input type="hidden" id="seguros12" name="txtseguros12" />
        <div class="col-md-4">
            <div>
                <label class="laabel">Código merc. (*):</label>
                <input type="number" id="cod2" name="txtcodigo2" pattern=".{3,}" required placeholder="Código mercancía" autocomplete="off" value="<?php echo $res['codigo_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Nombre (*):</label>
                <input type="text" id="nombre2" name="txtnombre2" pattern=".{3,}" required placeholder="Nombre mercancía" autocomplete="off" value="<?php echo $res['nombre_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Núm. cajas (*):</label>
                <input type="number" id="cajas2" name="txtcajas2" pattern=".{3,}" required placeholder="Cajas a ingresar" autocomplete="off" value="<?php echo $res['cant_cajas_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Precio unit. (*):</label>
                <input type="number" id="preciou2" name="txtpreciou2" step="any" pattern=".{3,}" required placeholder="Precio unitario" autocomplete="off" value="<?php echo $res['precio_unitario_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Precio venta (*):</label>
                <input type="number" id="preciov2" name="txtpreciov2" step="any" pattern=".{3,}" required placeholder="Precio de venta" autocomplete="off" value="<?php echo $res['precio_venta_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Cant. por caja (*):</label>
                <input type="number" id="cantcaja2" name="txtcantcaja2" pattern=".{3,}" required placeholder="Cantidad por caja" autocomplete="off" value="<?php echo $res['cant_caja_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Mililítros (*):</label>
                <input type="number" id="ml2" name="txtml2" pattern=".{3,}" required placeholder="Mililítros del vino" autocomplete="off" value="<?php echo $res['ml_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">% Alcohol (*):</label>
                <input type="number" id="porc2" name="txtporc2" step="any" pattern=".{3,}" required placeholder="Porcentaje alcohol" autocomplete="off" value="<?php echo $res['porc_alch_merc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Bruto TL (*):</label>
                <input type="number" id="bru2" name="txtbru2" step="any" pattern=".{3,}" required placeholder="Bruto TL" autocomplete="off" value="<?php echo $res['bruto_ti_merc']; ?>"/>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <label class="laabel">% ALC (*):</label>
                <input type="number" id="porcalc2" name="txtporcalc2" step="any" required placeholder="Porcentaje alcohol" autocomplete="off" value="<?php echo $res['porc_alic']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">% ELC (*):</label>
                <input type="number" id="porcelc2" name="txtporcelc2" step="any" required placeholder="Bruto TL" autocomplete="off" value="<?php echo $res['porc_elc']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">% DAI (*):</label>
                <input type="number" id="porcdai2" name="txtporcdai2" step="any" required placeholder="Bruto TL" autocomplete="off" value="<?php echo $res['porc_dai']; ?>"/>
            </div>
            <div class="espa">
                <label class="laabel">Tipo (*):</label>
                <select name="cmbtipo2" id="tipo2" required>
                    <option value="<?php echo $res['nombre_tipo_mercancia']; ?>"><?php echo $res['nombre_tipo_mercancia']; ?></option>
                    <?php
                    $st = $cn->prepare("SELECT * FROM tipo_mercancias");
                    $st->execute();
                    $rs = $st->fetchAll();
                    foreach ($rs as $key => $value) {
                        ?>
                        <option value="<?php echo $value['nombre_tipo_mercancia']; ?>"><?php echo utf8_encode($value['nombre_tipo_mercancia']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="espa">
                <label class="laabel">Empresa (*):</label>
                <select name="cmbempre2" id="empre2" required disabled>
                    <option value="<?php echo $res['nombre_empresa']; ?>"><?php echo $res['nombre_empresa']; ?></option>
                </select>
            </div>
            <div class="espa">
                <label class="laabel">Número DM (*):</label>
                <select name="cmbdm2" id="dm2" required disabled>
                    <option value="<?php echo $res['numero_dm']; ?>"><?php echo $res['numero_dm']; ?></option>
                </select>
            </div>
            <div id="digitos2">
							<?php
								$st = $cn->prepare("SELECT fob, flete, seguros, gastos FROM numerosdm WHERE numero_dm = ?");
								$st->bindParam(1, $res['numero_dm']);
						    $st->execute();
						    $result = $st->fetch();
							?>
							<input type="hidden" name="txtfob2" id="fob2" value="<?php echo $result['fob']; ?>" />
							<input type="hidden" name="txtflete2" id="flete2" value="<?php echo $result['flete']; ?>" />
							<input type="hidden" name="txtseguros2" id="seguros2" value="<?php echo $result['seguros']; ?>" />
							<input type="hidden" name="txtgastos2" id="gastos2" value="<?php echo $result['gastos']; ?>" />
            </div>
            <div class="espa">
                <button type="submit" class="btn btn-primary btn-block"><span class="icon-pencil" style="margin-right:10px;"></span>Modificar</button>
                <a href="http://localhost/SGL/admin/cpanel/freight/<?php echo $num; ?>" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
            </div>
        </div>
    </form>
