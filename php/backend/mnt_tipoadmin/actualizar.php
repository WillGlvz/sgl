<?php
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombre_tipo_usuario, descripcion_tipo_usuario, identificador_tipo_usuario,
		permiso_tipou, permiso_admin, permiso_empre, permiso_merc, permiso_unim, permiso_tipom, permiso_comprob,
		permiso_front FROM tipos_usuarios WHERE id_tipo_usuario = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
	<div class="col-md-4">
		<form method="post" onsubmit="ModificarTipoAdmin(); return false;" name="frm">
			<input type="hidden" id="id3" name="id3" value="<?php echo  $_GET['id'];?>">
			<div>
				<label class="laabel">Nombre (*):</label>
				<input type="text" id="nombr3" name="txtnombre3" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off" value="<?php echo $res['nombre_tipo_usuario'] ?>"/>
			</div>
			<div class="espa">
				<label class="laabel">Descripción (*):</label>
				<textarea id="descr3" name="txtdescripcion3" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"><?php echo $res['descripcion_tipo_usuario']; ?></textarea>
			</div>
			<div class="espa">
				<label class="laabel">Cargo (*):</label>
				<?php
					if($_GET['id'] == 1){
						?>
						<select name="cmbcargo3" id="cargo3" required disabled>
							<option value="Jefe">Jefe</option>
						</select>
						<?php
					}else{
						?>
						<select name="cmbcargo3" id="cargo3" required>
							<option value=""></option>
							<option value="Jefe">Jefe</option>
							<option value="Empleado">Empleado</option>
							<option value="Otro">Otro</option>
						</select>
						<?php
					}
				?>
			</div>
			<div class="espa">
				<button type="submit" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
				<a href="http://localhost/SGL/admin/cpanel/userprofiles" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
			</div>
		</form>
	</div>
	<div class="col-md-4">
		<div class="">
			<label class="laabe">Permisos a otorgar:</label>
		</div>
		<div style="border: 2px solid black;">
			<div style="margin-left:10px;">
				<div class="espa">
					<?php
						if($res['permiso_tipou'] == TRUE) {
							echo "<input type='checkbox' id='tipou3'  name='chktipou3' onchange='cambiarV2();' checked='checked' value='Tipos usuarios'> Tipos usuarios";
						}else{
							echo "<input type='checkbox' id='tipou3'  name='chktipou3' onchange='cambiarV2();'> Tipos usuarios";
						}
						if($res['permiso_admin'] == TRUE){
							echo "<input type='checkbox' id='admin3' name='chkadmin3' style='margin-left:65px;' onchange='cambiarV2();' checked='checked' value='Administradores'> Administradores";
						}
						else{
							echo "<input type='checkbox' id='admin3' name='chkadmin3' style='margin-left:65px;' onchange='cambiarV2();'> Administradores";
						}
					?>
				</div>
				<div class="espa">
					<?php
						if($res['permiso_empre'] == TRUE) {
							echo "<input type='checkbox' id='empre3' name='chkempre3' onchange='cambiarV2();' checked='checked' value='Empresas'> Empresas";
						}else{
							echo "<input type='checkbox' id='empre3' name='chkempre3' onchange='cambiarV2();'> Empresas";
						}
						if($res['permiso_merc'] == TRUE){
							echo "<input type='checkbox' id='merc3' name='chkmerc3' style='margin-left:93px;' onchange='cambiarV2();' checked='checked' value='Mercancías'> Mercancías";
						}
						else{
							echo "<input type='checkbox' id='merc3' name='chkmerc3' style='margin-left:93px;' onchange='cambiarV2();'> Mercancías";
						}
					?>
				</div>
				<div class="espa">
					<?php
						if($res['permiso_unim'] == TRUE) {
							echo "<input type='checkbox' id='unim3' name='chkunim3' onchange='cambiarV2();' checked='checked' value='Unidades de medida'> Unidades de medida";
						}else{
							echo "<input type='checkbox' id='unim3' name='chkunim3' onchange='cambiarV2();'> Unidades de medida";
						}
						if($res['permiso_tipom'] == TRUE){
							echo "<input type='checkbox' id='tipom3' name='chktipom3' style='margin-left:26px;' onchange='cambiarV2();' checked='checked' value='Tipo mercancías'> Tipos mercancías";
						}
						else{
							echo "<input type='checkbox' id='tipom3' name='chktipom3' style='margin-left:26px;' onchange='cambiarV2();'> Tipos mercancías";
						}
					?>
				</div>
				<div class="espa">
					<?php
						if($res['permiso_comprob'] == TRUE) {
							echo "<input type='checkbox' id='comprob3' name='chkcomprob3' onchange='cambiarV2();' checked='checked' value='Comprobantes'> Comprobantes";
						}else{
							echo "<input type='checkbox' id='comprob3' name='chkcomprob3' onchange='cambiarV2();'> Comprobantes";
						}
						if($res['permiso_front'] == TRUE){
							echo "<input type='checkbox' id='front3' name='chkfront3' style='margin-left:64px;' onchange='cambiarV2();' checked='checked' value='Tipo mercancías'> Frontend";
						}
						else{
							echo "<input type='checkbox' id='front3' name='chkfront3' style='margin-left:64px;' onchange='cambiarV2();'> Frontend";
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
?>
