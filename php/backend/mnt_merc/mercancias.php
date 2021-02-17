<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-login-system-sgl');
	}
	$st = $cn->prepare("SELECT permiso_merc FROM administradores a INNER JOIN tipos_usuarios t ON 
		a.id_tipo_usuario=t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_SESSION['id']);
	$st->execute();
	$res = $st->fetch();
	if($res['permiso_merc'] == TRUE){
	}else{
		echo "<script>window.alert('No tienes permiso para acceder a esta pagina');</script>";
		echo "<script>window.location='http://localhost/SGL/admin-login-system-sgl';</script>";
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
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor de mercancías</p>
							</div>
							<div class="col-md-4 col-md-offset-2">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as" style="display:none;"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="javascript:window.open('http://localhost/SGL/php/backend/mnt_merc/reporte.php?dm=<?php echo $_GET['dm']; ?>','','width=800,height=600,left=50,top=50,toolbar=yes');void 0"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
						            <li role="presentation" class="ta text-center"><a href="http://localhost/SGL/admin/cpanel/freight"><span class="icon-mail-reply" style="font-size:2em;"><br></span>Regresar</a></li>
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
										<input type="text" class="form-control" id="caj5" placeholder="Buscar por nombre" name="txtdato1">
										<input type="hidden" value="<?php echo $_GET['dm']; ?>" name="txtget" id="get">
									</div>
								</div>
								<div style="overflow-Y:scroll; width:100%; height:320px;" id="ctime">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
										<tr class='info'>
					                		<th>Nombre</th>
					                		<th>Cajas</th>
					                		<th>P. Unit.</th>
					                		<th>P. Vent.</th>
					                        <th>Empresa</th>
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
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM empresas");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
					            				$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa
					            					FROM mercancias m INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm WHERE numero_dm = :get LIMIT :inicio, :paginas");
					            				$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
												$st->bindParam(':get', $_GET['dm'], PDO::PARAM_INT);
												$st->execute();
					            				$resultado = $st->fetchAll();  
					            				foreach ($resultado as $key => $value) {											
					            					$rs .= "<tr class='inover'>";
					                    			$rs .= utf8_encode("<td class='active'>$value[nombre_merc]</td>");
					                    			$rs .= utf8_encode("<td class='active'>$value[cant_cajas_merc]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_unitario_merc]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_venta_merc]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[nombre_empresa]</td>");
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-info' href='javascript:irmerc(".$value['id_merc'].");'><span class='icon-search' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-primary' href='javascript:ir2merc(".$value['id_merc'].");'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-danger' href='javascript:EliminarMerc(".$value['id_merc'].");'><span class='icon-x' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
					                    			$rs .= "<td class='active'><a class='btn btn-xs btn-success' target='_blank' href='http://localhost/SGL/php/backend/mnt_merc/reporte_one.php?id=".$value['id_merc']."'><span class='icon-file-pdf' style='margin-left:10px; margin-right:10px; font-size:1.5em;'></span></a></td>";
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