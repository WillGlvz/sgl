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
	$report->Cell(50, 10, '', 0);
	$report->Cell(90, 20, utf8_decode('Reporte de mercancías'), 0);
	$report->Ln(20);
	$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa
		FROM mercancias m INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm WHERE numero_dm = ? ORDER BY id_merc ASC");
	$st->bindParam(1, $_GET['dm']);
	$st->execute();
	$resultado = $st->fetch();
	$report->SetFont('Josefin Sans', '', 12);
	$report->Cell(50, 10, 'Reporte generado por: '.$_SESSION['nombre'], 0);
	$report->Ln(8);
	$report->Cell(50, 10, utf8_decode('Número DM: ').html_entity_decode($_GET['dm']), 0);
	$report->Ln(8);
	$report->Cell(50, 10, utf8_decode('Empresa: ').html_entity_decode($resultado['nombre_empresa']), 0);
	$report->Ln(15);
    $report->SetDrawColor(4,0,181);
    $report->SetLineWidth(.3);
	$report->SetFont('Open Sans', '', 9);
	$report->Cell(45, 8, utf8_decode('Nombre'), 1, 0, 'C');
	$report->Cell(45, 8, utf8_decode('Cajas'), 1, 0, 'C');
	$report->Cell(45, 8, utf8_decode('Precio unitario'), 1, 0, 'C');
	$report->Cell(45, 8, utf8_decode('Precio de venta'), 1, 0, 'C');
	$report->Ln(8);
	$report->SetFont('Josefin Sans', '', 10);
	$st = $cn->prepare("SELECT id_merc, numero_dm, nombre_merc, cant_cajas_merc, precio_unitario_merc, precio_venta_merc, nombre_empresa
		FROM mercancias m INNER JOIN empresas e INNER JOIN numerosdm n ON m.id_empresa=e.id_empresa AND m.id_dm=n.id_dm WHERE numero_dm = ? ORDER BY id_merc ASC");
	$st->bindParam(1, $_GET['dm']);
	$st->execute();
	$resultado2 = $st->fetchAll();
	foreach ($resultado2 as $key => $value) {
		$report->Cell(45, 8, utf8_decode(html_entity_decode($value['nombre_merc'])), 1, 0, 'C');
		$report->Cell(45, 8, html_entity_decode($value['cant_cajas_merc']), 1, 0, 'C');
		$report->Cell(45, 8, html_entity_decode($value['precio_unitario_merc']), 1, 0, 'C');
		$report->Cell(45, 8, html_entity_decode($value['precio_venta_merc']), 1, 0, 'C');
		$report->Ln(8);
	}
	$report->Ln(8);
	$report->Cell(60,10,'Fecha: '.date("d-m-Y"),0,0,'C');
	$report->Cell(60,10,utf8_decode('Página ').$report->PageNo(),0,0,'C');
	$report->Cell(60,10,'Hora: '.date("H:i:s"),0,0,'C');
	$report->Output();
?>