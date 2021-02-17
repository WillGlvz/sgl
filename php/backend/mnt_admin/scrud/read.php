<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombres_admin, apellidos_admin, usuario_admin, correo_admin, codigo_activacion,
	img_admin, nombre_tipo_usuario, identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, 
	permiso_merc, permiso_unim, permiso_tipom, permiso_comprob, permiso_front FROM administradores a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=
	t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
	<div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Nombres: </strong><?php echo utf8_encode($res['nombres_admin']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Apellidos: </strong><?php echo utf8_encode($res['apellidos_admin']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Usuario: </strong><?php echo utf8_encode($res['usuario_admin']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Correo: </strong><?php echo $res['correo_admin']; ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Estado: </strong><?php if ($res['codigo_activacion'] == 1) {echo 'Habilitado';}else{echo 'Deshabilitado';} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Tipo usuario: </strong><?php echo utf8_encode($res['nombre_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Cargo: </strong><?php echo utf8_encode($res['identificador_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso tipos usuario: </strong><?php if ($res['permiso_tipou'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso empresas: </strong><?php if ($res['permiso_empre'] == 1) {echo "Permitido"; }else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso mercancías: </strong><?php if ($res['permiso_merc'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso unidades medida: </strong><?php if ($res['permiso_unim'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso tipos mercancía: </strong><?php if ($res['permiso_tipom'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso comprobantes: </strong><?php if ($res['permiso_comprob'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Administradores: </strong><?php if ($res['permiso_admin'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Frontend: </strong><?php if ($res['permiso_front'] == 1) { echo "Permitido";}else{echo "Denegado";} ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <img src="<?php echo $res['img_admin']; ?>" class="center-block" width="300" height="200">
            <div class="espa">
                <a href="http://localhost/SGL/admin/cpanel/users" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
            </div>
        </ul>
    </div>
	<?php
?>