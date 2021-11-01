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
$objPHPExcel->getProperties()->setTitle("Reporte Inspección Estación de emergencia"); // Titulo
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
$objPHPExcel->getActiveSheet()->getStyle('S4:S7')->applyFromArray($borderCellRight);




// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B2:S3')->applyFromArray($borderCellAll);

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
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', 'Reporte de Inspección estación de emergencia');

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->mergeCells('P2:S3');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P2', "Código: \n Revisión:0 \n Emisión:13/06/2021 \n Página: 1 de 1 ");


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
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);

$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);


// Cabecera del cuerpo
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'item');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8', "Tipo de inspección");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D8', 'Sede');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8', 'Área');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8', 'Lugar de inspección');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', 'Estación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('H8', "Elaborado por");
$objPHPExcel->setActiveSheetIndex()->setCellValue('I8', "Responsable del área");
$objPHPExcel->setActiveSheetIndex()->setCellValue('J8', "fecha");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8', "Descripción");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L8', "Condición");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M8', "Clasificación");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N8', "Acción correctiva");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O8', "Responsable de la acción");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P8', "Fecha de cumplimiento");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q8', "Seguimiento");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R8', "Evidencia");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S8', "Observacion");



//aca iran los datos de la tabla
$fila = 9;
$item = 1;
$sql = "SELECT     
tipo_inspeccion,
idProyecto,
sede, 
area,
lugar_inspeccion,
estacion,
usuario,
usuario_responsable,
fecha,
registro,
pregunta,
condicion,
clasificacion,
accion_correctiva,
usuario_responsable_detalle,
fecha_cumplimiento,
seguimiento,
evidencia,
observacion

FROM view_inspeccion_estacion_emergencia

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
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['tipo_inspeccion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, $rs['sede']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, $rs['area']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, $rs['lugar_inspeccion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, $rs['estacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, strtoupper($rs['usuario']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, strtoupper($rs['usuario_responsable']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, date("d/m/Y", strtotime($rs['registro'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $rs['pregunta']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, valorCondicion($rs['condicion']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, valorCalificacion($rs['clasificacion']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $rs['accion_correctiva']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $rs['usuario_responsable_detalle']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, $rs['fecha_cumplimiento']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Q' . $fila, $rs['seguimiento']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('R' . $fila, $rs['observacion']);

        $evidencia = explode(",", $rs['evidencia']);

        $listaImagenes = '';
        $listaArchivos = '';
        $cantidad = 1;

        foreach ($evidencia as $elemento) {

            if (strlen($elemento) > 0) {

                if( strpos($elemento, '.jpg') > 0 || strpos($elemento, '.png') > 0){
                    
                    $foto = "../../ssma/public/photos/" . $elemento;
                    
                    if ($elemento != '' && file_exists($foto)) {
                        $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(200);
                        $objDrawing = new PHPExcel_Worksheet_Drawing();
                        $objDrawing->setOffsetX(1);
                        $objDrawing->setOffsetY($cantidad);
                        $objDrawing->setCoordinates('Q' . $fila);
                        $objDrawing->setName($elemento);
                        $objDrawing->setDescription(constant("URL") . "photos/" . $elemento);
                        $objDrawing->setPath("../../ssma/public/photos/" . $elemento);
                        $objDrawing->setHeight(50);
                        $objDrawing->setHeight(50);
                        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


                    }
                }
            
            }
            $cantidad += 50;
        }

        $fila++;
        $item++;
    }
};

// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B8:S' . $fila)->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Matriz');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/inspeccionEstacionEmergencia.xlsx');
exit();
