<?php  
	session_start();
	include '../maestros/conexion.php';
	include '../librerias/fpdf.php';
	date_default_timezone_set("America/El_Salvador");
	$cn = new Database();
	$report = new FPDF();
	$report->AddFont('Poiret One','','PoiretOne-Regular.php');
	$report->AddFont('Pacifico','','Pacifico.php');
	$report->AddFont('Open Sans','','OpenSans-Semibold.php');
	$report->AddFont('Josefin Sans','','JosefinSans-Regular.php');
	$report->AddPage();
	$report->SetMargins(15, 15 , 15);
	$report->SetAutoPageBreak(true, 15); 
	$report->Image('../img/logo_report.png', 10, 7, 60, 30, 'PNG');
	$report->SetFont('Poiret One','', 25);
	$report->Cell(60, 10, '', 0);
	$report->Cell(90, 20, utf8_decode('Servicios Globales Logísticos'), 0);
	$report->Ln(20);
	$report->SetFont('Josefin Sans','', 25);
	$report->Cell(32, 10, '', 0);
	$report->Cell(90, 20, utf8_decode('Reporte individual de administradores'), 0);
	$report->Ln(20);
	$report->SetFont('Josefin Sans', '', 12);
	$report->Cell(50, 10, 'Reporte generado por: '.$_SESSION['nombre'], 0);
	$report->Ln(15);
    $report->SetDrawColor(4,0,181);
    $report->SetLineWidth(.3);
	$report->SetFont('Open Sans', '', 9);
	$report->Cell(90, 8, utf8_decode('Datos'), 1, 0, 'C');
	$report->Cell(90, 8, utf8_decode('Detalle'), 1, 0, 'C');
	$report->Ln(8);
	$report->SetFont('Josefin Sans', '', 10);
	$st = $cn->prepare("SELECT id_admin, nombres_admin, apellidos_admin, usuario_admin, correo_admin,
		img_admin, nombre_tipo_usuario, identificador_tipo_usuario, permiso_tipou, permiso_admin, permiso_empre, 
		permiso_merc, permiso_unim, permiso_tipom, permiso_comprob, permiso_front FROM administradores a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=
		t.id_tipo_usuario WHERE id_admin = ?");
	$st->bindParam(1, $_GET['id']);
	$st->execute();
	$resultado = $st->fetch();
	$report->Cell(90, 8, utf8_decode('Código'), 1, 0, 'C');
	$report->Cell(90, 8, utf8_decode($resultado['id_admin']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Nombres'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['nombres_admin']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Apellidos'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['apellidos_admin']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_encode('Usuario'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['usuario_admin']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Correo'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['correo_admin']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Tipo usuario'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['nombre_tipo_usuario']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Cargo'), 1, 0, 'C');
	$report->Cell(90, 8, html_entity_decode($resultado['identificador_tipo_usuario']), 1, 0, 'C');
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Tipos usuario'), 1, 0, 'C');
	if ($resultado['permiso_tipou'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Administradores'), 1, 0, 'C');
	if ($resultado['permiso_admin'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Empresas'), 1, 0, 'C');
	if ($resultado['permiso_empre'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Mercancías'), 1, 0, 'C');
	if ($resultado['permiso_merc'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Números DM'), 1, 0, 'C');
	if ($resultado['permiso_unim'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Tipos mercancía'), 1, 0, 'C');
	if ($resultado['permiso_tipom'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Comprobantes'), 1, 0, 'C');
	if ($resultado['permiso_comprob'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(8);
	$report->Cell(90, 8, utf8_decode('Frontend'), 1, 0, 'C');
	if ($resultado['permiso_front'] == TRUE) {
		$report->Cell(90, 8, utf8_decode('Permitido'), 1, 0, 'C');
	}else{
		$report->Cell(90, 8, utf8_decode('Denegado'), 1, 0, 'C');
	}
	$report->Ln(15);
	$report->Cell(60,10,'Fecha: '.date("d-m-Y"),0,0,'C');
	$report->Cell(60,10,utf8_decode('Página ').$report->PageNo(),0,0,'C');
	$report->Cell(60,10,'Hora: '.date("H:i:s"),0,0,'C');
	$report->Output();
?>