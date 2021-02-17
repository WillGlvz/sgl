<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['name'])) {
		header('Location: http://localhost/SGL/desprendimientos');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:80px; background-color: #F0E7C0;">
	<?php include '../maestros/header_enterprise.php';?>
	<div class="container">
		<div class="col-md-12">
			<br>
			<div role="tabpanel">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Mercancías retiradas</p>
							</div>
							<div class="col-md-4 col-md-offset-2">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="historial_ret.php"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
						            <li role="presentation" class="ta text-center"><a href="index.php"><span class="icon-mail-reply" style="font-size:2em;"><br></span>Regresar</a></li>
						            <li role="presentation" class="ta text-center"><a href="#new2" data-toggle="tab" style="display:none;"></a></li>
						            <li role="presentation" class="ta text-center"><a href="#new3" data-toggle="tab" style="display:none;"></a></li>
						         </ul>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="list">
								<br>
								<div style="overflow-Y:scroll; width:100%; height:350px;">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
										<tr class='info'>
					                		<th>Nombre</th>
					                		<th>Cant. retirada</th>
					                		<th>P. Unit.</th>
					                		<th>P. Vent.</th>
					                		<th>Fecha retiro</th>
					                		<th>Eliminar</th>
					            		</tr>
					            		<tbody>
					            			<?php
					            				require_once '../librerias/Zebra_Pagination.php';
					            				$pgn = new Zebra_Pagination();  
					            				$rs = "";
					            				$st = $cn->prepare("SELECT COUNT(*) AS Total FROM comprobantes");
												$st->execute();
												$res = $st->fetch();
												$TamPag = 10;
												$pgn->records($res['Total']);
												$pgn->records_per_page($TamPag);
												$inicio = ($pgn->get_page() - 1) * $TamPag;
					            				$st = $cn->prepare("SELECT id_comprobante, nombre_merc_c, cantidad_cajas, precio_unitario, precio_venta, fecha_retiro FROM comprobantes c INNER JOIN numerosdm n ON c.id_dm=n.id_dm WHERE id_empresa = :empre ORDER BY id_comprobante ASC LIMIT :inicio, :paginas");
					            				$st->bindParam(':empre', $_SESSION['code']);
					            				$st->bindParam(':inicio', $inicio, PDO::PARAM_INT);
												$st->bindParam(':paginas', $TamPag, PDO::PARAM_INT);
					            				$st->execute();
					            				$resultado = $st->fetchAll();
					            				foreach ($resultado as $key => $value) {
					            					$rs .= "<tr class='inover'>";
					                    			$rs .= utf8_encode("<td class='active'>$value[nombre_merc_c]</td>");
					                    			$rs .= utf8_encode("<td class='active'>$value[cantidad_cajas]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_unitario]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_venta]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[fecha_retiro]</td>");
					                                $rs .= "<td class='active'><button class='btn btn-xs btn-danger' onclick='EliminarMercRet($value[id_comprobante]);'><span class='icon-x' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></button></td>";
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