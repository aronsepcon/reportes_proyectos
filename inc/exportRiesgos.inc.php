<?php
    require_once("../PHPExcel/PHPExcel.php");
    require_once("mysql_conector.inc.php");
    require_once("constantes.inc.php");
    require_once("tables.inc.php");
    require_once("../words/words.php");


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
    $objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
    $objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
    $objPHPExcel->getProperties()->setTitle("Reporte IPER"); // Titulo
    $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
    $objPHPExcel->getProperties()->setDescription("Reporte de Riesgos Críticos"); //Descripción
    $objPHPExcel->getProperties()->setKeywords("Riesgos Críticos"); //Etiquetas
    $objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

    $Titulo = array(
        'font' => array(
            'bold' => true,
            'size' => 14,
            'name' => 'Verdana',
        ));

    $TituloTabla = array(
        'font' => array(
            'bold' => true,
            'size' => 9,
            'name' => 'Arial',
        ));

    // Crea un nuevo objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    //combinar celdas
    $objPHPExcel->getActiveSheet()->mergeCells('B3:U3');

    //estilo de fuentes
    $objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($Titulo);
    $objPHPExcel->getActiveSheet()->getStyle('B5:ZZ5')->applyFromArray($TituloTabla);


    //alineacion
    $objPHPExcel->getActiveSheet()->getStyle('B3:ZZ3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B5:ZZ5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Titulo
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Reporte de riesgos críticos');

    $objPHPExcel->getActiveSheet()->getStyle('B5:ZZ5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    $objPHPExcel->getActiveSheet()->getStyle('B5:ZZ5')->getAlignment()->setWrapText(true);

    //ancho de columnas

    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(2,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(3,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(4,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(5,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(6,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(7,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(8,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(9,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(10,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(11,5)->setAutoSize(true);           
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(12,5)->setAutoSize(true);           


    
    $objPHPExcel->setActiveSheetIndex()->getColumnDimensionByColumn(251,5)->setAutoSize(true);           
    $objPHPExcel->setActiveSheetIndex()->getColumnDimensionByColumn(252,5)->setAutoSize(true);           
    $objPHPExcel->setActiveSheetIndex()->getColumnDimensionByColumn(253,5)->setAutoSize(true);           



    for ($i=13 ; $i<251;$i++){

        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($i,5)->setAutoSize(true);

    }

    //alto de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

    // Agregar Informacion

    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(2,5, 'Orden');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(3,5,'Elaborado por');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(4,5, 'Proyecto');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(5,5, 'Área');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(6,5, 'Ubicación');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(7,5,'Área observada');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(8,5,'Tarea');

    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(9,5, 'Líder');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(10,5,'Participantes');

    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(11,5, 'Empresa');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(12,5,'Fecha');

    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(251,5, 'Fortalezas /acciones a tomar ');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(252,5,'Fecha de cumplimiento');
    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(253,5,'Responsable');

    $contador=1;
    $init=13;

    for ($i=1 ; $i<120;$i++){

        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow($init,5, constant("RIESGOS_CRITICOS_".$i));
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(($init+1),5, "Comentario");


        $init+=2;
    }

    


    //aca iran los datos de la tabla
    $fila = 6;

    $query = "	SELECT	id,
    usuario_nombres,
    usuario_apellidos,
    proyecto_nombre,
    area_nombre,
    area_observada_nombre,
    ubicacion,
    tarea_auditada ,
    lider_auditoria,
    participantes,
    empresa,
    fecha ,
riesgo11 , 
riesgo11_comments , 
riesgo12 , 
riesgo12_comments , 
riesgo13 , 
riesgo13_comments , 
riesgo14 , 
riesgo14_comments , 
riesgo15 , 
riesgo15_comments , 
riesgo16 , 
riesgo16_comments , 
riesgo17 , 
riesgo17_comments , 
riesgo21 , 
riesgo21_comments , 
riesgo22 , 
riesgo22_comments , 
riesgo23 , 
riesgo23_comments , 
riesgo24 , 
riesgo24_comments , 
riesgo25 , 
riesgo25_comments , 
riesgo26 , 
riesgo26_comments , 
riesgo27 , 
riesgo27_comments , 
riesgo28 , 
riesgo28_comments , 
riesgo31 , 
riesgo31_comments , 
riesgo32 , 
riesgo32_comments , 
riesgo33 , 
riesgo33_comments , 
riesgo34 , 
riesgo34_comments , 
riesgo35 , 
riesgo35_comments , 
riesgo36 , 
riesgo36_comments , 
riesgo37 , 
riesgo37_comments , 
riesgo38 , 
riesgo38_comments , 
riesgo39 , 
riesgo39_comments , 
riesgo310 , 
riesgo310_comments , 
riesgo41 , 
riesgo41_comments , 
riesgo42 , 
riesgo42_comments , 
riesgo43 , 
riesgo43_comments , 
riesgo44 , 
riesgo44_comments , 
riesgo45 , 
riesgo45_comments , 
riesgo46 , 
riesgo46_comments , 
riesgo47 , 
riesgo47_comments , 
riesgo48 , 
riesgo48_comments , 
riesgo49 , 
riesgo49_comments , 
riesgo410 , 
riesgo410_comments , 
riesgo411 , 
riesgo411_comments , 
riesgo412 , 
riesgo412_comments , 
riesgo51 , 
riesgo51_comments , 
riesgo52 , 
riesgo52_comments , 
riesgo53 , 
riesgo53_comments , 
riesgo54 , 
riesgo54_comments , 
riesgo55 , 
riesgo55_comments , 
riesgo56 , 
riesgo56_comments , 
riesgo57 , 
riesgo57_comments , 
riesgo61 , 
riesgo61_comments , 
riesgo62 , 
riesgo62_comments , 
riesgo63 , 
riesgo63_comments , 
riesgo64 , 
riesgo64_comments , 
riesgo65 , 
riesgo65_comments , 
riesgo66 , 
riesgo66_comments , 
riesgo67 , 
riesgo67_comments , 
riesgo68 , 
riesgo68_comments , 
riesgo69 , 
riesgo69_comments , 
riesgo610 , 
riesgo610_comments , 
riesgo611 , 
riesgo611_comments , 
riesgo612 , 
riesgo612_comments , 
riesgo71 , 
riesgo71_comments , 
riesgo72 , 
riesgo72_comments , 
riesgo73 , 
riesgo73_comments , 
riesgo74 , 
riesgo74_comments , 
riesgo75 , 
riesgo75_comments , 
riesgo76 , 
riesgo76_comments , 
riesgo77 , 
riesgo77_comments , 
riesgo78 , 
riesgo78_comments , 
riesgo79 , 
riesgo79_comments , 
riesgo710 , 
riesgo710_comments , 
riesgo711 , 
riesgo711_comments , 
riesgo81 , 
riesgo81_comments , 
riesgo82 , 
riesgo82_comments , 
riesgo83 , 
riesgo83_comments , 
riesgo84 , 
riesgo84_comments , 
riesgo85 , 
riesgo85_comments , 
riesgo86 , 
riesgo86_comments , 
riesgo87 , 
riesgo87_comments , 
riesgo88 , 
riesgo88_comments , 
riesgo89 , 
riesgo89_comments , 
riesgo810 , 
riesgo810_comments , 
riesgo91 , 
riesgo91_comments , 
riesgo92 , 
riesgo92_comments , 
riesgo93 , 
riesgo93_comments , 
riesgo94 , 
riesgo94_comments , 
riesgo95 , 
riesgo95_comments , 
riesgo96 , 
riesgo96_comments , 
riesgo97 , 
riesgo97_comments , 
riesgo98 , 
riesgo98_comments , 
riesgo99 , 
riesgo99_comments , 
riesgo101 , 
riesgo101_comments , 
riesgo102 , 
riesgo102_comments , 
riesgo103 , 
riesgo103_comments , 
riesgo104 , 
riesgo104_comments , 
riesgo105 , 
riesgo105_comments , 
riesgo111 , 
riesgo111_comments , 
riesgo112 , 
riesgo112_comments , 
riesgo113 , 
riesgo113_comments , 
riesgo114 , 
riesgo114_comments , 
riesgo115 , 
riesgo115_comments , 
riesgo116 , 
riesgo116_comments , 
riesgo117 , 
riesgo117_comments , 
riesgo118 , 
riesgo118_comments , 
riesgo121 , 
riesgo121_comments , 
riesgo122 , 
riesgo122_comments , 
riesgo123 , 
riesgo123_comments , 
riesgo124 , 
riesgo124_comments , 
riesgo125 , 
riesgo125_comments , 
riesgo131 , 
riesgo131_comments , 
riesgo132 , 
riesgo132_comments , 
riesgo133 , 
riesgo133_comments , 
riesgo134 , 
riesgo134_comments , 
riesgo135 , 
riesgo135_comments , 
riesgo136 , 
riesgo136_comments , 
riesgo137 , 
riesgo137_comments , 
riesgo138 , 
riesgo138_comments , 
riesgo141 , 
riesgo141_comments , 
riesgo142 , 
riesgo142_comments , 
riesgo143 , 
riesgo143_comments , 
riesgo144 , 
riesgo144_comments , 
riesgo145 , 
riesgo145_comments , 
riesgo146 , 
riesgo146_comments , 
riesgo147 , 
riesgo147_comments ,
    fortalezas_acciones,
    fecha_cumplimiento,
    responsable,
    registro 
FROM  view_documento_riesgo 

WHERE fecha >= '$fechaInicio'  AND  fecha <  DATE_ADD('$fechaFin',INTERVAL 1 DAY) AND $sedeSQL ORDER BY fecha desc ";

$statement  = $pdo->prepare($query);
$statement -> execute(array());
$results    = $statement ->fetchAll();
$rowaffect = $statement->rowCount($query);

function respuesta($value){
        $result="";
switch ($value) {
    case '1':
        $result="Si";
        break;
    case '2':
        $result="No";
        break;
    case '3':
        $result="NA";
        break;       
}

return $result;
}




foreach($results as $rs ){


        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(2,$fila, $rowaffect);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(3,$fila, $rs['usuario_nombres'] . ' ' . $rs['usuario_apellidos']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(4,$fila, $rs['proyecto_nombre']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(5,$fila, $rs['area_nombre']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(6,$fila, $rs['ubicacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(7,$fila, $rs['area_observada_nombre']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(8,$fila, $rs['tarea_auditada']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(9,$fila,$rs['lider_auditoria']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(10,$fila,$rs['participantes']);


        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(11,$fila,$rs['empresa']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(12,$fila,$rs['fecha']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(251,$fila,$rs['fortalezas_acciones']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(252,$fila,$rs['fecha_cumplimiento']);
        $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(253,$fila,$rs['responsable']);

        $init=13;

        $array = array(7, 8, 10, 12 , 7 , 12 ,11,10,9 ,5,8,5,8,7);

        $index_uno=1;
        
        $index_dos=1;
                
        
        foreach ($array as &$value) {
                        
            $index_dos=1;

            if($init!=120){
        
                for ($j = 1; $j <= $value; $j++) {
        
                    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow($init,$fila,respuesta($rs['riesgo'.($index_uno.$index_dos)]));
                    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(($init+1),$fila,$rs['riesgo'.($index_uno.$index_dos).'_comments']);
                    
                    $index_dos++;
    
                    $init+=2;
                }
            
            }

            $index_uno++;
        
           

        }


        $fila++;
        $rowaffect--;

    };
    // Renombrar Hoja
    $objPHPExcel->getActiveSheet()->setTitle('Reportes de Riesgos Críticos');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('../reports/riesgos.xlsx');
    exit();


?>
