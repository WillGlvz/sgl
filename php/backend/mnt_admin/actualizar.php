<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombres_admin, apellidos_admin, usuario_admin, correo_admin, codigo_confirmacion, 
		nombre_tipo_usuario FROM administradores a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=t.id_tipo_usuario
		WHERE id_admin = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
		<form method="post" onsubmit="ModificarAdmin(); return false;" name="frm2">
			<input type="hidden" id="id" name="id2" value="<?php echo  $_GET['id'];?>">
		<div>
		<label class="laabel">Nombres (*):</label>
		<input type="text" id="nom" name="txtnombre2" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese sus nombre" autocomplete="off" value="<?php echo utf8_encode($res['nombres_admin']); ?>"/>
		</div>
		<div class="espa">
		<label class="laabel">Apellidos (*):</label>
		<input type="text" id="ape" name="txtapellidos2" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese sus apellidos" autocomplete="off" value="<?php echo utf8_encode($res['apellidos_admin']); ?>"/>
		</div>
		<div class="espa">
		<label class="laabel">Usuario (*):</label>
		<input type="text" id="ni" name="txtnit2" pattern=".{3,}" required placeholder="Ingrese su usuario" autocomplete="off" value="<?php echo utf8_encode($res['usuario_admin']); ?>"/>
		</div>
		<div class="espa">
		<label class="laabel">Correo (*):</label>
		<input type="email" id="cor" name="txtcorreo2" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese su correo" autocomplete="off" value="<?php echo utf8_encode($res['correo_admin']); ?>"/>
		</div>
		<div class="espa">
		<label class="laabel">Tipo (*):</label>
		<select name="cmbtipo2" id="tip" required>
		<option></option>
		<?php
		$st = $cn->prepare("SELECT * FROM tipos_usuarios");
		$st->execute();
		$rs = $st->fetchAll();
		foreach ($rs as $key => $value) {
		?>
		<option value="<?php echo $value['nombre_tipo_usuario']; ?>"><?php echo utf8_encode($value['nombre_tipo_usuario']); ?></option>
		<?php
		}
		?>
		</select>
		</div>
		<div class="espa">
		<label class="laabel">Estado (*):</label>
		<?php 
			if($_GET['id'] == 1){
				?>
				<select name="cmbestado2" id="est" required disabled>
					<option value="Habilitado">Habilitado</option>
				</select>
				<?php
			}else{
				?>
				<select name="cmbestado2" id="est" required>
				<option></option>
				<option value="Habilitado">Habilitado</option>
				<option value="Deshabilitado">Deshabilitado</option>
				</select>
				<?php
			}
		?>
		</div>
		<div class="espa">
		<button type="submit" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
		<br>
		<a href="http://localhost/SGL/admin/cpanel/users" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
		</div>
		</form>
	<?php
?>