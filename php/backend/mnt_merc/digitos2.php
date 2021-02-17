<?php 
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT fob, flete, seguros, gastos FROM numerosdm WHERE numero_dm = ".$_GET['id']);
	if (empty($_GET['id'])) {}
		else{
	$st->execute();
	$res = $st->fetch();
	?>
	<input type="hidden" name="txtfob2" id="fob2" value="<?php echo $res['fob']; ?>" />
	<input type="hidden" name="txtflete2" id="flete2" value="<?php echo $res['flete']; ?>" />
	<input type="hidden" name="txtseguros2" id="seguros2" value="<?php echo $res['seguros']; ?>" />
	<input type="hidden" name="txtgastos2" id="gastos2" value="<?php echo $res['gastos']; ?>" />
	<?php
	}
?>