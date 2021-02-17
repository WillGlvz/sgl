<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dato = utf8_decode($_POST['txtdato1']);
	$st = $cn->prepare("SELECT * FROM tipo_mercancias WHERE nombre_tipo_mercancia LIKE '%$dato%' ORDER BY id_tipo_merc ASC");
	$st->execute();
	$resultado = $st->fetchAll();
	echo "<table class='table table-striped table-bordered table-hover' style='text-align:center;'>
			<tr class='info'>
        		<th>Codigo</th>
        		<th>Nombre</th>
        		<th>Descripción</th>
        		<th>Editar</th>
        		<th>Eliminar</th>
    		</tr>
			<tbody>";
	if ($resultado) {
		$rs = "";
		foreach ($resultado as $key => $value) {														
			$rs .= "<tr class='inover'>";
			$rs .= "<td class='active' id='jk'>$value[id_tipo_merc]</td>";
			$rs .= utf8_encode("<td class='active'>$value[nombre_tipo_mercancia]</td>");
			$rs .= utf8_encode("<td class='active'>$value[descripcion_tipo_mercancia]</td>");
			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_tipo_merc'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarTipom(".$value['id_tipo_merc'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
			$rs .= "</tr>";	
		}
		print($rs);
	}else{
		echo "<tr class='inover'>
			<td colspan='9' class='active'>No se encontraron resultados</td>
		</tr>";
	}
	echo "</tbody></table>";
?>