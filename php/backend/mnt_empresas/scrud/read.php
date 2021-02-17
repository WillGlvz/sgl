<?php  
	include '../../maestros/conexion.php';
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
	<div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Nombre: </strong><?php echo utf8_encode($res['nombre_empresa']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Descripcion: </strong><?php echo utf8_encode($res['descripcion_empresa']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Direccion: </strong><?php echo utf8_encode($res['direccion_empresa']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Télefono: </strong><?php echo $res['telefono_empresa']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Correo: </strong><?php echo $res['correo_empresa']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>NIT: </strong><?php echo $res['nit_empresa']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>NRC: </strong><?php echo $res['nrc_empresa']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Contacto: </strong><?php echo $res['contacto_empresa']; ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Télefono contacto: </strong><?php echo utf8_encode($res['telf_contacto_empresa']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Correo contacto: </strong><?php echo utf8_encode($res['correo_contacto_empresa']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Tipo: </strong><?php echo utf8_encode($res['nombre_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Departamento: </strong><?php echo utf8_encode($res['nombre_departamento']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Municipio: </strong><?php echo utf8_encode($res['nombre_municipio']); ?></li>
            <div class="espa">
                <a href="http://localhost/SGL/admin/cpanel/enterprise" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
            </div>
        </ul>
    </div>
	<?php
?>