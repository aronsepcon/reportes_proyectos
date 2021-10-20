<?php
require_once("../PHPExcel/PHPExcel.php");
require_once("../inc/constantes.inc.php");
require_once("mysql_conector.inc.php");

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
$objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setTitle("Inspeccion de Seguridad"); // Titulo
$objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
$objPHPExcel->getProperties()->setDescription("Inspeccion Planeada de Seguridad"); //Descripción
$objPHPExcel->getProperties()->setKeywords("Inspeccion Seguridad"); //Etiquetas
$objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

$Titulo = array(
    'font'  => array(
        'bold'  => true,
        'size'  => 14,
        'name'  => 'Verdana'
    )
);

$TituloTabla = array(
    'font'  => array(
        'bold'  => true,
        'size'  => 9,
        'name'  => 'Arial'
    )
);

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//combinar celdas
$objPHPExcel->getActiveSheet()->mergeCells('A3:N3');

//estilo de fuentes
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($Titulo);
$objPHPExcel->getActiveSheet()->getStyle('A5:W5')->applyFromArray($TituloTabla);

//alineacion
$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A5:Z5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Titulo 
$objPHPExcel->getActiveSheet()->setCellValue('A3', 'INSPECCIÓN PLANEADA DE SEGURIDAD');

$objPHPExcel->getActiveSheet()->getStyle('A5:Z2000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$objPHPExcel->getActiveSheet()->getStyle('A5:Z2000')->getAlignment()->setWrapText(true);

//ancho de columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);


//alto de la fila
$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex()->setCellValue('A5', 'ITEM');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'PROYECTO');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'AREA');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'UBICACIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'FECHA DE LA INSPECCIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'INSPECCIÓN REALIZADA POR');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'TIPO DE INSPECCIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('H5', 'CONDICIÓN O ACTO SUBESTANDAR');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'EVIDENCIA DE LO ENCONTRADO (REGISTRO, IMAGEN O FOTO, OTROS)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'ACCIÓN CORRECTIVA');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'CLASIFICACIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'DIAS DE IMPLEMENTACIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('M5', 'FECHA DE IMPLEMENTACIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('N5', 'RESPONSABLE DE LA EJECUCIÓN');
$objPHPExcel->setActiveSheetIndex()->setCellValue('O5', 'EVIDENCIA DE LA ACCIÓN  CORRECTIVA IMPLEMENTADA (REGISTRO, IMAGEN O FOTO)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P5', 'COMENTARIOS ADICIONALES');

$objPHPExcel->setActiveSheetIndex()->setCellValue('Q5', 'Registro');



//aca iran los datos de la tabla
$fila = 6;
$item = 1;

$sql = "SELECT
                    detseguridad.idreg,
                    detseguridad.iddoc,
                    detseguridad.condicion,
                    detseguridad.clasificacion,
                    detseguridad.accion,
                    detseguridad.fecha,
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

$statement = $pdo->prepare($sql);
$statement->execute(array());
$results = $statement->fetchAll();
$rowaffect = $statement->rowCount($sql);

$clas = ["", "A", "B", "C"];

//salida de datos
if ($rowaffect > 0) {
    foreach ($results as $rs) {
        //$tipo = $rs['tipo'] == "1" ? "PLANEADA" : "NO PLANEADA";

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A' . $fila, $rowaffect);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, $rs['proyecto']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['area_nombre']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, $rs['ubicacion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, date("d/m/Y", strtotime($rs['fechaInspeccion'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, strtoupper($rs['inspeccionado']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, $rs['tipo']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, $rs['condicion']);

        $evidencia = explode(",", $rs['evidencia']);


        foreach ($evidencia as $elemento) {
            if (strlen($elemento) > 0) {

                $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,constant("URL") . "photos/" .  $elemento);
                $objPHPExcel->setActiveSheetIndex()->getCell('I' . $fila)->getHyperlink()->setUrl(constant("URL") . "photos/" .  $elemento);
            }
            //$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,constant("URL") . "photos/" .  $elemento);



            /*if (strpos($elemento, '.jpg')!== false || strpos($elemento, '.png') !== false) {
    
                            $foto = "../../ssma/public/photos/" .  $elemento;
    
                            if ( $elemento != '' && file_exists($foto)) {
                                $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(200);
                                $objDrawing = new PHPExcel_Worksheet_Drawing();
                                $objDrawing->setCoordinates('I' . $fila);
                                $objDrawing->setName( $elemento);
                                $objDrawing->setDescription(constant("URL") . "photos/" .  $elemento);
                                $objDrawing->setPath("../../ssma/public/photos/" .  $elemento);
    
                                $objDrawing->setHeight(100);
    
                                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                            }
                        }
                        if (strpos($elemento, '.pdf') !== false) {
                            $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,constant("URL") . "photos/" .  $elemento);
                        }*/
        }






        $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, $rs['accion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $clas[(int)$rs['clasificacion']]);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, $rs['seguimiento']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, date("d/m/Y", strtotime($rs['fecha'])));


        $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, strtoupper($rs['responsable']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, date("d/m/Y", strtotime($rs['reg'])));

        $fila++;
        $item++;
        $rowaffect--;
    }
};
// Renombrar Hoja
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/reposeguridad.xlsx');
exit();
