<?php
require_once "../PHPExcel/PHPExcel.php";
require_once "mysql_conector.inc.php";
require_once "constantes.inc.php";
require_once "tables.inc.php";
require_once "../words/words.php";

$mes = $_POST['me'];
$anio = $_POST['an'];

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setTitle("Matriz Tops"); // Titulo
$objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
$objPHPExcel->getProperties()->setDescription("Reporte de IPERC"); //Descripción
$objPHPExcel->getProperties()->setKeywords("IPERC"); //Etiquetas
$objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

$Titulo = array(
    'font' => array(
        'bold' => true,
        'size' => 22,
        'name' => 'Cambria',
    ));

$subTitulo = array(
    'font' => array(
        'bold' => true,
        'size' => 12,
        'name' => 'Cambria',
        /* 'color' => array('rgb' => 'FF0000'),*/
    ));

$TituloTabla = array(
    'font' => array(
        'bold' => true,
        'size' => 14,
        'name' => 'Cambria',
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

$objPHPExcel->getActiveSheet()->getStyle('A1:AB100')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF',
    ),
));

//estilo de fuentes
$objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($Titulo);
$objPHPExcel->getActiveSheet()->getStyle('B12:AB12')->applyFromArray($TituloTabla);

//Alineación de todos las celdas centradas
$objPHPExcel->getActiveSheet()->getStyle('A1:AB100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:AB100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B2:AB2000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B2:AB2000')->getAlignment()->setWrapText(true);

//Alineación de la seccion de leyenda de acronimos
$objPHPExcel->getActiveSheet()->getStyle('Z2:AB4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('Z2:AB4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->getStyle('Z2:AB4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('Z2:AB4')->getAlignment()->setWrapText(true);

//Alineación de la seccion de leyenda de acronimos
$objPHPExcel->getActiveSheet()->getStyle('J6:AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('J6:AB8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->getStyle('J6:AB8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('J6:AB8')->getAlignment()->setWrapText(true);



// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B2:AB4')->applyFromArray($borderCellAll);

//LOGO DE LA EMPRESA
$objPHPExcel->getActiveSheet()->mergeCells('B2:D4');
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(50);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setCoordinates('B2');
$objDrawing->setName('nueva imagen');
$objDrawing->setDescription('imagen ');
$objDrawing->setPath("../img/logo.png");
$objDrawing->setHeight(80);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setOffsetX(50);
$objDrawing->setOffsetY(5);

//TITULO DEL REPORTE
$objPHPExcel->getActiveSheet()->mergeCells('E2:Y4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E2', 'Control de Observaciones Preventivas');

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->mergeCells('Z2:AB4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Z2', "PSPC-110-X-PR-002-FR-002 \n Revisión:1  \n Emisión:10/06/2021 \n Página: 1 de 1 ");

// =====================================CABECERA 2 DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B6:I8')->applyFromArray($borderCellAll);

$objPHPExcel->getActiveSheet()->mergeCells('B6:C6');
$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B6', 'Lugar/Obra:');
$objPHPExcel->getActiveSheet()->mergeCells('D6:I6');

$objPHPExcel->getActiveSheet()->mergeCells('B7:C7');
$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B7', 'Responsable SSMA:');
$objPHPExcel->getActiveSheet()->mergeCells('D7:I7');

$objPHPExcel->getActiveSheet()->mergeCells('B8:C8');
$objPHPExcel->getActiveSheet()->getStyle('B8')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'Fecha / Período:');
$objPHPExcel->getActiveSheet()->mergeCells('D8:I8');

$objPHPExcel->getActiveSheet()->getStyle('J6:AB6')->applyFromArray($borderCellTop);
$objPHPExcel->getActiveSheet()->mergeCells('J8:AB8');
$objPHPExcel->getActiveSheet()->getStyle('J8:AB8')->applyFromArray($borderCellBottom);
$objPHPExcel->getActiveSheet()->getStyle('AB6:AB8')->applyFromArray($borderCellRight);

$objPHPExcel->getActiveSheet()->mergeCells('J6:M6');
$objPHPExcel->getActiveSheet()->getStyle('J6')->applyFromArray($subTitulo);

$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(30);

$objPHPExcel->setActiveSheetIndex()->setCellValue('J6', 'Tipo de Observación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J7', 'A I   -  Acto Inseguro o Sub Estándar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('M7', 'C I  -  Condición Insegura o Sub Estándar');

$objPHPExcel->getActiveSheet()->mergeCells('Y6:Y7');
$objPHPExcel->getActiveSheet()->getStyle('Y6')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Y6', 'Nivel del  Riesgo:');
$objPHPExcel->getActiveSheet()->mergeCells('Z6:Z7');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Z6', "A  -  Alto \nB  -  Medio \nC  -  Bajo");

// =====================================CUERPO DEL EXCEL ===================================================

//ancho de columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(100);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(15);

//alto de la fila

// Agregar Informacion

$objPHPExcel->setActiveSheetIndex()->setCellValue('B12', 'ID');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C12', 'Reportado por');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D12', 'Proyecto');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E12', 'Área');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F12', 'Ubicación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G12', 'Área observada');
$objPHPExcel->setActiveSheetIndex()->setCellValue('H12', 'Puesto del observado');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I12', 'Tiempo en el proyecto');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J12', 'Horario');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K12', 'Rango de edad');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L12', 'Fecha');
$objPHPExcel->setActiveSheetIndex()->setCellValue('M12', 'Tipo de observación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('N12', 'Detalle del Tipo de Observación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('O12', 'Relacionado con');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P12', 'Otros');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q12', 'Tipo Epp');
$objPHPExcel->setActiveSheetIndex()->setCellValue('R12', 'Condición del epp');
$objPHPExcel->setActiveSheetIndex()->setCellValue('S12', 'Descripción de la Observación Acto o condición/Casi Accidente');
$objPHPExcel->setActiveSheetIndex()->setCellValue('T12', 'Acción Inmediata (correctiva)/Que medidas correctivas se tomaron para eliminar el acto o condición sub estandar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('U12', 'Potencial del Riesgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('V12', 'Evidencia de la observación/caso accidente encontrado(registro,imagen o foto,otros)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('W12', 'Lesión / Obstaculo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('X12', '¿Se Realizó La Retro Alimentación?');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Y12', '¿Se  Logró El Cambio?');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Z12', '¿Personal Reincidente?');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AA12', 'Comentario');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AB12', 'DNI');

