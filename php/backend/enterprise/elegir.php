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
		<div class="panel panel-success" style="margin-top:120px;">
		  <div class="panel-heading">
		  	<p class="letra4x" style="margin-top:10px;"><span class="icon-users" style="margin-right:20px;"></span>Escoga las mercancías de acuerdo al número</p>
		  </div>
		  <div class="panel-body">
		    <div class="row">
		    	<div class="col-md-4 col-md-offset-4">
		    		<h2 class="text-center letra4x">Número DM</h2>	
		    		<select class="form-control input-lg" id="numberdm">
				    	<option></option>
						<?php
							$st = $cn->prepare("SELECT * FROM numerosdm WHERE empresa = ?");
							$st->bindParam(1, $_SESSION['name']);
							$st->execute();
							$rs = $st->fetchAll();
							foreach ($rs as $key => $value) {
			 				?>
			 					<option value="<?php echo $value['numero_dm']; ?>"><?php echo utf8_encode($value['numero_dm']); ?></option>
			 				<?php
							}
						?>
					</select>
					<br>
					<a href="javascript:MostrarMerca();" class="btn btn-success btn-block"><span class="icon-search" style="margin-right:10px;"></span>Ver mercancía</a>
		    	</div>	
		    </div>
		  </div>
		</div>
		</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>