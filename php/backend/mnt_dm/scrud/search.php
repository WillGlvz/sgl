<?php  
	include '../../maestros/conexion.php';
	$cn = new Database();
	$dato = utf8_decode($_POST['txtdato1']);
	$st = $cn->prepare("SELECT * FROM numerosdm WHERE numero_dm LIKE '%$dato%' ORDER BY id_dm ASC");
	$st->execute();
	$resultado = $st->fetchAll();
	echo "<table class='table table-striped table-bordered table-hover' style='text-align:center;'>
			<tr class='warning'>
        		<th>Código</th>
        		<th>FOB</th>
        		<th>Flete</th>
        		<th>Seguro</th>
        		<th>Gasto</th>
        		<th>CIF</th>
        		<th>Editar</th>
        		<th>Eliminar</th>
    		</tr>
			<tbody>";
	if ($resultado) {
		$rs = "";
		foreach ($resultado as $key => $value) {														
			$rs .= "<tr class='inover'>";
			$rs .= utf8_encode("<td class='active'>$value[numero_dm]</td>");
			$rs .= utf8_encode("<td class='active'>$value[fob]</td>");
			$rs .= utf8_encode("<td class='active'>$value[flete]</td>");
			$rs .= utf8_encode("<td class='active'>$value[seguros]</td>");
			$rs .= utf8_encode("<td class='active'>$value[gastos]</td>");
			$rs .= utf8_encode("<td class='active'>$value[cif]</td>");
			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_dm'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarDM(".$value['id_dm'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
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