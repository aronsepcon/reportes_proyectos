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
$objPHPExcel->getProperties()->setTitle("Matriz Reporte Inspecciones Planificadas SSMA"); // Titulo
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
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', 'MATRIZ DE REPORTE INSPECCIONES PLANIFICADAS SSMA');

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
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);

$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);


// Cabecera del cuerpo
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'item');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8', "Proyecto");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D8', 'Fecha de la inspección');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8', 'Área:');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8', 'Ubicación');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', "Inspección realizada por");
$objPHPExcel->setActiveSheetIndex()->setCellValue('H8', "Tipo de inspección");
$objPHPExcel->setActiveSheetIndex()->setCellValue('I8', "Condición o Acto subestandar");
$objPHPExcel->setActiveSheetIndex()->setCellValue('J8', "Descripción del acto u codición subestandra encontrado");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8', "Evidencia de lo encontrado \n (Registro,imagen i foto,otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L8', "Acción correctiva");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M8', "Clasificación");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N8', "Dias de implementación");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O8', "Fecha de implementación");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P8', "Responsable de la ejecución");

$objPHPExcel->setActiveSheetIndex()->setCellValue('Q8', "Evidencia de la acción correctiva implementada \n  (Registro,imagen i foto,otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R8', "Estado de la correción");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S8', "Comentarios finales");
$objPHPExcel->setActiveSheetIndex()->setCellValue('T8', "Registro");


//aca iran los datos de la tabla
$fila = 9;
$item = 1;
$sql = "SELECT
detseguridad.idreg,
detseguridad.iddoc,
IF(detseguridad.tipo = 1 ,'Acto Subestándar','Condicion Subestándar') AS tipoObservacion,
detseguridad.condicion,
detseguridad.clasificacion,
detseguridad.accion AS accion,
detseguridad.fecha AS fechaCumplimiento,
detseguridad.seguimiento,
inspeccion_tipo.nombre AS tipo,
seguridad.sede,
seguridad.lugar,
seguridad.fecha AS fechaInspeccion,
seguridad.inspeccionado,
seguridad.responsable,
seguridad.obser01,
seguridad.obser02,
seguridad.obser03,
seguridad.reg,
detseguridad.evidencia,
TIMESTAMPDIFF(DAY, seguridad.fecha , detseguridad.fecha) AS diasImplementacion ,
proyectos.nombre AS proyecto ,

seguridad.ubicacion,
area_general.nombre AS area_nombre,
tipo_observacion.nombre AS  tipo_observacion


FROM
detseguridad
INNER JOIN seguridad ON detseguridad.iddoc = seguridad.iddoc
INNER JOIN general AS proyectos ON seguridad.sede = proyectos.cod 
INNER JOIN area_general ON seguridad.idAreaObservada= area_general.id
INNER JOIN tipo_observacion ON detseguridad.tipo = tipo_observacion.id
INNER JOIN inspeccion_tipo ON inspeccion_tipo.id = seguridad.tipo

WHERE
proyectos.clase = '00' AND
seguridad.reg >= '$fecha_inicio'  AND  
seguridad.reg < DATE_ADD('$fecha_fin',INTERVAL 1 DAY)  AND $sedeSQL

ORDER BY seguridad.reg DESC";

echo $sql;


$statement = $pdo->prepare($sql);
$statement->execute(array());
$results = $statement->fetchAll();
$rowaffect = $statement->rowCount($sql);

//echo $sql;

$clas = ["", "A", "B", "C"];

//salida de datos
if ($rowaffect > 0) {
    foreach ($results as $rs) {
        //$tipo = $rs['tipo'] == "1" ? "PLANEADA" : "NO PLANEADA";

        $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, $item);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['proyecto']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, date("d/m/Y", strtotime($rs['fechaInspeccion'])));

        $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, $rs['area_nombre']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, $rs['ubicacion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, strtoupper($rs['inspeccionado']));

        $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, $rs['tipoObservacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, $rs['condicion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, '');


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
                        $objDrawing->setCoordinates('K' . $fila);
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

        $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, $rs['accion']);


        $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, $clas[(int)$rs['clasificacion']]);

        if ($rs['clasificacion'] == "01") {

            $objPHPExcel->getActiveSheet()->getStyle('M' . $fila)->getFill()->applyFromArray($backgroundCellRed);
        }
        if ($rs['clasificacion'] == "02") {
            $objPHPExcel->getActiveSheet()->getStyle('M' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);
        }

        if ($rs['clasificacion'] == "03") {
            $objPHPExcel->getActiveSheet()->getStyle('M' . $fila)->getFill()->applyFromArray($backgroundCellGreen);
        }

        $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $rs['diasImplementacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $rs['fechaCumplimiento']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, $rs['responsable']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila, $rs['reg']);



        $fila++;
        $item++;
    }
};

// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B8:S' . $fila)->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Matriz');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/matrizseguridad.xlsx');
exit();
