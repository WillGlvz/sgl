<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT permiso_merc FROM administradores a INNER JOIN tipos_usuarios t ON 
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_merc'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin-login-system-sgl';</script>";
	}
	$st = $cn->prepare("SELECT estado_sesion FROM administradores WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res6 = $st->fetch();
	if ($res6['estado_sesion'] == 0) {
		echo "<script>window.alert('Se ha cerrado la sesión');</script>";
		echo "<script>window.location='http://localhost/SGL/admin/log-out';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:80px; background-color: #F0E7C0;">
	<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="col-md-12">
		<br><br><br>
		<div class="panel panel-success">
		  <div class="panel-heading">
		  	<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Nueva mercancía</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    <h2 class="text-center letra5">Ingrese los datos</h2>	
	    		<form method="post" onsubmit="AgregarMerc(); return false;" name="frm">
	    		<input type="hidden" id="valor" name="txtvalor" />
	    		<input type="hidden" id="botellas" name="txtbotellas" />
	    		<input type="hidden" id="litros" name="txtlitros" />
	    		<input type="hidden" id="alicuota" name="txtalicuota" />
	    		<input type="hidden" id="elc" name="txtelc" />
				<input type="hidden" id="pbc" name="txtpbc" />
				<input type="hidden" id="cif" name="txtcif" />	
				<input type="hidden" id="dai" name="txtdai" />
				<input type="hidden" id="flete1" name="txtflete1" />
				<input type="hidden" id="gastos1" name="txtgastos1" />
				<input type="hidden" id="seguros1" name="txtseguros1" />
					<div class="col-md-4">
						<div>
							<label class="laabel">Código merc. (*):</label>
							<input type="number" id="cod" name="txtcodigo" pattern=".{3,}" required placeholder="Código mercancía" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Nombre (*):</label>
							<input type="text" id="nombre" name="txtnombre" pattern=".{3,}" required placeholder="Nombre mercancía" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Núm. cajas (*):</label>
							<input type="number" id="cajas" name="txtcajas" pattern=".{3,}" required placeholder="Cajas a ingresar" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Precio unit. (*):</label>
							<input type="number" id="preciou" name="txtpreciou" step="any" pattern=".{3,}" required placeholder="Precio unitario" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Precio venta (*):</label>
							<input type="number" id="preciov" name="txtpreciov" step="any" pattern=".{3,}" required placeholder="Precio de venta" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Cant. por caja (*):</label>
							<input type="number" id="cantcaja" name="txtcantcaja" pattern=".{3,}" required placeholder="Cantidad por caja" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Mililítros (*):</label>
							<input type="number" id="ml" name="txtml" pattern=".{3,}" required placeholder="Mililítros del vino" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">% Alcohol (*):</label>
							<input type="number" id="porc" name="txtporc" step="any" pattern=".{3,}" required placeholder="Porcentaje alcohol" autocomplete="off"/>
						</div>
						<div class="espa">
							<label class="laabel">Bruto TL (*):</label>
							<input type="number" id="bru" name="txtbru" step="any" pattern=".{3,}" required placeholder="Bruto TL" autocomplete="off"/>
						</div>
				</div>
				<div class="col-md-4">
					<div>
						<label class="laabel">% ALC (*):</label>
						<input type="number" id="porcalc" name="txtporcalc" step="any" required placeholder="Porcentaje alcohol" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">% ELC (*):</label>
						<input type="number" id="porcelc" name="txtporcelc" step="any" required placeholder="Bruto TL" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">% DAI (*):</label>
						<input type="number" id="porcdai" name="txtporcdai" step="any" required placeholder="Bruto TL" autocomplete="off"/>
					</div>
					<div class="espa">
						<label class="laabel">Tipo (*):</label>
						<select name="cmbtipo" id="tipo" required>
    						<option></option>
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
						<select name="cmbempre" id="empre" required>
    						<option></option>
    						<?php
    							$st = $cn->prepare("SELECT * FROM empresas");
    							$st->execute();
    							$rs = $st->fetchAll();
    							foreach ($rs as $key => $value) {
    			 				?>
    			 					<option value="<?php echo $value['nombre_empresa']; ?>"><?php echo utf8_encode($value['nombre_empresa']); ?></option>
    			 				<?php
    							}
    						?>
						</select>
					</div>
					<div class="espa">
						<label class="laabel">Número DM (*):</label>
						<select name="cmbdm" id="dm" onchange="from(document.frm.cmbdm.value, 'digitos', 'http://localhost/SGL/php/backend/mnt_merc/digitos.php')" required>
    						<option></option>
    						<?php
    							$st = $cn->prepare("SELECT * FROM numerosdm");
    							$st->execute();
    							$rs = $st->fetchAll();
    							foreach ($rs as $key => $value) {
    			 				?>
    			 					<option value="<?php echo $value['numero_dm']; ?>"><?php echo utf8_encode($value['numero_dm']); ?></option>
    			 				<?php
    							}
    						?>
						</select>
					</div>
					<div id="digitos">
						
					</div>
					<div class="espa">
						<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Agregar</button>
						<a href="http://localhost/SGL/admin/cpanel/freight" class="btn btn-warning btn-block"><span class="icon-mail-reply" style="margin-right:10px;"></span>Regresar</a>
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