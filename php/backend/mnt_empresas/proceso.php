<table class='table table-striped table-bordered table-hover' style="text-align:center;" id="tav">
	<tr class='warning'>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Teléfono</th>
		<th>NIT</th>
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
			$st = $cn->prepare("SELECT id_empresa, nombre_empresa, telefono_empresa, nit_empresa, correo_empresa, nombre_tipo_usuario
				FROM empresas e INNER JOIN tipos_usuarios t ON e.id_tipo_usuario=t.id_tipo_usuario");
			$st->execute();
			$resultado = $st->fetchAll();
			foreach ($resultado as $key => $value) {														
				$rs .= "<tr class='inover'>";
    			$rs .= "<td class='active' id='jk'>$value[id_empresa]</td>";
    			$rs .= utf8_encode("<td class='active'>$value[nombre_empresa]</td>");
    			$rs .= utf8_encode("<td class='active'>$value[telefono_empresa]</td>");
                $rs .= utf8_encode("<td class='active'>$value[nit_empresa]</td>");
                $rs .= utf8_encode("<td class='active'>$value[correo_empresa]</td>");
                $rs .= utf8_encode("<td class='active'>$value[nombre_tipo_usuario]</td>");
    			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:ir(".$value['id_empresa'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_empresa'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarEmpre(".$value['id_empresa'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
    			$rs .= "</tr>";	
			}
			print($rs);
			?>
	</tbody>
</table>