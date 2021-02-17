<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT permiso_admin FROM administradores a INNER JOIN tipos_usuarios t ON 
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_admin'] == TRUE){
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
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor de administradores</p>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-left:20px;"><a href="#new" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><span class="icon-plus" style="font-size:2em; margin-right:20px;"><br></span>Nuevo</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="javascript:window.open('http://localhost/SGL/php/backend/mnt_admin/reporte.php','','width=800,height=600,left=50,top=50,toolbar=yes');void 0"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
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
										<input type="text" class="form-control" id="caj" placeholder="Buscar por nombre o apellido" name="txtdato">
									</div>
								</div>
								<div style="overflow-Y:scroll; width:100%; height:350px;" id="ctime">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
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
					                		<th>Reporte</th>
					            		</tr>
					            		<tbody>
					            			<?php 
					            			require_once '../librerias/Zebra_Pagination.php';
					            				$pgn = new Zebra_Pagination();
					            				$rs = "";
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM  administradores");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
												$st = $cn->prepare("SELECT id_admin, nombres_admin, apellidos_admin, usuario_admin, correo_admin, nombre_tipo_usuario
					            					FROM administradores a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=t.id_tipo_usuario LIMIT :inicio, :paginas");
												$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
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
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:iradmin(".$value['id_admin'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2admin(".$value['id_admin'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarAdmin(".$value['id_admin'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-success' target='_blank' href='http://localhost/SGL/php/backend/mnt_admin/reporte_one.php?id=".$value['id_admin']."'><span class='icon-file-pdf' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
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
									<div class="col-md-4 col-md-offset-4">
										<form method="post" onsubmit="AgregarAdmin(); return false;" name="frm">
											<div>
												<label class="laabel">Nombres (*):</label>
												<input type="text" id="nombr" name="txtnombre" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese sus nombre" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Apellidos (*):</label>
												<input type="text" id="apell" name="txtapellidos" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese sus apellidos" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Usuario (*):</label>
												<input type="text" id="nit" name="txtnit" pattern=".{3,}" required placeholder="Ingrese su usuario" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Correo (*):</label>
												<input type="text" id="correo" name="txtcorreo" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese su correo" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Tipo (*):</label>
												<select name="cmbtipo" id="tipo" required>
						    						<option></option>
						    						<?php
						    							$st = $cn->prepare("SELECT * FROM tipos_usuarios");
						    							$st->execute();
						    							$rs = $st->fetchAll();
						    							foreach ($rs as $key => $value) {
						    			 				?>
						    			 					<option value="<?php echo $value['nombre_tipo_usuario']; ?>"><?php echo utf8_encode($value['nombre_tipo_usuario']); ?></option>
						    			 				<?php
						    							}
						    						?>
												</select>
											</div>
											<div class="espa">
												<label class="laabel">Estado (*):</label>
												<select name="cmbestado" id="estado" required>
													<option></option>
													<option value="Habilitado">Habilitado</option>
													<option value="Deshabilitado">Deshabilitado</option>
												</select>
											</div>
											<div class="espa">
												<label class="laabel">Clave (*):</label>
												<input type="password" id="pass" name="txtpass" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Ingrese su clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas" />
											</div>
											<div class="espa">
												<label class="laabel">Confirmar (*):</label>
												<input type="password" id="pass1" name="txtpass2" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" required placeholder="Confirmar clave" autocomplete="off" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
											</div>
											<div class="espa">
												<div class="col-md-6">
													<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Agregar</button>
												</div>
												<div class="col-md-6">
													<a href="index.php" class="btn btn-info btn-block"><span class="icon-arrow-left3" style="margin-right:10px;"></span>Regresar</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade in" id="new2">
								<h2 class="text-center letra5">Modifique los datos</h2>
								<br>
								<div class="row">
									<div class="col-md-4 col-md-offset-4" id="ct">
									</div>
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