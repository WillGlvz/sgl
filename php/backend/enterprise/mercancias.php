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
								<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Gestor de mercancías</p>
							</div>
							<div class="col-md-4 col-md-offset-2">
								<ul class="nav nav-tabs" role="tablist" id="myTab">
									<li role="presentation" class="active ta text-center"><a href="#list" aria-controls="home" data-toggle="tab" class="ja" id="as"><span class="icon-list-ordered" style="font-size:2em; margin-right:20px;"><br></span>Listado</a></li>
						            <li role="presentation" class="ta text-center" style="margin-right:20px; margin-left:20px;"><a href="#profile"><span class="icon-file-pdf" style="font-size:2em; margin-right:20px;"><br></span>PDF</a></li>
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
								<div style="overflow-Y:scroll; width:100%; height:400px;">
									<table class='table table-striped table-bordered table-hover' style="text-align:center;">
										<tr class='info'>
					                		<th>Nombre</th>
					                		<th>Cajas</th>
					                		<th>P. Unit.</th>
					                		<th>P. Vent.</th>
					                		<th>Retirar</th>
					            		</tr>
					            		<tbody>
					            			<?php  
					            				$rs = "";
					            				$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa
					            					FROM mercancias m INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm WHERE numero_dm = ?");
					            				$st->bindParam(1, $_GET['dm']);
					            				$st->execute();
					            				$resultado = $st->fetchAll();
					            				foreach ($resultado as $key => $value) {
					            					$rs .= "<tr class='inover'>";
					                    			$rs .= utf8_encode("<td class='active'>$value[nombre_merc]</td>");
					                    			$rs .= utf8_encode("<td class='active'>$value[cant_cajas_merc]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_unitario_merc]</td>");
					                                $rs .= utf8_encode("<td class='active'>$value[precio_venta_merc]</td>");
					                                $rs .= "<td class='active'><button class='btn btn-xs btn-primary' onclick='mostrar($value[id_merc]);'><span class='icon-pencil' style='margin-left:5px; margin-right:5px; font-size:1.5em;'></span></button></td>";
					                    			$rs .= "</tr>";	
					            				}
					            				print($rs);
					            			?>
					            		</tbody>
									</table>
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
	<div class="modal fade" id="retirar-merc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Ingrese la cantidad de cajas a retirar</h4>
	      </div>
	      <form method="post" onsubmit="RetirarMerc(); return false;">
		      <div class="modal-body">
		          <div class="form-group">
		            <label for="recipient-name" class="control-label">Número DM:</label>
		            <input type="hidden" class="form-control" id="id-merc" disabled>
		            <input type="text" class="form-control" id="dm" disabled style="text-align:center" name="txtdm"/>
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="control-label">Nombre:</label>
		            <input type="text" class="form-control" id="nombre" disabled style="text-align:center" name="txtnombre"/>
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="control-label">Cajas actuales:</label>
		            <input type="text" class="form-control" id="cajasact" disabled style="text-align:center" name="txtcajasact"/>
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="control-label">Cajas a retirar:</label>
		            <input type="number" class="form-control" id="retirar" placeholder="Cantidad a retirar" style="text-align:center" name="txtretirar"/>
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="control-label">Precio unitario:</label>
		            <input type="text" class="form-control" id="preciou" disabled style="text-align:center" name="txtpreciou"/>
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="control-label">Precio de venta:</label>
		            <input type="text" class="form-control" id="preciov" disabled style="text-align:center" name="txtpreciov"/>
		            <input type="hidden" class="form-control" id="empresa" disabled style="text-align:center" name="txtempresa"/>
		            <input type="hidden" class="form-control" id="porc" disabled style="text-align:center" name="txtporc"/>
		            <input type="hidden" class="form-control" id="nueva" disabled style="text-align:center" name="txtcantnueva"/>
		          </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Retirar</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<script type="text/javascript">
		function mostrar(id){
			var url = 'http://localhost/SGL/php/backend/enterprise/json.php';
				$.ajax({
				type:'POST',
				url:url,
				data:'id='+id,
				success: function(valores){
						var datos = eval(valores);
						$('#id-merc').val(id);
						$('#dm').val(datos[0]);
						$('#nombre').val(datos[1]);
						$('#cajasact').val(datos[2]);
						$('#preciou').val(datos[3]);
						$('#preciov').val(datos[4]);
						$('#empresa').val(datos[5]);
						$('#porc').val(datos[6]);
						$('#retirar-merc').modal({
							show:true,
							backdrop:'static'
						});
					return false;
				}
			});
			return false;
		}
	</script>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>