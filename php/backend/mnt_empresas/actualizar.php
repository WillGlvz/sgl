<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombre_empresa, descripcion_empresa, direccion_empresa, telefono_empresa, 
		correo_empresa, nit_empresa, nrc_empresa, contacto_empresa, telf_contacto_empresa, 
		correo_contacto_empresa, nombre_tipo_usuario, nombre_departamento, nombre_municipio FROM empresas e 
		INNER JOIN municipios m INNER JOIN departamentos d INNER JOIN tipos_usuarios t ON e.id_tipo_usuario=
		t.id_tipo_usuario AND e.id_municipio=m.id_municipio AND m.id_departamento=d.id_departamento WHERE 
		id_empresa = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
	<form method="post" onsubmit="ModificarEmpre(); return false;" name="frm2">
		<input type="hidden" id="id3" name="id3" value="<?php echo  $_GET['id'];?>">
	<div class="col-md-4">
		<div>
			<label class="laabel">Nombre (*):</label>
			<input type="text" id="nombr2" name="txtnombre2" value="<?php echo $res['nombre_empresa']; ?>" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off" disabled/>
		</div>
		<div class="espa">
			<label class="laabel">Descripción (*):</label>
			<textarea id="descr2" name="txtdescripcion2" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"><?php echo $res['descripcion_empresa']; ?></textarea>
		</div>
		<div class="espa">
			<label class="laabel">Dirección (*):</label>
			<input type="text" id="dir2" name="txtdireccion2" value="<?php echo $res['direccion_empresa']; ?>" pattern=".{3,}" required placeholder="Ingrese la dirección" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Teléfono (*):</label>
			<input type="text" id="tel2" name="txttel2" value="<?php echo $res['telefono_empresa']; ?>" title="Ingrese un número de teléfono válido" pattern="^[2^6-7]{1}[0-9]{3}-[0-9]{4}$" required placeholder="Ingrese el teléfono" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Correo (*):</label>
			<input type="email" id="correo2" name="txtcorreo2" value="<?php echo $res['correo_empresa']; ?>" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese el correo" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">NIT (*):</label>
			<input type="number" id="nit2" name="txtnit2" value="<?php echo $res['nit_empresa']; ?>" pattern=".{3,}" required placeholder="NIT (Sin guíones)" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">NRC (*):</label>
			<input type="number" id="nrc2" name="txtnrc2" value="<?php echo $res['nrc_empresa']; ?>" pattern=".{3,}" required placeholder="NRC (Sin guíones)" autocomplete="off"/>
		</div>
	</div>
	<div class="col-md-4">
		<div>
			<label class="laabel">Contacto (*):</label>
			<input type="text" id="cont2" name="txtcont2" value="<?php echo $res['contacto_empresa']; ?>" pattern=".{3,}" required placeholder="Nombre del contacto" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Tel. contacto (*):</label>
			<input type="text" id="conttel2" name="txtcontel2" value="<?php echo $res['telf_contacto_empresa']; ?>" title="Ingrese un número de teléfono válido" pattern="^[2^6-7]{1}[0-9]{3}-[0-9]{4}$" required placeholder="Teléfono del contacto" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Cor. contacto (*):</label>
			<input type="email" id="cortel2" name="txtconcor2" value="<?php echo $res['correo_contacto_empresa']; ?>" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Correo del contacto" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Departamento (*):</label>
			<select name="departamentos2" id="depa2" onchange="from(document.frm2.departamentos2.value, 'municipios2', 'http://localhost/SGL/php/backend/mnt_empresas/municipios2.php')" required>
				<option></option>
				<?php 
	    			$st = $cn->prepare("SELECT * FROM departamentos");
	    			$st->execute();
	    			$rs = $st->fetchAll();
	    			foreach ($rs as $key => $value) {
	    			 	?>
	    			 	<option value="<?php echo $value['id_departamento']; ?>"><?php echo utf8_encode($value['nombre_departamento']); ?></option>
	    			 	<?php
	    			}
	    		?>
			</select>
		</div>
		<div class="espa" id="municipios2">
			<label class="laabel">Municipio (*)</label>
    		<select required>
    			<option>Escoja un departamento</option>
			</select>
		</div>
		<div class="espa">
			<button type="submit" class="btn btn-success btn-block"><span class="icon-pencil4" style="margin-right:10px;"></span>Modificar</button>
			<br>
			<a href="http://localhost/SGL/admin/cpanel/enterprise" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
		</div>
	</div>
	</form>
	<?php
?>