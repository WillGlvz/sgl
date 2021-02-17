<?php  
	session_start();
	include '../maestros/conexion.php';
	$cn = new Database();
	if (!isset($_SESSION['name'])) {
		header('Location: http://localhost/SGL/desprendimientos');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGL</title>
	<?php include '../maestros/head.php';?>
</head>
<body style="margin-top:30px; background-color: #F0E7C0;">
	<?php include '../maestros/header_enterprise.php';?>
	<div class="container">
		<div class="panel panel-success" style="margin-top:80px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Chat empresarial</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-4 col-md-offset-4" id="veri">
		    	</div>
		    	<form id="frm">
		    		<div class="form-group">
		    			<div class="col-md-6 col-md-offset-3">
				    		<div id="conver" style="height:200px; border: 1px solid #CCCCCC; padding: 12px;  border-radius: 5px; overflow-x: hidden;"></div>
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
						console.log(data);
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

		function verfica(){
			var segundos = 1;
			var url = "http://localhost/SGL/php/backend/enterprise/verifica.php";
			var xmlHttp;
			try{
				xmlHttp=new XMLHttpRequest();
			}
			catch (ex){
				try{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		        }
		        catch (ex){
		            try{
		            	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		            }
		            catch (ex){
		                alert("Tu explorador no soporta AJAX.");
		                return false;
		            }
		        }
		    }
			xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
					document.getElementById('veri').innerHTML=xmlHttp.responseText;
		            setTimeout('verfica()',segundos*1000);
		         }
		    }
		    xmlHttp.open(null,url,true);
		    xmlHttp.send(null);
		    pass2 = null;
		}
		verfica();
	</script>
</body>
</html>