//aca iran los datos de la tabla
$fila = 13;

$query = "SELECT
                    idtop,
                    lugar,
                    reportado,
                    fecha,
                    observacion,
                    actins,
                    conins,
                    actseg,
                    relacion,
                    descripcion,
                    medidas,
                    potencial,
                    reg,
                    conepp,
                    tipepp,
                    otros,
                    area,
                    foto,
                    iduser,
                    sede,
                    observado_lugar,
                    observado_puesto,
                    tiempo_proyecto,
                    horario_observacion,
                    rango_edad,
                    lesion,
                    obstaculo,
                    observado_cambio ,
                    observado_retroalimentacion,
                    observado_reincidente,
                    observado_comentario,
                    area_nombre,
                    dni

                    FROM
                    view_tops


                    WHERE MONTH(reg) = $mes AND
                        YEAR(reg) = $anio
                        ORDER BY
                        view_tops.reg DESC";

$statement = $pdo->prepare($query);
$statement->execute(array());
$results = $statement->fetchAll();

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

$idRow = 1;

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

    $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, $idRow);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['reportado']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, $sede[(int) $rs['sede']]);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, $rs['area_nombre']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, $rs['observado_lugar']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, $are);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, $rs['observado_puesto']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, $rs['tiempo_proyecto']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, $rs['horario_observacion']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $rs['rango_edad']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, date("d/m/Y", strtotime($rs['fecha'])));

    $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, getObservacion($rs['observacion']));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $observacion_detalle);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $rel);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, $rs['otros']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q' . $fila, $tip);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R' . $fila, $con);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('S' . $fila, $rs['descripcion']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila, $rs['medidas']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, $pot);

    $foto = "../../ssma/public/photos/" . $rs['foto'];

    if ($rs['foto'] != '' && file_exists($foto)) {
        $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(50);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setCoordinates('V' . $fila);
        $objDrawing->setName($rs['foto']);
        echo $foto;
        $objDrawing->setDescription(constant("URL") . "photos/" . $rs['foto']);
        $objDrawing->setPath("../../ssma/public/photos/" . $rs['foto']);


        $objDrawing->setHeight(50);

        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
    }

    $objPHPExcel->setActiveSheetIndex()->setCellValue('W' . $fila, $rs['lesion'] ." / " .$rs['obstaculo']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('X' . $fila, $observado_retroalimentacion);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Y' . $fila, $observado_cambio);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Z' . $fila, $observado_reincidente);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AA' . $fila, $rs['observado_comentario']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AB' . $fila,$rs['dni'] );

    $idRow++;
    $fila++;
}

// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B12:AB'.$fila)->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Matriz de Tops');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/topsnuevo.xlsx');
exit();
