<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombre_tipo_mercancia, descripcion_tipo_mercancia FROM tipo_mercancias WHERE id_tipo_merc = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
		<form method="post" onsubmit="ModificarTipom(); return false;" name="frm2">
			<input type="hidden" id="id" name="id2" value="<?php echo  $_GET['id'];?>">
		<div>
		<label class="laabel">Nombre (*):</label>
		<input type="text" id="nom" name="txtnombre2" class="iinput" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese sus nombre" autocomplete="off" value="<?php echo utf8_encode($res['nombre_tipo_mercancia']); ?>"/>
		</div>
		<div class="espa">
		<label class="laabel">Descripcion (*):</label>
		<textarea class="iinput" id="descr2" name="txtdescripcion2" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"><?php echo utf8_encode($res['descripcion_tipo_mercancia']); ?></textarea>
		</div>
		<div class="espa">
		<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Modificar</button>
		<br>
		<a href="http://localhost/SGL/admin/cpanel/freight-kinds" class="btn btn-info btn-block"><span class="icon-save" style="margin-right:10px;"></span>Regresar</a>
		</div>
		</form>
	<?php
?>