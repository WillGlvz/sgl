<table class='table table-striped table-bordered table-hover' style="text-align:center;" id="tav">
	<tr class='warning'>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Cargo</th>
		<th>Ver</th>
		<th>Editar</th>
		<th>Eliminar</th>
	</tr>
	<tbody>
		<?php  
			include '../maestros/conexion.php';
			$cn = new Database();
			$rs = "";
			$st = $cn->prepare("SELECT COUNT(*) AS Total FROM tipos_usuarios");
			$st->execute();
			$res = $st->fetch();
			$NumRegistros = $res['Total'];
			$TamPag = 7;
			if (isset($_GET['paginas'])) {
				$paginas = $_GET['paginas'];
				$inicio = ($paginas - 1) * $TamPag;
			}else{
				$inicio = 0;
				$paginas = 1;
			}
			$TotalPaginas = ceil($NumRegistros / $TamPag);
			$st = $cn->prepare("SELECT id_tipo_usuario, nombre_tipo_usuario, identificador_tipo_usuario, descripcion_tipo_usuario FROM 
				tipos_usuarios LIMIT :inicio, :paginas");
			$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
			$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
			$st->execute();
			$resultado = $st->fetchAll();
			foreach ($resultado as $key => $value) {
				$rs .= "<tr>";
				$rs .= "<td class='active' id='jk'>$value[id_tipo_usuario]</td>";
				$rs .= utf8_encode("<td class='active'>$value[nombre_tipo_usuario]</td>");
				$rs .= utf8_encode("<td class='active'>$value[descripcion_tipo_usuario]</td>");
				$rs .= utf8_encode("<td class='active'>$value[identificador_tipo_usuario]</td>");
				$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:ir(".$value['id_tipo_usuario'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
				$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2(".$value['id_tipo_usuario'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'><input type='hidden' id='hid' value='$value[id_tipo_usuario]'/></span></a></td>";
				$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarTipoUsu(".$value['id_tipo_usuario'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'><input type='hidden' id='hid2' name='hidx' value='$value[id_tipo_usuario]'/></span></a></td>";
				$rs .= "</tr>";
			}
			print($rs);
			?>
			<tr>
				<td>
					<?php 
						if ($TotalPaginas > 1) {
							if ($paginas != 1) {
								echo '<a href="'.'index.php?paginas='.($paginas - 1).'"><-</a>';
							}
							for ($i=1; $i < $TotalPaginas; $i++) { 
								if ($paginas == $i) {
									echo $paginas;
								}else{
									echo '<a href="'.'index.php?paginas='.($i).'">'.$i.'</a>';
								}
							}
						}
					?>
				</td>
			</tr>
	</tbody>
</table>