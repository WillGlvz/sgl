<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['name'])) {
		header('Location: ../login/desprendimiento.php');
	}
	$st = $cn->prepare("SELECT nombre_empresa, descripcion_empresa, direccion_empresa, telefono_empresa, 
		correo_empresa, nit_empresa, nrc_empresa, contacto_empresa, telf_contacto_empresa, 
		correo_contacto_empresa, nombre_tipo_usuario, nombre_departamento, nombre_municipio FROM empresas e 
		INNER JOIN municipios m INNER JOIN departamentos d INNER JOIN tipos_usuarios t ON e.id_tipo_usuario=
		t.id_tipo_usuario AND e.id_municipio=m.id_municipio AND m.id_departamento=d.id_departamento WHERE 
		id_empresa = ?");
	$st->bindParam(1, $_SESSION['code']);
	$st->execute();
	$res = $st->fetch();
	$st = $cn->prepare("SELECT id_departamento FROM departamentos WHERE nombre_departamento = ?");
	$st->bindParam(1, $res['nombre_departamento']);
	$st->execute();
	$res2 = $st->fetch();
	$st = $cn->prepare("SELECT id_municipio FROM municipios WHERE id_departamento = ?");
	$st->bindParam(1, $res2['id_departamento']);
	$st->execute();
	$res3 = $st->fetch();
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
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Edite su información</p>
		  </div>
		  <div class="panel-body">
		    <h2 class="text-center letra4x">Por motivos de seguridad solo podrá modificar ciertos campos</h2>
		    <br>
		    <div class="row">
		    	<form method="post" onsubmit="ModificarEmpre(); return false;" name="frm2">
		<input type="hidden" id="id3" name="id3" value="<?php echo  $_GET['id'];?>">
	<div class="col-md-4 col-md-offset-1">
		<div>
			<label class="laabel">Nombre (*):</label>
			<input type="text" id="nombr2" name="txtnombre2" disabled value="<?php echo $res['nombre_empresa']; ?>" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">Descripción (*):</label>
			<textarea id="descr2" name="txtdescripcion2" pattern=".{7,}" disabled placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"><?php echo $res['descripcion_empresa']; ?></textarea>
		</div>
		<div class="espa">
			<label class="laabel">Dirección (*):</label>
			<input type="text" id="dir2" name="txtdireccion2" disabled value="<?php echo $res['direccion_empresa']; ?>" pattern=".{3,}" required placeholder="Ingrese la dirección" autocomplete="off"/>
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
			<input type="number" id="nit2" name="txtnit2" disabled value="<?php echo $res['nit_empresa']; ?>" pattern=".{3,}" required placeholder="NIT (Sin guíones)" autocomplete="off"/>
		</div>
		<div class="espa">
			<label class="laabel">NRC (*):</label>
			<input type="number" id="nrc2" name="txtnrc2" disabled value="<?php echo $res['nrc_empresa']; ?>" pattern=".{3,}" required placeholder="NRC (Sin guíones)" autocomplete="off"/>
		</div>
	</div>
	<div class="col-md-4 col-md-offset-1">
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
			<select name="departamentos2" id="depa2" disabled>
				<option value="<?php echo utf8_encode($res['nombre_departamento']); ?>"><?php echo utf8_encode($res['nombre_departamento']); ?></option>
			</select>
		</div>
		<div class="espa" id="municipios2">
			<label class="laabel">Municipio (*)</label>
    		<select disabled name="cmbmunicipios2" id="muni2">
    			<option value="<?php echo utf8_encode($res3['id_municipio']); ?>"><?php echo utf8_encode($res['nombre_municipio']); ?></option>
			</select>
		</div>
		<br>
		<div class="espa">
			<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Modificar</button>
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