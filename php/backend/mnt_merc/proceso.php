<table class='table table-striped table-bordered table-hover' style="text-align:center;" id="tav">
	<tr class='info'>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Cajas</th>
		<th>P. Unit.</th>
		<th>P. Vent.</th>
        <th>Empresa</th>
		<th>Ver</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>
	<tbody>
		<?php  
			include '../maestros/conexion.php';
			$cn = new Database();
			$rs = "";
			$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa
					FROM mercancias m INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm");
			$st->execute();
			$resultado = $st->fetchAll();
			foreach ($resultado as $key => $value) {
				$rs .= "<tr class='inover'>";
    			$rs .= "<td class='active' id='jk'>$value[numero_dm]</td>";
    			$rs .= utf8_encode("<td class='active'>$value[nombre_merc]</td>");
    			$rs .= utf8_encode("<td class='active'>$value[cant_cajas_merc]</td>");
                $rs .= utf8_encode("<td class='active'>$value[precio_unitario_merc]</td>");
                $rs .= utf8_encode("<td class='active'>$value[precio_venta_merc]</td>");
                $rs .= utf8_encode("<td class='active'>$value[nombre_empresa]</td>");
    			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:ir(".$value['id_merc'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_merc'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarMerc(".$value['id_merc'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
    			$rs .= "</tr>";	
			}
			print($rs);
			?>
	</tbody>
</table>