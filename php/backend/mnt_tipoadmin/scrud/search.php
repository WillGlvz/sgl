<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dato = utf8_decode($_POST['txtdato1']);
	$st = $cn->prepare("SELECT * FROM tipos_usuarios WHERE nombre_tipo_usuario LIKE '%$dato%' ORDER BY id_tipo_usuario ASC");
	$st->execute();
	$resultado = $st->fetchAll();
	echo "<table class='table table-striped table-bordered table-hover' style='text-align:center;'>
			<tr class='warning'>
        		<th>Codigo</th>
        		<th>Nombre</th>
        		<th>Descripcion</th>
        		<th>Cargo</th>
        		<th>Ver</th>
        		<th>Editar</th>
        		<th>Eliminar</th>
        		<th>Reporte</th>
    		</tr>
			<tbody>";
	if ($resultado) {
		$rs = "";
		foreach ($resultado as $key => $value) {														
			$rs .= "<tr>";
			$rs .= "<td class='active'>$value[id_tipo_usuario]</td>";
			$rs .= utf8_encode("<td class='active'>$value[nombre_tipo_usuario]</td>");
			$rs .= utf8_encode("<td class='active'>$value[descripcion_tipo_usuario]</td>");
			$rs .= utf8_encode("<td class='active'>$value[identificador_tipo_usuario]</td>");
			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:ir(".$value['id_tipo_usuario'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_tipo_usuario'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarTipoUsu(".$value['id_tipo_usuario'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
			$rs .= "<td class='active'><a class='btn btn-xs btn-success' target='_blank' href='http://localhost/SGL/php/backend/mnt_tipoadmin/reporte_one.php?id=".$value['id_tipo_usuario']."'><span class='icon-file-pdf' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
			$rs .= "</tr>";	
		}
		print($rs);
	}else{
		echo "<tr class='inover'>
			<td colspan='10' class='active'>No se encontraron resultados</td>
		</tr>";
	}
	echo "</tbody></table>";
?>