<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['name'])) {
		header('Location: http://localhost/SGL/desprendimientos');
	}
	$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, porc_alch_merc, nombre_empresa FROM mercancias m INNER JOIN numerosdm n INNER JOIN empresas e ON m.id_dm=n.id_dm AND m.id_empresa=e.id_empresa WHERE id_merc = ?");
	$st->bindParam(1, $_GET['dm']);
	$st->execute();
	$res = $st->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="background-color: #F0E7C0;">
	<?php include '../maestros/header_enterprise.php';?>
	<div class="container">
		<div class="panel panel-success" style="margin-top:120px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Desprendimientos</p>
		  </div>
		  <div class="panel-body">
		    <h2 class="text-center letra4x">Ingrese la cantidad de cajas que desea retirar</h2>
		    <br>
		    <div class="row">
		    	<form method="post" onsubmit="RetirarMerc(); return false;" name="frm2">
					<input type="hidden" id="id3" name="id3" value="<?php echo  $res['id_merc'];?>">
					<input type="hidden" id="empresa" name="txtempresa" value="<?php echo  $res['nombre_empresa'];?>">
					<input type="hidden" id="dm2" name="txtdm2" value="<?php echo  $res['numero_dm'];?>">
					<input type="hidden" id="nueva" name="txtcantnueva">
				<div class="col-md-4 col-md-offset-4">
					<div>
						<label class="laabel">Número DM:</label>
						<input type="text" id="dm" name="txtdm" disabled value="<?php echo $res['numero_dm']; ?>" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">Nombre:</label>
						<input type="text" id="nombre" name="txtnombre" disabled value="<?php echo utf8_encode($res['nombre_merc']); ?>" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">Cajas actuales:</label>
						<input type="text" id="cajasact" name="txtcajasact" disabled value="<?php echo $res['cant_cajas_merc']; ?>" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">Cajas a retirar:</label>
						<input type="number" id="retirar" name="txtretirar" required autocomplete="off" placeholder="Cantidad de cajas a retirar"/>
					</div>
					<div class="espa">
						<label class="laabel">Precio Unit:</label>
						<input type="text" id="preciou" name="txtpreciou" disabled value="<?php echo $res['precio_unitario_merc']; ?>" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">Precio Venta:</label>
						<input type="text" id="preciov" name="txtpreciov" disabled value="<?php echo $res['precio_venta_merc']; ?>"autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">% Alcohol:</label>
						<input type="text" id="porc" name="txtporc" disabled value="<?php echo $res['porc_alch_merc']; ?>" autocomplete="off"/>
					</div>
					<br>
					<div class="espa">
						<button type="submit" class="btn btn-danger btn-block"><span class="icon-save" style="margin-right:10px;"></span>Retirar</button>
					</div>
				</div>
				</form>
		    </div>
		  </div>
		</div>
	</div> 
	<?php include '../maestros/scrbody.php';?>
</body>
</html>  
