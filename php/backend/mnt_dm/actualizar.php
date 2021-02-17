<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT numero_dm, fob, flete, seguros, gastos, cif FROM numerosdm WHERE id_dm = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
		<form method="post" onsubmit="ModificarDM(); return false;" name="frm">
			<input type="hidden" id="cif2" name="txtcif2" value="<?php echo $res['cif']; ?>"/>
			<input type="hidden" id="id" name="id2" value="<?php echo $_GET['id']; ?>" />
			<div>
				<label class="laabel">Número (*):</label>
				<input type="number" id="numero2" name="txtnumero2" required placeholder="Ingrese el número DM" autocomplete="off" value="<?php echo $res['numero_dm']; ?>"/>
			</div>
			<div class="espa">
				<label class="laabel">FOB (*):</label>
				<input type="number" step="any" id="fob2" name="txtfob2" required placeholder="Ingrese el FOB" autocomplete="off" value="<?php echo $res['fob']; ?>"/>
			</div>
			<div class="espa">
				<label class="laabel">Flete (*):</label>
				<input type="number" step="any" id="flete2" name="txtflete2" required placeholder="Ingrese el Flete" autocomplete="off" value="<?php echo $res['flete']; ?>"/>
			</div>
			<div class="espa">
				<label class="laabel">Seguros (*):</label>
				<input type="number" step="any" id="seguros2" name="txtseguros2" required placeholder="Valor del seguro" autocomplete="off" value="<?php echo $res['seguros']; ?>"/>
			</div>
			<div class="espa">
				<label class="laabel">Gastos (*):</label>
				<input type="number" step="any" id="gastos2" name="txtgastos2" required placeholder="Valor del gasto" autocomplete="off" value="<?php echo $res['gastos']; ?>"/>
			</div>
			<div class="espa">
				<button type="submit" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
			</div>
		</form>
	<?php
?>