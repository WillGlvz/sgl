<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin');
	}
	$st = $cn->prepare("SELECT permiso_empre FROM administradores a INNER JOIN tipos_usuarios t ON 
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_empre'] == TRUE){
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
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor de empresas</p>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-left:20px;"><a href="#new" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><span class="icon-plus" style="font-size:2em; margin-right:20px;"><br></span>Nuevo</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="javascript:window.open('http://localhost/SGL/php/backend/mnt_empresas/reporte.php','','width=800,height=600,left=50,top=50,toolbar=yes');void 0"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
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
										<input type="text" class="form-control" id="caj2" placeholder="Buscar por nombre o NIT" name="txtdato1">
									</div>
								</div>
								<div style="overflow-Y:scroll; width:100%; height:320px;" id="ctime">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
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
					                		<th>Reportes</th>
					            		</tr>
					            		<tbody>
					            			<?php
					            				require_once '../librerias/Zebra_Pagination.php';
					            				$pgn = new Zebra_Pagination();
					            				$rs = "";
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM empresas");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
												$st = $cn->prepare("SELECT id_empresa, nombre_empresa, telefono_empresa, nit_empresa, correo_empresa, nombre_tipo_usuario
					            					FROM empresas e INNER JOIN tipos_usuarios t ON e.id_tipo_usuario=t.id_tipo_usuario LIMIT :inicio, :paginas");
												$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
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
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:irempre(".$value['id_empresa'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2empre(".$value['id_empresa'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarEmpre(".$value['id_empresa'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-success' target='_blank' href='http://localhost/SGL/php/backend/mnt_empresas/reporte_one.php?id=".$value['id_empresa']."'><span class='icon-file-pdf' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
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
								<h2 class="text-center letra5">Ingrese los datos</h2>
								<br>
								<div class="row">
									<div class="col-md-4">
										<form method="post" onsubmit="AgregarEmpre(); return false;" name="frm">
											<div>
												<label class="laabel">Nombre (*):</label>
												<input type="text" id="nombr" name="txtnombre" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Descripción (*):</label>
												<textarea id="descr" name="txtdescripcion" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"></textarea>
											</div>
											<div class="espa">
												<label class="laabel">Dirección (*):</label>
												<input type="text" id="dir" name="txtdireccion" pattern=".{3,}" required placeholder="Ingrese la dirección" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Teléfono (*):</label>
												<input type="text" id="tel" name="txttel" maxlength="9" title="Ingrese un número de teléfono válido" pattern="^[2^6-7]{1}[0-9]{3}-[0-9]{4}$" required placeholder="Ingrese el teléfono" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Correo (*):</label>
												<input type="email" id="correo" name="txtcorreo" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Ingrese el correo" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">NIT (*):</label>
												<input type="text" id="nit" name="txtnit" pattern=".{3,}" onkeypress="return numeros(event);" maxlength="14" required placeholder="NIT (Sin guíones)" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">NRC (*):</label>
												<input type="text" id="nrc" name="txtnrc" pattern=".{3,}" onkeypress="return numeros(event);" maxlength="8" required placeholder="NRC (Sin guíones)" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Contacto (*):</label>
												<input type="text" id="cont" name="txtcont" pattern=".{3,}" required placeholder="Nombre del contacto" autocomplete="off"/>
											</div>
									</div>
									<div class="col-md-4">
											<div>
												<label class="laabel">Tel. contacto (*):</label>
												<input type="text" id="conttel" name="txtcontel" maxlength="9" title="Ingrese un número de teléfono válido" pattern="^[2^6-7]{1}[0-9]{3}-[0-9]{4}$" required placeholder="Teléfono del contacto" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Cor. contacto (*):</label>
												<input type="email" id="cortel" name="txtconcor" title="Ingrese un correo electrónico válido" pattern="^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$" required placeholder="Correo del contacto" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Departamento (*):</label>
												<select name="departamentos" id="depa" onchange="from(document.frm.departamentos.value, 'municipios', 'http://localhost/SGL/php/backend/mnt_empresas/municipios.php')" required>
						    						<option></option>
						    						<?php 
										    			$st = $cn->prepare("SELECT * FROM departamentos");
										    			$st->execute();
										    			$rs = $st->fetchAll();
										    			foreach ($rs as $key => $value) {
										    			 	?>
										    			 	<option value="<?php echo $value['id_departamento']; ?>"><?php echo utf8_encode($value['nombre_departamento']); ?></option>
										    			 	<?php
										    			}
										    		?>
												</select>
											</div>
											<div class="espa" id="municipios">
												<label class="laabel">Municipio (*)</label>
									    		<select required>
									    			<option>Escoja un departamento</option>
												</select>
											</div>
											<div class="espa">
												<label class="laabel">Clave (*):</label>
												<input type="password" id="pass" name="txtpass" required placeholder="Ingrese la clave" autocomplete="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
											</div>
											<div class="espa">
												<label class="laabel">Confirmar (*):</label>
												<input type="password" id="pass1" name="txtpass2" pattern=".{3,}" required placeholder="Confirmar clave" autocomplete="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$" title="La clave debe tener al menos un número, letras mayúsculas y minúsculas, longitud de 6 caracteres o mas"/>
											</div>
											<div class="espa">
												<button type="submit" class="btn btn-success btn-block"><span class="icon-save" style="margin-right:10px;"></span>Agregar</button>
											</div>
										</form>
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