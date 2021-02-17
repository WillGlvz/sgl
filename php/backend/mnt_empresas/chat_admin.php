<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['nombre'])) {
		header('Location: http://localhost/SGL/admin-system-login-sgl');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:40px; background-color: #F0E7C0;">
<?php include '../maestros/header.php';?>
	<div class="container">
		<div class="panel panel-success" style="margin-top:80px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Chat empresarial</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-4 col-md-offset-4" id="veri">
		    		<h2 class='text-center letra4x'>Revise todos los mensajes</h2>
		    	</div>
		    	<form id="frm">
		    		<div class="form-group">
		    			<div class="col-md-6 col-md-offset-3">
				    		<div id="conver" style="height:140px; border: 1px solid #CCCCCC; padding: 12px;  border-radius: 5px; overflow-x: hidden;"></div>
				    	</div>
		    		</div>
		    		<div class="form-group">
		    			<div class="col-md-6 col-md-offset-3">
		    			<br>
				    		<textarea id="mensaje" name="txtmensaje" class="form-control" rows="2" style="resize:none;" maxlength="40"></textarea>
				    		<br>
				    		<button class="btn btn-primary btn-block" id="enviar">Enviar</button>
				    	</div>
		    		</div>
		    	</form>	
		    	<div class="col-md-6 col-md-offset-3">
		    		<br>
					<button class="btn btn-danger btn-block" onclick="EliminarConver();">Borrar conversación</button>
		    	</div>
		    </div>
		    <br>
		  </div>
		</div>
	</div>
	<?php include '../maestros/scrbody.php';?>
	<script type="text/javascript">
		$(document).on('ready', function(){
			RegistrarMensajes();
			setInterval("CargarMensajes();", 500);
		});

		var RegistrarMensajes = function(){
			$('#enviar').on('click', function(ez){
				ez.preventDefault();
				var frm = $('#frm').serialize();
				if ($('#mensaje').val() == "") {
					swal('!Atención!', 'Campos en blanco', 'warning');
				}else{
					$.ajax({
						type: 'post',
						url: 'reg.php',
						data: frm	
					}).done(function(data){
						CargarMensajes();
						$('#mensaje').val("");
						var altura = $('#conver').prop('scrollHeight');
						$('#conver').scrollTop(altura);
					});
				}
			});
		}

		var CargarMensajes = function(){
			$.ajax({
				type: 'post',
				url: 'cargar.php'
			}).done(function(data){
				$('#conver').html(data);
				$('#conver p:last-child').css({'background-color': 'lightgreen', 'padding-botton': '20px'});
				var altura = $('#conver').prop('scrollHeight');
				$('#conver').scrollTop(altura);
			});
		}

		function EliminarConver(){
			swal({
				title: "¡Eliminar conversación!",
				text: "¿Realmente desea eliminar toda la conversación?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#31b0d5",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true },
				function(isConfirm){
					if (isConfirm) {
						$.ajax({
							type: 'POST',
							url: 'http://localhost/SGL/php/backend/mnt_empresas/scrud/delete_conver.php',
							success: function(data2){
								console.log(data2);
								if(data2 == 1){
									swal("¡Completado!", "Conversación eliminada con éxito.", "success");

								}else if(data2 == 2){
									swal("¡Aviso!", "Ha ocurrido algún error.", "error");
								}
							},
							error: function(data2){
								swal("¡Aviso!", "Ha ocurrido algún error.", "error");
							}
						});
					} else {}
				});
		}
	</script>
</body>
</html>