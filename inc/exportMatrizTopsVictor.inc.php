<?php
require_once "../PHPExcel/PHPExcel.php";
require_once "mysql_conector.inc.php";
require_once "constantes.inc.php";
require_once "tables.inc.php";
require_once "../words/words.php";

/*$mes = $_POST['me'];
$anio = $_POST['an'];*/
$TODOS_PROYECTOS = 100;

$sede = $_POST['sede'];
$fechaInicio=$_POST['fecha_inicio'];
$fechaFin=$_POST['fecha_fin'];


$sedeSQL = "sede <> '$sede'";

if($sede!= $TODOS_PROYECTOS){
    $sedeSQL = "sede = '$sede'";
}

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("SEPCON"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("SEPCON"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setSubject("reporte"); //Asunto
$objPHPExcel->getProperties()->setDescription("reporte"); //Descripción
$objPHPExcel->getProperties()->setKeywords("ssma"); //Etiquetas
$objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

$Titulo = array(
    'font' => array(
        'bold' => true,
        'size' => 14,
        'name' => 'Verdana',
    ));

$subTitulo = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Verdana',
        'color' => array('rgb' => 'FF0000'),
    ));

$TituloTabla = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Arial',
    ));

$borderCellOutLine = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$borderCellTop = array(
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$borderCellBottom = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$borderCellRight = array(
    'borders' => array(
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$borderCellLeft = array(
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$borderCellAll = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF',
    ),
));

$backgroundCellRed = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FF0000',
    ),
);

$backgroundCellYellowLight = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFF00',
    ),
);

$backgroundCellGreen = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => '00DD00',
    ),
);

//estilo de fuentes
$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($Titulo);
$objPHPExcel->getActiveSheet()->getStyle('B8:R8')->applyFromArray($TituloTabla);


//Alineación de todos las celdas centradas
$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B2:Z2000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2:Z2000')->getAlignment()->setWrapText(true);


//Alineación de la seccion de leyenda de acronimos
$objPHPExcel->getActiveSheet()->getStyle('I4:K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('I4:K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->getStyle('I4:K7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('I4:K7')->getAlignment()->setWrapText(true);




// Bordes que faltaban completar a los costado del reporte
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($borderCellLeft);
$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($borderCellLeft);
$objPHPExcel->getActiveSheet()->getStyle('R4:R7')->applyFromArray($borderCellRight);




// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B2:R3')->applyFromArray($borderCellAll);

//LOGO DE LA EMPRESA
$objPHPExcel->getActiveSheet()->mergeCells('B2:C3');
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(50);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setCoordinates('B2');
$objDrawing->setName('nueva imagen');
$objDrawing->setDescription( 'imagen ');
$objDrawing->setPath("../img/logo.png");
$objDrawing->setHeight(80);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setOffsetX(25);                            
$objDrawing->setOffsetY(5); 


//TITULO DEL REPORTE
$objPHPExcel->getActiveSheet()->mergeCells('D2:O3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', "Control de Observaciones Preventivas  ( TOP's )");

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->mergeCells('P2:R3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P2', "PSPC-110-X-PR-002-FR-002 \n Revisión : 0 \n Emisión: 31/05/2019 \n Pagina :1 de 1 ");


// =====================================CABECERA 2 DEL EXCEL ===================================================


$objPHPExcel->getActiveSheet()->getStyle('B4:G6')->applyFromArray($borderCellAll);



$objPHPExcel->getActiveSheet()->mergeCells('B4:C4');
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B4', 'FECHA / PERIODO');

$objPHPExcel->getActiveSheet()->mergeCells('D4:G4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D4', $fechaInicio.' al '.$fechaFin);


$objPHPExcel->getActiveSheet()->mergeCells('B5:C5');
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'SEDE/PROYECTO:');

$objPHPExcel->getActiveSheet()->mergeCells('D5:G5');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'HUDBAY/PROYECTO 20PP03 - NUEVA LÍNEA DE RELAVES ESTE - TMF');

$objPHPExcel->getActiveSheet()->mergeCells('B6:C6');
$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B6', 'ELABORADO POR:');

$objPHPExcel->getActiveSheet()->mergeCells('D6:G6');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D6', 'SSMA');

$objPHPExcel->getActiveSheet()->getStyle('J4:J7')->applyFromArray($borderCellLeft);

$objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J4', 'Tipo de Hallazgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'A I     -  Acto Inseguro o Sub Estándar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J6', 'C A P   -  Casi Accidente Personal');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J7', 'C A A   -  Casi Accidente Ambiental');

