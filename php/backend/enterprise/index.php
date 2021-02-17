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
<body style="background-color: #F0E7C0;">
	<div class="container">
		<div class="panel panel-success" style="margin-top:80px;">
		  <div class="panel-heading">
		  	<p class="letra4x text-center" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Bienvenido <?php echo $_SESSION['name']; ?></p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-4 col-md-offset-4">
		    		<h2 class="text-center letra4x">Menú de opciones</h2>	
		    	</div>	
		    </div>
		    <br>
		    <div class="row">
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/php/backend/enterprise/elegir.php"><img src="http://localhost/SGL/php/backend/img/retirar.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Desprendimientos</h2>
		    	</div>
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/php/backend/enterprise/actualizar.php"><img src="http://localhost/SGL/php/backend/img/editar.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Editar información</h2>
		    	</div>
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/php/backend/enterprise/comprobante.php"><img src="http://localhost/SGL/php/backend/img/check.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Mercancía retirada</h2>
		    	</div>
		    	<div class="col-md-3">
		    		<a href="http://localhost/SGL/php/backend/enterprise/chat_empresas.php"><img src="http://localhost/SGL/php/backend/img/logout.png" class="img-responsive center-block iner" width="200" height="200"></a>
		    		<h2 class="text-center letra4x">Chat</h2>
		    	</div>
		    </div>
		  </div>
		</div>
	</div>
	<footer class="footer">
		<p class="text-center">Servicios Globales Logísticos © <script>var fecha = new Date(); var anio = fecha.getFullYear(); document.write(anio);</script></p>	
	</footer>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>