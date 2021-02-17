<?php  
	include '../maestros/conexion.php';
	$cn = new Database();
	$id = $_POST['id'];
	$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa, porc_alch_merc FROM mercancias m INNER JOIN numerosdm n INNER JOIN empresas e ON m.id_dm=n.id_dm AND m.id_empresa=e.id_empresa WHERE id_merc = ?");
	$st->bindParam(1, $id);
	$st->execute();
	$res = $st->fetch();
	$datos = array(
		0 => $res['numero_dm'], 
		1 => utf8_decode($res['nombre_merc']), 
		2 => $res['cant_cajas_merc'], 
		3 => $res['precio_unitario_merc'],
		4 => $res['precio_venta_merc'],
		5 => $res['nombre_empresa'],
		6 => $res['porc_alch_merc'],
	);
	echo json_encode($datos);
?>