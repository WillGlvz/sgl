<?php  
	session_start();
	include '../maestros/conexion.php';
	include '../librerias/fpdf.php';
	date_default_timezone_set("America/El_Salvador");
	$cn = new Database();
	$report = new FPDF('L','mm', 'A4'); 
	$report->AddFont('Poiret One','','PoiretOne-Regular.php');
	$report->AddFont('Pacifico','','Pacifico.php');
	$report->AddFont('Open Sans','','OpenSans-Semibold.php');
	$report->AddFont('Josefin Sans','','JosefinSans-Regular.php');
	$report->AddPage();
	$report->SetMargins(15, 15 , 15);
	$report->SetAutoPageBreak(true, 15); 
	$report->Image('../img/logo_report.png', 10, 7, 60, 30, 'PNG');
	$report->SetFont('Poiret One','', 25);
	$report->Cell(90, 10, '', 0);
	$report->Cell(90, 20, utf8_decode('Servicios Globales Logísticos'), 0);
	$report->Ln(20);
	$report->SetFont('Josefin Sans','', 25);
	$report->Cell(90, 10, '', 0);
	$report->Cell(90, 20, utf8_decode('Reporte de empresas'), 0);
	$report->Ln(20);
	$report->SetFont('Josefin Sans', '', 12);
	$report->Cell(50, 10, 'Reporte generado por: '.$_SESSION['nombre'], 0);
	$report->Ln(15);
    $report->SetDrawColor(4,0,181);
    $report->SetLineWidth(.3);
	$report->SetFont('Open Sans', '', 9);
	$report->Cell(43, 8, utf8_decode('Código'), 1, 0, 'C');
	$report->Cell(43, 8, utf8_decode('Nombre'), 1, 0, 'C');
	$report->Cell(43, 8, utf8_decode('Télefono'), 1, 0, 'C');
	$report->Cell(43, 8, utf8_decode('NIT'), 1, 0, 'C');
	$report->Cell(43, 8, utf8_decode('NRC'), 1, 0, 'C');
	$report->Cell(43, 8, utf8_decode('Correo'), 1, 0, 'C');
	$report->Ln(8);
	$report->SetFont('Josefin Sans', '', 10);
	$st = $cn->prepare("SELECT id_empresa, nombre_empresa, telefono_empresa, nit_empresa, nrc_empresa, correo_empresa FROM empresas a INNER JOIN tipos_usuarios t ON a.id_tipo_usuario=t.id_tipo_usuario ORDER BY id_empresa ASC");
	$st->execute();
	$resultado = $st->fetchAll();
	foreach ($resultado as $key => $value) {
		$report->Cell(43, 8, utf8_encode($value['id_empresa']), 1, 0, 'C');
		$report->Cell(43, 8, utf8_decode($value['nombre_empresa']), 1, 0, 'C');
		$report->Cell(43, 8, utf8_decode($value['telefono_empresa']), 1, 0, 'C');
		$report->Cell(43, 8, utf8_decode($value['nit_empresa']), 1, 0, 'C');
		$report->Cell(43, 8, utf8_decode($value['nrc_empresa']), 1, 0, 'C');
		$report->Cell(43, 8, utf8_decode($value['correo_empresa']), 1, 0, 'C');
		$report->Ln(8);
	}
	$report->Ln(8);
	$report->Cell(86,10,'Fecha: '.date("d-m-Y"),0,0,'C');
	$report->Cell(86,10,utf8_decode('Página ').$report->PageNo(),0,0,'C');
	$report->Cell(86,10,'Hora: '.date("H:i:s"),0,0,'C');
	$report->Output();
?>