$objPHPExcel->getActiveSheet()->getStyle('K4:K7')->applyFromArray($borderCellRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'C I  -  Condición Insegura o Sub Estándar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K6', 'C A V   -  Casi Accidente Vehicular');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K7', 'Otros');

$objPHPExcel->getActiveSheet()->getStyle('L4:L7')->applyFromArray($borderCellRight);

$objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L4', 'Nivel del Riesgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'A  -  Alto');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L6', 'B  -  Medio');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L7', 'C  -  Bajo');


// =====================================CUERPO DEL EXCEL ===================================================


//ancho de columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);

$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);


// Cabecera del cuerpo
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'ITEM');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8', "Código \n de la obra");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D8', 'Fecha');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8', 'Reportado por:');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8', 'Tipo de hallazgo');
//$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', "CONDICIÓN O \n ACTO SUBESTANDAR");
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', "Descripción de la \n Observación / Casi Accidente");

$objPHPExcel->setActiveSheetIndex()->setCellValue('H8', "Clasificación de observación");
$objPHPExcel->setActiveSheetIndex()->setCellValue('I8', "Sub clasificación");

$objPHPExcel->setActiveSheetIndex()->setCellValue('J8', "UBICACIÓN DEL \n HALLAZGO");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8', "Evidencia de la \n observación \n (registro, imagen u otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L8', "Nivel del Riesgo");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M8', "Acción correctiva");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N8', "Responsable");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O8', "DIAS DE IMPLEMENTACION");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P8', "Evidencia de la acción \n implementada \n (registro, imagen u otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q8', "Fecha de levantamiento de la \n Observacion");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R8', "Estado de la observacion");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S8', "Registro");


//aca iran los datos de la tabla
$fila = 9;
$item=1;
$query = "SELECT 
tops.idtop AS idtop,
tops.lugar AS lugar,
CONCAT(tabla_aquarius.nombres,' ',tabla_aquarius.apellidos) AS reportado,
tops.fecha AS fecha,
tops.observacion AS observacion,
tops.actins AS actins,
tops.conins AS conins,
tops.actseg AS actseg,
tops.relacion AS relacion,
tops.descripcion AS descripcion,
tops.medidas AS medidas,
tops.potencial AS potencial,
tops.reg AS reg,
tops.conepp AS conepp,
tops.tipepp AS tipepp,
tops.otros AS otros,
tops.area AS area,
tops.foto AS foto,
tops.iduser AS iduser,
tops.sede AS sede,
tops.observado_lugar AS observado_lugar,
tops.observado_puesto AS observado_puesto,
tops.idproyectodetalle AS idproyectodetalle,
tiempo_proyecto.id AS idobservado_tiempo,
tiempo_proyecto.nombre AS tiempo_proyecto,
horario_observacion.id AS idobservado_hora,
horario_observacion.nombre AS horario_observacion,
rango_edad.id AS idobservado_edad,
rango_edad.nombre AS rango_edad,
lesion.id AS idobservado_lesion,
lesion.nombre AS lesion,
obstaculo.id AS idobservado_obstaculo,
obstaculo.nombre AS obstaculo,
tops.observado_cambio AS observado_cambio,
tops.observado_retroalimentacion AS observado_retroalimentacion,
tops.observado_reincidente AS observado_reincidente,
tops.observado_comentario AS observado_comentario,
area_general.nombre AS area_nombre,
tabla_aquarius.dni AS dni,
tops.url_pdf AS url_pdf,
tops.reg AS registro
        

FROM
ssma.tops

JOIN (SELECT ssma.area_general.id,ssma.area_general.nombre FROM ssma.area_general) AS area_general ON ssma.tops.idproyectodetalle = area_general.id
JOIN (SELECT ssma.tiempo_proyecto.id,ssma.tiempo_proyecto.nombre FROM ssma.tiempo_proyecto) AS tiempo_proyecto ON ssma.tops.idobservado_tiempo = tiempo_proyecto.id
JOIN (SELECT ssma.horario_observacion.id,ssma.horario_observacion.nombre FROM ssma.horario_observacion) AS horario_observacion ON ssma.tops.idobservado_hora = horario_observacion.id
JOIN (SELECT ssma.rango_edad.id,ssma.rango_edad.nombre FROM ssma.rango_edad) AS rango_edad ON ssma.tops.idobservado_edad = rango_edad.id
JOIN (SELECT ssma.lesion.id,ssma.lesion.nombre FROM ssma.lesion) AS lesion ON ssma.tops.idobservado_lesion = lesion.id
JOIN (SELECT ssma.obstaculo.id,ssma.obstaculo.nombre FROM ssma.obstaculo) AS obstaculo ON ssma.tops.idobservado_obstaculo = obstaculo.id
JOIN (SELECT rrhh.tabla_aquarius.usuario,rrhh.tabla_aquarius.apellidos,rrhh.tabla_aquarius.nombres,rrhh.tabla_aquarius.dni FROM rrhh.tabla_aquarius) AS tabla_aquarius ON ssma.tops.iduser = tabla_aquarius.usuario


                    WHERE tops.reg >= '$fechaInicio'  AND  tops.reg <  DATE_ADD('$fechaFin',INTERVAL 1 DAY) AND $sedeSQL
                        
                        ORDER BY
                        tops.reg DESC";

