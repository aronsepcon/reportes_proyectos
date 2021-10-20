<?php
    require_once("mysql_conector.inc.php");
	require_once("../fpdf/fpdf.php");
	require_once("constantes.inc.php");

	header("Content-Type: text/html;charset=utf-8");
	
	$iddoc = 'pc_5fc1216f53976';
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Image('../img/logo.png',11,11,18);
	$pdf->Cell(20,20,'',1,0,'C');
	$pdf->MultiCell(130,10,'REPORTE PRELIMINAR DE ACCIDENTE, INCIDENTE 
	Y ENFERMEDAD OCUPACIONAL',1,'C',false);
	$pdf->SetFont('Helvetica','',8);
	$pdf->SetXY(160, 10);
	$pdf->MultiCell(35,5,utf8_decode('PSPC-100-X-PR-006-FR-001 Revisión: 0
Emisión: 30/05/19
Página: 1 de 1'),1,'L',false);

	$query = "SELECT
			incidencias.iddoc,
			incidencias.proyecto,
			incidencias.cliente,
			incidencias.lugar,
			incidencias.fecha,
			incidencias.hora,
			incidencias.descripcion,
			incidencias.reg,
			incidencias.elaborado,
			incidencias.foto,
			incidencias.materialmenor,
			incidencias.materialmayor,
			incidencias.derramemenor,
			incidencias.derramemayor,
			incidencias.conherido,
			incidencias.sinherido,
			incidencias.vehicularmenor,
			incidencias.vehicularmayor,
			incidencias.fac,
			incidencias.mto,
			incidencias.rwc,
			incidencias.lti,
			incidencias.ftl,
			incidencias.incidente,
			incidencias.eo,
			incidencias.persona,
			incidencias.documento,
			incidencias.sexo,
			incidencias.edad,
			incidencias.nacimiento,
			incidencias.domicilio,
			incidencias.civil,
			incidencias.dpto,
			incidencias.prov,
			incidencias.dist,
			incidencias.cargo,
			incidencias.instruccion,
			incidencias.acciones,
			incidencias.usuario,
			incidencias.seguro,
			incidencias.acciones
	FROM incidencias
	WHERE incidencias.iddoc = '$iddoc'";

	$statement 	= $pdo->prepare($query);
	$statement -> execute(array());
	$results 	= $statement ->fetchAll();
	$rowaffect 	= $statement->rowCount($query);

	foreach ($results as $rs) {
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(45,6,'Proyecto / Sede : ',1);
		$pdf->Cell(80,6,utf8_decode($rs['proyecto']),1);
		$pdf->Cell(10,6,'Cliente',1);
		$pdf->Cell(50,6,utf8_decode($rs['cliente']),1,1);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(185,7,utf8_decode('TIPIFICACIÓN DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL'),0,1,'C');
		$pdf->SetFont('Helvetica','',7);

		$pdf->Rect(10,44,185,70);

		$pdf->SetXY(15,48);
		$pdf->Cell(4,4,$rs['materialmenor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,47);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Daño Material < 500 $"));

		$pdf->SetXY(15,56);
		$pdf->Cell(4,4,$rs['materialmayor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,55);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Daño Material > 500 $"));

		$pdf->SetXY(15,64);
		$pdf->Cell(4,4,$rs['derramemenor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,63);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Derrame de Hidrocarburos < 2 m3"));

		$pdf->SetXY(15,72);
		$pdf->Cell(4,4,$rs['derramemayor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,71);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Derrame de Hidrocarburos > 2 m3"));

		$pdf->SetXY(15,80);
		$pdf->Cell(4,4,$rs['conherido'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,79);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Accidente Vehicular con Herido"));

		$pdf->SetXY(15,88);
		$pdf->Cell(4,4,$rs['sinherido'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,87);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Accidente Vehicular sin Herido"));

		$pdf->SetXY(15,96);
		$pdf->Cell(4,4,$rs['vehicularmenor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,95);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Accidente Vehicular < 500 $"));

		$pdf->SetXY(15,104);
		$pdf->Cell(4,4,$rs['vehicularmayor'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(35,103);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Accidente Vehicular > 500 $"));


		$pdf->SetXY(105,48);
		$pdf->Cell(4,4,$rs['fac'] == "1" ? utf8_decode("X") : "" ,1,1,"C");
		$pdf->SetXY(135,47);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(F.A.C) Caso de Primeros Auxilios"));

		$pdf->SetXY(105,56);
		$pdf->Cell(4,4,$rs['mto'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,55);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(M.T.O) Accidente Con Tratamiento Médico"));

		$pdf->SetXY(105,64);
		$pdf->Cell(4,4,$rs['rwc'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,63);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(R.W.C) Accidente Con Trabajo Restringido"));

		$pdf->SetXY(105,72);
		$pdf->Cell(4,4,$rs['lti'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,71);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(L.T.I) Accidente Con Pérdida de Jornada"));

		$pdf->SetXY(105,80);
		$pdf->Cell(4,4,$rs['ftl'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,79);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(F.T.L) Fatalidad"));

		$pdf->SetXY(105,88);
		$pdf->Cell(4,4,$rs['incidente'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,87);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("Incidente"));

		$pdf->SetXY(105,96);
		$pdf->Cell(4,4,$rs['eo'] == "1" ? utf8_decode("X") : "" ,1,0,"C");
		$pdf->SetXY(135,95);
        $pdf->SetFont('Helvetica','',7);
		$pdf->Cell(70,6,utf8_decode("(E.O) Enfermedad Ocupacional"));

		$pdf->Line(10,120,195,120);
		$pdf->Line(10,174,195,174);
		
		$pdf->SetXY(10,114);
		$pdf->SetFont('Helvetica','I',5);
		$pdf->Cell(180,6,"* Los Accidentes Vehiculares con Herido deberán ser clasificados acorde de la gravedad del daño material ( $ ) y gravedad de la lesión (F.A.C, M.T.O, R.W.C, L.T.I, F.T.L)");
		$pdf->SetFont('Helvetica','B',7);
		$pdf->SetXY(10,120);
		$pdf->Cell(180,6,"LUGAR Y HORA DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL",0,1,'C');

		$pdf->Cell(20,6,'Lugar : ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(80,6,utf8_decode($rs['lugar']),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(10,6,'Fecha:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,date( 'd/m/Y', strtotime($rs['fecha'])),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(10,6,'Hora:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode($rs['hora']),0,1);
		
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(180,6,"LUGAR Y HORA DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL",0,1,'C');
		$pdf->Cell(55,6,'NOMBRE DE LA PERSONA INVOLUCRADA: ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(80,6,utf8_decode($rs['persona']),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'DNI/CE : ',0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(50,6,utf8_decode($rs['documento']),0,1);
		$pdf->Cell(10,6,'SEXO: ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(30,6,utf8_decode($rs['sexo'] = "MA" ? "MASCULINO" : "FEMENINO"),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'EDAD : ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(20,6,utf8_decode($rs['edad']),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'CUENTA CON SEGURO (SI/NO) ESPECIFICAR: ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode($rs['seguro']),0,1);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(45,6,'LUGAR Y FECHA DE NACIMIENTO:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(80,6,utf8_decode($rs['nacimiento']),0,1);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(20,6,'DOMICILIO:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(60,6,utf8_decode(strtoupper($rs['domicilio'])),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(20,6,'ESTADO CIVIL:',0);
		$pdf->SetFont('Helvetica','',7);
		switch ($rs['civil']) {
			case 'CO':
				$pdf->Cell(80,6,'CONVIVIENTE',0,1);
				break;
			case 'CA':
				$pdf->Cell(80,6,'CASADO',0,1);
				break;
			case 'SO':
				$pdf->Cell(80,6,'SOLTERO',0,1);
				break;
			case 'DI':
				$pdf->Cell(80,6,'DIVORCIADO',0,1);
				break;
			case 'VI':
				$pdf->Cell(80,6,'VIUDO',0,1);
				break;
			case 'OT':
				$pdf->Cell(80,6,'OTRO',0,1);
				break;
		}
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(25,6,'DEPARTAMENTO : ',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode(strtoupper($rs['dpto'])),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'PROVINCIA:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode(strtoupper($rs['prov'])),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'DISTRITO:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode(strtoupper($rs['dist'])),0,1);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(15,6,'CARGO:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode($rs['cargo']),0);
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(20,6,'INSTRUCCION:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode($rs['instruccion']),0,1);

		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(180,6,utf8_decode("DESCRIPCIÓN DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL"),0,1,'L');
		$pdf->Cell(180,6,"(Incluyendo nombres y cargos de las personas involucradas)",0,1,'L');

		$pdf->SetFont('Helvetica','',7);
		$pdf->Multicell(185,6,utf8_decode($rs['descripcion']),1,1,false);
		
		$pdf->SetFont('Helvetica','B',7);
		$pdf->Cell(180,6,utf8_decode("ACCIONES INMEDIATAS DESPUES DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL"),0,1,'L');
		$pdf->Cell(180,3,utf8_decode("(Atención médica, evacuación, reparación de daños materiales, acciones correctivas, etc)"),0,1,'L');

		$pdf->SetFont('Helvetica','',7);
		$pdf->Multicell(185,6,utf8_decode($rs['acciones']),1,1,false);

		$pdf->SetFont('Helvetica','B',7);		
		$pdf->Cell(25,6,'ELABORADO POR:',0);
		$pdf->SetFont('Helvetica','',7);
		$pdf->Cell(50,6,utf8_decode($rs['elaborado']),0,1);

		$pdf->SetFont('Helvetica','B',7);		
		$pdf->Cell(25,6,'EVIDENCIA FOTOGRAFICA:',0,1);

		$image = constant("URL").'photos/'.$rs['foto'];
		
		if( isfile($image) ){
			$pdf->Image($image,80,240,50);
		}		
	}

	$filename = "../pdf/".$iddoc.".pdf";

	if (file_exists($filename)) {
		unlink($filename);
	}
	
	$pdf->Output($filename,'F');
	//$pdf->Output();
	if (file_exists($filename) ) {
		echo true;
	}

	function isFile($file) {
        $f = pathinfo($file, PATHINFO_EXTENSION);
        return (strlen($f) > 0) ? true : false;
	}
?>