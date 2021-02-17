<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT permiso_tipom FROM administradores a INNER JOIN tipos_usuarios t ON 
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_tipom'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>w indow.location='http://localhost/SGL/admin-login-system-sgl';</script>";
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
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor tipos mercancía</p>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-left:20px;"><a href="#new" aria-controls="home" role="tab" data-toggle="tab" class="ja" id="as"><span class="icon-plus" style="font-size:2em; margin-right:20px;"><br></span>Nuevo</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="javascript:window.open('http://localhost/SGL/php/backend/mnt_tipom/reporte.php','','width=800,height=600,left=50,top=50,toolbar=yes');void 0"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
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
										<input type="text" class="form-control" id="caj4" placeholder="Buscar por nombre" name="txtdato1">
									</div>
								</div>
								<div style="overflow-Y:scroll; width:100%; height:320px;" id="ctime">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
										<tr class='info'>
					                		<th>Codigo</th>
					                		<th>Nombre</th>
					                		<th>Descripción</th>
					                		<th>Editar</th>
					                		<th>Eliminar</th>
					            		</tr>
					            		<tbody>
					            			<?php 
					            			 require_once '../librerias/Zebra_Pagination.php';
					            				$pgn = new Zebra_Pagination();
					            				$rs = "";
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM tipo_mercancias");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
												$st = $cn->prepare("SELECT id_tipo_merc, nombre_tipo_mercancia, descripcion_tipo_mercancia FROM tipo_mercancias LIMIT :inicio, :paginas");
												$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
												$st->execute();
					            				$resultado = $st->fetchAll();
					            				foreach ($resultado as $key => $value) {														
					            					$rs .= "<tr class='inover'>";
					                    			$rs .= "<td class='active' id='jk'>$value[id_tipo_merc]</td>";
					                    			$rs .= utf8_encode("<td class='active'>$value[nombre_tipo_mercancia]</td>");
					                    			$rs .= utf8_encode("<td class='active'>$value[descripcion_tipo_mercancia]</td>");
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2tipom(".$value['id_tipo_merc'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarTipom(".$value['id_tipo_merc'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
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
									<div class="col-md-4 col-md-offset-4">
										<form method="post" onsubmit="AgregarTipom(); return false;" name="frm">
											<div>
												<label class="laabel">Nombre (*):</label>
												<input type="text" id="nombr" name="txtnombre" onkeypress="return validar(event)" pattern=".{3,}" required placeholder="Ingrese el nombre" autocomplete="off"/>
											</div>
											<div class="espa">
												<label class="laabel">Descripción (*):</label>
												<textarea id="descr" name="txtdescripcion" pattern=".{7,}" placeholder="Ingrese la descripcion" rows="3" required autocomplete="off"></textarea>
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