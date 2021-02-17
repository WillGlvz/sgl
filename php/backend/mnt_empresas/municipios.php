<?php 
	include '../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT id_municipio, nombre_municipio FROM municipios WHERE id_departamento = ".$_GET['id']);
	if (empty($_GET['id'])) {}
		else{
	$st->execute();
	$res = $st->fetchAll();
	?>
	<label class="laabel">Municipio (*)</label>
	<select name="cmbmunicipios" id="muni" required>
		<option></option>
	<?php foreach ($res as $key => $value) { if (empty($value)){?><option></option><?php }else{?>
	<option value="<?php echo $value['id_municipio']; ?>"><?php echo utf8_encode($value['nombre_municipio']); ?></option>
	<?php 
	}
	}
	}
	?>
	</select>