$statement = $pdo->prepare($query);
$statement->execute(array());
$results = $statement->fetchAll();
$rowaffect = $statement->rowCount($query);

$salida = "";

$sede = master($pdo, "00");
$obser = master($pdo, "01");
$relac = master($pdo, "02");

$actins = master($pdo, "06");
$conins = master($pdo, "07");
$acseg = master($pdo, "08");

$tipo = master($pdo, "03");
$condicion = master($pdo, "04");
$potencial = master($pdo, "05");
$area = master($pdo, "09");


//Add filters
$objPHPExcel->getActiveSheet()->setAutoFilter('B'.($fila - 1).':R'.($fila+$rowaffect));



//salida de datos
foreach ($results as $rs) {
    $rel = $rs['relacion'] != "00" ? $relac[(int) $rs['relacion']] : "OTROS";
    $tip = $rs['tipepp'] != "00" ? $tipo[(int) $rs['tipepp']] : "";
    $con = $rs['conepp'] != "00" ? $condicion[(int) $rs['conepp']] : "";
    $pot = $rs['potencial'] != "00" ? $potencial[(int) $rs['potencial']] : "";
    $are = $rs['area'] != "00" ? $area[(int) $rs['area']] : "";

    $observacion_detalle = "";
    if ($rs['actins'] != "00") {

        $observacion_detalle = $actins[(int) $rs['actins']];
    } elseif ($rs['conins'] != "00") {

        $observacion_detalle = $conins[(int) $rs['conins']];
    } elseif ($rs['actseg'] != "00") {

        $observacion_detalle = $acseg[(int) $rs['actseg']];
    }

    $observado_cambio = $rs['observado_cambio'] == '1' ? 'Si' : 'No';
    $observado_retroalimentacion = $rs['observado_retroalimentacion'] == '1' ? 'Si' : 'No';
    $observado_reincidente = $rs['observado_reincidente'] == '1' ? 'Si' : 'No';

$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila,$rowaffect);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila,$sede[(int) $rs['sede']]);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,date("d/m/Y", strtotime($rs['fecha'])));
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,$rs['reportado']);
//$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,tipoDeHallazgo($rs['observacion']));




$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,getObservacion($rs['observacion']) );
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,$rs['descripcion']);

$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,$observacion_detalle);

if($observacion_detalle == 'Desvío / Incumplimiento del procedimiento'){
    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,"No se cumple \n No se entiende \n No se conoce \n No existe");

}


$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,$rs['observado_lugar']);


$foto = "../../ssma/public/photos/".$rs['foto'];

if ( $rs['foto'] != '' && file_exists($foto)) {

$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(50);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setCoordinates('K'.$fila);
$objDrawing->setName("http://ssma.sepcon.net/ssma/public/photos/".$rs['foto']);
$objDrawing->setDescription( constant("URL")."photos/".$rs['foto']);
$objDrawing->setPath("../../ssma/public/photos/".$rs['foto']);

$objDrawing->setHeight(50);

$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


}




$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,nivelDeRiesgo($rs['potencial']));



if($rs['potencial']=="01"){

    $objPHPExcel->getActiveSheet()->getStyle('L' . $fila)->getFill()->applyFromArray($backgroundCellRed);

}
if($rs['potencial']=="02"){
    $objPHPExcel->getActiveSheet()->getStyle('L' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

}

if($rs['potencial']=="03"){
    $objPHPExcel->getActiveSheet()->getStyle('L' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

}

$objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,$rs['medidas']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila,'');
$objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,'');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$fila,'');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$fila,'');
$objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$fila,'');
$objPHPExcel->setActiveSheetIndex()->setCellValue('S'.$fila,date("d/m/Y", strtotime($rs['reg'])));


$fila++; 
$item++; 
$rowaffect--;              
};





// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B8:R'.$fila)->applyFromArray($borderCellAll);





// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Matriz');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/matriztops.xlsx');
exit();
