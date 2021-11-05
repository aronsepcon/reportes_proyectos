<?php
require_once "../PHPExcel/PHPExcel.php";
require_once "mysql_conector.inc.php";
require_once "constantes.inc.php";
require_once "tables.inc.php";
require_once "../words/words.php";

$TODOS_PROYECTOS = 100;


$sede = $_POST['sede'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];


$sedeSQL = "sede <> '$sede'";

if ($sede != $TODOS_PROYECTOS) {
    $sedeSQL = "sede = '$sede'";
}


// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("SEPCON"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("SEPCON"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setTitle("Reporte  Gases Comprimidos"); // Titulo
$objPHPExcel->getProperties()->setSubject("reporte"); //Asunto
$objPHPExcel->getProperties()->setDescription("reporte"); //Descripción
$objPHPExcel->getProperties()->setKeywords("ssma"); //Etiquetas
$objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

$Titulo = array(
    'font' => array(
        'bold' => true,
        'size' => 14,
        'name' => 'Verdana',
    )
);

$subTitulo = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Verdana',
        'color' => array('rgb' => 'FF0000'),
    )
);

$TituloTabla = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Arial',
    )
);

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
$objPHPExcel->getActiveSheet()->getStyle('B8:Q8')->applyFromArray($TituloTabla);


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
$objPHPExcel->getActiveSheet()->getStyle('S4:AF7')->applyFromArray($borderCellRight);




// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B2:AF3')->applyFromArray($borderCellAll);

//LOGO DE LA EMPRESA
$objPHPExcel->getActiveSheet()->mergeCells('B2:C3');
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(50);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setCoordinates('B2');
$objDrawing->setName('nueva imagen');
$objDrawing->setDescription('imagen ');
$objDrawing->setPath("../img/logo.png");
$objDrawing->setHeight(80);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setOffsetX(25);
$objDrawing->setOffsetY(5);


//TITULO DEL REPORTE
$objPHPExcel->getActiveSheet()->mergeCells('D2:O3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', 'Reporte de  Gases Comprimidos');

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->mergeCells('AA2:AF3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AA2', "Código: \n Revisión:0 \n Emisión:13/06/2021 \n Página: 1 de 1 ");


// =====================================CABECERA 2 DEL EXCEL ===================================================


$objPHPExcel->getActiveSheet()->getStyle('B5:G6')->applyFromArray($borderCellAll);

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
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(40);

$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);



