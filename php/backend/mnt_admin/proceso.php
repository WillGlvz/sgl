<table class='table table-striped table-bordered table-hover' style="text-align:center;" id="tav">
	<tr class='warning'>
		<th>Codigo</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Usuario</th>
		<th>Correo</th>
		<th>Tipo usuario</th>
		<th>Ver</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>
	<tbody>
		<?php  
			include '../maestros/conexion.php';
			$cn = new Database();
			$rs = "";
			$st = $cn->prepare("SELECT id_admin, nombres_admin, apellidos_admin, usuario_admin, correo_admin, nombre_tipo_usuario
				FROM administradores a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=t.id_tipo_usuario");
			$st->execute();
			$resultado = $st->fetchAll();
			foreach ($resultado as $key => $value) {
				$rs .= "<tr class='inover'>";
				$rs .= "<td class='active' id='jk'>$value[id_admin]</td>";
				$rs .= utf8_encode("<td class='active'>$value[nombres_admin]</td>");
				$rs .= utf8_encode("<td class='active'>$value[apellidos_admin]</td>");
				$rs .= utf8_encode("<td class='active'>$value[usuario_admin]</td>");
				$rs .= utf8_encode("<td class='active'>$value[correo_admin]</td>");
				$rs .= utf8_encode("<td class='active'>$value[nombre_tipo_usuario]</td>");
				$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:ir(".$value['id_admin'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
				$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_admin'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'><input type='hidden' id='hid' value='$value[id_admin]'/></span></a></td>";
				$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarAdmin(".$value['id_admin'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'><input type='hidden' id='hid2' name='hidx' value='$value[id_admin]'/></span></a></td>";
				$rs .= "</tr>";
			}
			print($rs);
			?>
	</tbody>
</table>