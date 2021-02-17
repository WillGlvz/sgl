<?php
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin');
	}
	$st = $cn->prepare("SELECT permiso_tipou FROM administradores a INNER JOIN tipos_usuarios t ON
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_tipou'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin';</script>";
	}
	$st = $cn->prepare("SELECT estado_sesion FROM administradores WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res6 = $st->fetch();
	if ($res6['estado_sesion'] == 0) {
		echo "<script>window.alert('Se ha cerrado la sesión');</script>";
		echo "<script>window.location='http://localhost/SGL/admin/log-out';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:80px; background-color: #F0E7C0;">
	<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="col-md-12">
			<br>
			<div role="tabpanel">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor tipos admin</p>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-left:20px;"><a href="#new" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><span class="icon-plus" style="font-size:2em; margin-right:20px;"><br></span>Nuevo</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="javascript:window.open('http://localhost/SGL/admin/cpanel/userprofiles-report','','width=800,height=600,left=50,top=50,toolbar=yes');void 0"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
						            <li role="presentation" class="ta text-center"><a href="javascript:window.print();"><span class="icon-print" style="font-size:2em;"><br></span>Imprimir</a></li>
						            <li role="presentation" class="ta text-center"><a href="#new2" data-toggle="tab" style="display:none;"></a></li>
						            <li role="presentation" class="ta text-center"><a href="#new3" data-toggle="tab" style="display:none;"></a></li>
						         </ul>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="list">
								<div class="row">
									<div class="col-md-5" style="margin-bottom:10px;">
										<input type="text" class="form-control" id="caj1" placeholder="Buscar por nombre" name="txtdato1">
									</div>
								</div>
								<div style="overflow-Y:scroll; width:100%; height:320px;" id="ctime">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
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
					            		<tbody>
					            			<?php
					            				require_once '../librerias/Zebra_Pagination.php';
					            				$pgn = new Zebra_Pagination();
					            				$rs = "";
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM tipos_usuarios");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
												$st = $cn->prepare("SELECT id_tipo_usuario, nombre_tipo_usuario, identificador_tipo_usuario, descripcion_tipo_usuario FROM
													tipos_usuarios LIMIT :inicio, :paginas");
												$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
												$st->execute();
					            				$resultado = $st->fetchAll();
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
					            			?>
					            		</tbody>
									</table>
								</div>
								<br>
								<?php $pgn->render(); ?>
							</div>
							<div role="tabpanel" class="tab-pane fade in" id="new">
								<h2 class="text-center letra5">Ingrese sus datos</h2>
								<br>
								<div class="row">
									<div class="col-md-4">
										<form method="post" onsubmit="AgregarTipoAdmin(); return false;" name="frm">
											<div>
												<label class="laabel">Nombre (*):</label>
												<input type="text" id="nombr" name="txtnombre" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Descripción (*):</label>
												<textarea id="descr" name="txtdescripcion" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"></textarea>
											</div>
											<div class="espa">
												<label class="laabel">Cargo (*):</label>
												<select name="cmbcargo" id="cargo" required>
													<option value=""></option>
													<option value="Jefe">Jefe</option>
													<option value="Empleado">Empleado</option>
													<option value="Otro">Otro</option>
												</select>
											</div>
											<div class="espa">
												<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Agregar</button>
												<a href="index.php" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
											</div>
										</form>
									</div>
									<div class="col-md-4">
										<div class="">
											<label class="laabe">Permisos a otorgar:</label>
										</div>
										<div style="border: 2px solid black;">
											<div style="margin-left:10px;">
												<div class="espa">
													<input type="checkbox" id="tipou"  name="chktipou" onchange="cambiarV();"> Tipos usuarios
													<input type="checkbox" id="admin" name="chkadmin" style="margin-left:65px;" onchange="cambiarV();"> Administradores
												</div>
												<div class="espa">
													<input type="checkbox" id="empre" name="chkempre" onchange="cambiarV();"> Empresas
													<input type="checkbox" id="merc" name="chkmerc" style="margin-left:93px;" onchange="cambiarV();"> Mercancías
												</div>
												<div class="espa">
													<input type="checkbox" id="unim" name="chkunim" onchange="cambiarV();"> Unidades de medida
													<input type="checkbox" id="tipom" name="chktipom" style="margin-left:26px;" onchange="cambiarV();"> Tipos mercancías
												</div>
												<div class="espa">
													<input type="checkbox" id="comprob" name="chkcomprob" onchange="cambiarV();"> Comprobantes
													<input type="checkbox" id="front" name="chkfront" style="margin-left:64px;" onchange="cambiarV();"> Frontend
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade in" id="new2">
								<h2 class="text-center letra5">Modifique los datos</h2>
								<br>
								<div class="row" id="ct">
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade in" id="new3">
								<h2 class="text-center letra5">Consulta de datos</h2>
								<br>
								<div class="row" id="ct2">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>