$objPHPExcel->getActiveSheet()->mergeCells('B8:B9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'item');
$objPHPExcel->getActiveSheet()->mergeCells('C8:C9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8', 'Sede');
$objPHPExcel->getActiveSheet()->mergeCells('D8:D9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D8', 'Área');
$objPHPExcel->getActiveSheet()->mergeCells('E8:E9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8', 'Elaborado por');
$objPHPExcel->getActiveSheet()->mergeCells('F8:F9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8', "Responsable de la inspección");
$objPHPExcel->getActiveSheet()->mergeCells('G8:G9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', "Fecha");
$objPHPExcel->getActiveSheet()->mergeCells('H8:H9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('H8', "Registro");
$objPHPExcel->getActiveSheet()->mergeCells('I8:I9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I8', "Observaciones");
$objPHPExcel->setActiveSheetIndex()->setCellValue('J8', "Equipos Material para control de derrame	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8', "Bandeja de contención	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L8', "Paños absorventes	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M8', "Trapos industriales	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N8', "Bolsas plásticas	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O8', "Pala");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P8', "Pico");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q8', "Salchichas absorventes	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R8', "Bolsas o sacos de propileno	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S8', "Guantes de nitrilo	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('T8', "Respirador de media cara con filtro para vapores orgánicos	");

$objPHPExcel->getActiveSheet()->mergeCells('U8:W8');
$objPHPExcel->setActiveSheetIndex()->setCellValue('U8', "Otros 1");
$objPHPExcel->getActiveSheet()->mergeCells('X8:Z8');
$objPHPExcel->setActiveSheetIndex()->setCellValue('X8', "Otros 2");
$objPHPExcel->getActiveSheet()->mergeCells('AA8:AC8');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AA8', "Otros 3");
$objPHPExcel->getActiveSheet()->mergeCells('AD8:AF8');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AD8', "Otros 4");




$objPHPExcel->setActiveSheetIndex()->setCellValue('J9', "Cantidad de materiales en cada kit	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K9', "1 equipos moviles	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L9', "10 equipos / 20 estación	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M9', "N.A	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N9', "2 equipos /5 estación	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O9', "1");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P9', "1");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q9', "5 equipos /10 estación	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R9', "N.A	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S9', "2 Pares ( estación), 1 par para equipos moviles	");
$objPHPExcel->setActiveSheetIndex()->setCellValue('T9', "(Solo estación de emergencia 1)	");

$objPHPExcel->getActiveSheet()->mergeCells('U9:W9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('U9', "Otros 1");
$objPHPExcel->getActiveSheet()->mergeCells('X9:Z9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('X9', "Otros 2");
$objPHPExcel->getActiveSheet()->mergeCells('AA9:AC9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AA9', "Otros 3");
$objPHPExcel->getActiveSheet()->mergeCells('AD9:AF9');
$objPHPExcel->setActiveSheetIndex()->setCellValue('AED9', "Otros 4");

//aca iran los datos de la tabla
$fila = 10;
$item = 1;
$sql = "SELECT 
idProyecto,
sede,
area,
usuario,
usuario_responsable,
observacion,
fecha,
registro,
equipo_otros_uno,
cantidad_otros_uno,
equipo_otros_dos,
cantidad_otros_dos,
equipo_otros_tres,
cantidad_otros_tres,
equipo_otros_cuatro,
cantidad_otros_cuatro,

equipo,
bandeja_contencion ,
panos_absorventes ,
trapo_industrial,
bolsa_plastica,
pala,
pico,
salchicha_absorvente,
bolsa_propileno,
guantes_nitrilo,
respirador_media,
otros_uno ,
otros_dos ,
otros_tres ,
otros_cuatro

FROM view_inspeccion_derrame
WHERE
registro >= '$fecha_inicio'  AND  
registro < DATE_ADD('$fecha_fin',INTERVAL 1 DAY)  AND $sedeSQL
ORDER BY registro DESC";


$statement = $pdo->prepare($sql);
$statement->execute(array());
$results = $statement->fetchAll();
$rowaffect = $statement->rowCount($sql);



//salida de datos
if ($rowaffect > 0) {
    foreach ($results as $rs) {


        $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, $item);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['sede']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, $rs['area']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, strtoupper($rs['usuario']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, strtoupper($rs['usuario_responsable']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, date("d/m/Y", strtotime($rs['fecha'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, date("d/m/Y", strtotime($rs['registro'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, $rs['observacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, $rs['equipo']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $rs['bandeja_contencion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, $rs['panos_absorventes']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, $rs['trapo_industrial']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $rs['bolsa_plastica']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $rs['pala']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, $rs['pico']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Q' . $fila, $rs['salchicha_absorvente']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('R' . $fila, $rs['bolsa_propileno']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('S' . $fila, $rs['guantes_nitrilo']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila, $rs['respirador_media']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, $rs['equipo_otros_uno']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('V' . $fila, $rs['cantidad_otros_uno']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('W' . $fila, $rs['otros_uno']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('X' . $fila, $rs['equipo_otros_dos']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Y' . $fila, $rs['cantidad_otros_dos']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Z' . $fila, $rs['otros_dos']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('AA' . $fila, $rs['equipo_otros_tres']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AB' . $fila, $rs['cantidad_otros_tres']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AC' . $fila, $rs['otros_tres']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('AD' . $fila, $rs['equipo_otros_cuatro']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AE' . $fila, $rs['cantidad_otros_cuatro']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AF' . $fila, $rs['otros_cuatro']);

        $fila++;
        $item++;
    }
};

// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B8:AF' . $fila)->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Matriz');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/inspeccionDerrame.xlsx');
exit();
