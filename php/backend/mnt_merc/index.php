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
							$st = $cn->prepare("SELECT * FROM numerosdm");
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
					<a href="javascript:MostrarMerc();" class="btn btn-primary btn-block"><span class="icon-search" style="margin-right:10px;"></span>Ver mercancía</a>
					<a href="http://localhost/SGL/admin/cpanel/freight/new" class="btn btn-success btn-block"><span class="icon-plus" style="margin-right:10px;"></span>Nueva mercancía</a>
		    	</div>	
		    </div>
		  </div>
		</div>
		</div>
	<?php include '../maestros/scrbody.php';?>
</body>
</html>