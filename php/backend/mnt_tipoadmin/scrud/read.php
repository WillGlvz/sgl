<?php
	include '../../maestros/conexion.php';
	$cn = new Database();
	$st = $cn->prepare("SELECT nombre_tipo_usuario, descripcion_tipo_usuario, identificador_tipo_usuario,
		permiso_tipou, permiso_admin, permiso_empre, permiso_merc, permiso_unim, permiso_tipom, permiso_comprob,
		permiso_front FROM tipos_usuarios WHERE id_tipo_usuario = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$res = $st->fetch();
	?>
	<div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Nombre: </strong><?php echo utf8_encode($res['nombre_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Descripcion: </strong><?php echo utf8_encode($res['descripcion_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Cargo: </strong><?php echo utf8_encode($res['identificador_tipo_usuario']); ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Tipos Usuario: </strong><?php if ($res['permiso_tipou'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Administradores: </strong><?php if ($res['permiso_admin'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Empresas: </strong><?php if ($res['permiso_empre'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Mercancías: </strong><?php if ($res['permiso_merc'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Números DM: </strong><?php if ($res['permiso_unim'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Tipos Mercancías: </strong><?php if ($res['permiso_tipom'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Comprobantes: </strong><?php if ($res['permiso_comprob'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
            <li class="list-group-item list-group-item-default text-center"><strong>Acceso Frontend: </strong><?php if ($res['permiso_front'] == 1) {echo "Permitido";}else{echo "Denegado";} ?></li>
        </ul>
        <div class="espa">
            <a href="http://localhost/SGL/admin/cpanel/userprofiles" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
        </div>
    </div>
	<?php
?>
