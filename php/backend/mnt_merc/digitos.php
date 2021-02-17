<?php 
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT fob, flete, seguros, gastos FROM numerosdm WHERE numero_dm = ".$_GET['id']);
	if (empty($_GET['id'])) {}
		else{
	$st->execute();
	$res = $st->fetch();
	?>
	<input type="hidden" name="txtfob" id="fob" value="<?php echo $res['fob']; ?>" />
	<input type="hidden" name="txtflete" id="flete" value="<?php echo $res['flete']; ?>" />
	<input type="hidden" name="txtseguros" id="seguros" value="<?php echo $res['seguros']; ?>" />
	<input type="hidden" name="txtgastos" id="gastos" value="<?php echo $res['gastos']; ?>" />
	<?php
	}
?>