<?php
require_once "../PHPExcel/PHPExcel.php";
require_once "mysql_conector.inc.php";
require_once "constantes.inc.php";
require_once "tables.inc.php";
require_once "../words/words.php";


$TODOS_PROYECTOS = 100;

$sede = $_POST['sede'];
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];


$sedeSQL = "idProyecto <> '$sede'";

if ($sede != $TODOS_PROYECTOS) {
    $sedeSQL = "idProyecto = '$sede'";
}


// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("SEPCON"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("SEPCON"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setTitle("Matriz Reporte OPT"); // Titulo
$objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
$objPHPExcel->getProperties()->setDescription("Matriz Reporte OPT"); //Descripción
$objPHPExcel->getProperties()->setKeywords("OPT"); //Etiquetas
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
$objPHPExcel->getActiveSheet()->getStyle('Q4:Q7')->applyFromArray($borderCellRight);




// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('B2:Q3')->applyFromArray($borderCellAll);

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
$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', 'MATRIZ DE REPORTE OBSERVACIONES PLANEADAS DE TRABAJO - OPT');

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
$objPHPExcel->getActiveSheet()->mergeCells('P2:Q3');
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

$objPHPExcel->getActiveSheet()->getStyle('I4:I7')->applyFromArray($borderCellLeft);

$objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('I4', 'Tipo de Hallazgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'A I     -  Acto Inseguro o Sub Estándar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I6', 'C A P   -  Casi Accidente Personal');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I7', 'C A A   -  Casi Accidente Ambiental');

$objPHPExcel->getActiveSheet()->getStyle('J4:J7')->applyFromArray($borderCellRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'C I  -  Condición Insegura o Sub Estándar');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J6', 'C A V   -  Casi Accidente Vehicular');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J7', 'Otros');

$objPHPExcel->getActiveSheet()->getStyle('K4:K7')->applyFromArray($borderCellRight);

$objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($subTitulo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K4', 'Nivel del Riesgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'A  -  Alto');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K6', 'B  -  Medio');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K7', 'C  -  Bajo');


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

$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(50);


// Cabecera del cuerpo
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8', 'ITEM');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8', "Código \n de la obra");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D8', 'Fecha');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8', 'Reportado por:');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8', 'Tipo de hallazgo');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8', "CONDICIÓN O \n ACTO SUBESTANDAR");
$objPHPExcel->setActiveSheetIndex()->setCellValue('H8', "Descripción de la \n Observación / Casi Accidente");
$objPHPExcel->setActiveSheetIndex()->setCellValue('I8', "UBICACIÓN DEL \n HALLAZGO");
$objPHPExcel->setActiveSheetIndex()->setCellValue('J8', "Evidencia de la \n observación \n (registro, imagen u otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8', "Nivel del Riesgo");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L8', "Acción correctiva");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M8', "Responsable");
$objPHPExcel->setActiveSheetIndex()->setCellValue('N8', "DIAS DE IMPLEMENTACION");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O8', "Evidencia de la acción \n implementada \n (registro, imagen u otros)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P8', "Fecha de levantamiento de la \n Observacion");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q8', "Estado de la observacion");


//aca iran los datos de la tabla
$fila = 9;



$query = "SELECT
    id ,
    usuario_nombres ,
    usuario_apellidos ,
    proyecto_nombre ,
    area_nombre ,
    ubicacion,
    area_observada_nombre,
    tiempo_proyecto,
    fecha ,
    registro ,
    nombre ,
    tiempo_trabajo,
    guardia,
    ocupacion ,
    tarea ,
    razon_opt ,
    oportunidades ,
    opt_resultados ,
    firma_gerente ,
    area  
    FROM view_opt WHERE fecha >= '$fechaInicio'  AND  fecha <  DATE_ADD('$fechaFin',INTERVAL 1 DAY) AND $sedeSQL ORDER BY fecha desc ";

    $statement = $pdo->prepare($query);
    $statement->execute(array());
    $results = $statement->fetchAll();
    $rowaffect = $statement->rowCount($query);




    
    foreach ($results as $rs) {




        // VAMOS HACER UN MERGE CELDA DE LA CANTIDAD MAYOR DE LOS CONTADORES ANTERIORES
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $rowaffect);
        
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $rs['proyecto_nombre']);
        
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $rs['fecha'] );

        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,  $rs['usuario_nombres']." ".$rs['usuario_apellidos']);


        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $rs['razon_opt'] );

        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, '');



        

        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,  $rs['ubicacion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,  '');

        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,  '');




        
        $id_documento=$rs['id'];
        
        // PRIMERO VAMOS A TRAER TODAS LAS OBSREVACIONES , OBSERVADORES Y RECOMENDACIONES QUE ESTEN RELACIONADOS A UN DOCUMENTO


        //OBSERVACION
        $query_observacion="SELECT id,pasos,observaciones FROM optobservacion WHERE idOpt=  $id_documento ";

        echo $query_observacion;

        $statement = $pdo->prepare($query_observacion);
        $statement->execute(array());
        $results_observacion = $statement->fetchAll();

        $data_observacion="";
        $data2_observacion="";
        $contador=1;


        foreach($results_observacion as $rs_observacion){

            $data_observacion.= ( $contador .". ".$rs_observacion['pasos'] ." \n \n \n");
            $data2_observacion.=($contador .". ". $rs_observacion['observaciones']."  \n \n \n");
            $contador++;
        }

        //DESCRIPCION DE LA OBSERVACION
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,  $data_observacion." \n" .$data2_observacion);






        //RECOMENDACIONES

        $query_recomendaciones="SELECT id,acciones,responsable,fecha FROM optrecomendaciones WHERE idOpt= $id_documento ";

        $statement = $pdo->prepare($query_recomendaciones);
        $statement->execute(array());
        $results_recomendaciones = $statement->fetchAll();

        $data_recomendacion="";
        $data1_recomendacion="";
        $data2_recomendacion="";

        $contador=1;

        foreach($results_recomendaciones as $rs_recomendaciones){
           
            $data_recomendacion.= ( $contador .". ".$rs_recomendaciones['acciones'] ." \n \n \n");
            $data1_recomendacion.=($contador .". ". $rs_recomendaciones['responsable']."  \n \n \n");
            $data2_recomendacion.=($contador .". ". $rs_recomendaciones['fecha']."  \n \n \n");

            $contador++;
        }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila,$data_recomendacion ."\n".$data2_recomendacion);
          
            $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila,$data1_recomendacion );


        $fila++;
        $rowaffect--;

    };


// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('B8:Q'.$fila)->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('MATRIZ de IPERC');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/matrizopt.xlsx');
exit();
