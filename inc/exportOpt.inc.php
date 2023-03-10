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
    $objPHPExcel->getProperties()->setTitle("Reporte OPT"); // Titulo
    $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
    $objPHPExcel->getProperties()->setDescription("Reporte de OPT"); //Descripción
    $objPHPExcel->getProperties()->setKeywords("OPT"); //Etiquetas
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
    $objPHPExcel->getActiveSheet()->getStyle('B5:BK5')->applyFromArray($TituloTabla);

    $objPHPExcel->getActiveSheet()->getStyle('B6:BK6')->applyFromArray($TituloTabla);

    //$objPHPExcel->getActiveSheet()->getStyle('B5:BK5')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FF0000') ) ) );

    //alineacion
    $objPHPExcel->getActiveSheet()->getStyle('B3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B5:Z5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B6:Z6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Titulo
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE OPT');

    $objPHPExcel->getActiveSheet()->getStyle('B5:Z2000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    $objPHPExcel->getActiveSheet()->getStyle('B5:Z2000')->getAlignment()->setWrapText(true);

    //ancho de columnas
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(50);

    //alto de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

    // Agregar Informacion

    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'N°');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'Elaborado por');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Proyecto');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Área');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Ubicación');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Área observada');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H5', 'Nombre del equipo observado');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'Tiempo en el trabajo');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'Tiempo en el trabajo actual');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'Guardia');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'Ocupación');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M5', 'Tarea');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N5', 'Fecha de elaboración');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('O5', 'Razón para la OPT');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N5', 'responsable');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('O5', 'Riesgo crítico');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('P5', 'Pet Log');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q5', 'Fecha de elaboración');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R5', 'Razón para la OPT');


    $objPHPExcel->getActiveSheet()->mergeCells('S5:T5');
    $objPHPExcel->getActiveSheet()->setCellValue('S5', 'Observación de la Tarea');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('S6', 'Pasos');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('T6', 'Observaciones');


    $objPHPExcel->getActiveSheet()->setCellValue('U5', 'Observación planeada de tarea de resultados');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('U6', 'Fortalezas - Oportunidades para felicitar');


    $objPHPExcel->getActiveSheet()->mergeCells('V5:W5');
    $objPHPExcel->getActiveSheet()->setCellValue('V5', 'Recomendaciones');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('V6', 'Acciones');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('W6', 'Fecha');


    $objPHPExcel->setActiveSheetIndex()->setCellValue('X5', 'Nombre de los observadores');

    //aca iran los datos de la tabla
    $fila = 7;

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
    firma_gerente ,
    responsable,
    riesgoCritico,
    petLog,
    area  
    FROM view_opt WHERE  registro >= '$fechaInicio'  AND  registro <  DATE_ADD('$fechaFin',INTERVAL 1 DAY) AND $sedeSQL ORDER BY registro desc ";

    $statement = $pdo->prepare($query);
    $statement->execute(array());
    $results = $statement->fetchAll();
    $rowaffect = $statement->rowCount($query);


    foreach ($results as $rs) {


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

        
        $objPHPExcel->setActiveSheetIndex()->setCellValue('S' .$fila, $data_observacion);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila,  $data2_observacion);




        //FORTALEZS

        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, $rs['oportunidades']);

        


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
            $data2_recomendacion.=($contador .". ". $rs_recomendaciones['fecha']."  \n \n \n");

            $contador++;
        }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('V' . $fila,$data_recomendacion );
            $objPHPExcel->setActiveSheetIndex()->setCellValue('W' . $fila, $data2_recomendacion);



        //OBSERVADORES

        $query_observadores="SELECT id,nombre FROM optobservadores WHERE idOpt= $id_documento ";

        $statement = $pdo->prepare($query_observadores);
        $statement->execute(array());
        $results_observadores = $statement->fetchAll();

        $data_observadores="";
        $contador=1;

        foreach($results_observadores as $rs_osbervadores){
            
            $data_observadores.=($contador .". ".  $rs_osbervadores['nombre']."  \n \n \n");

            $contador++;
        }

        $objPHPExcel->setActiveSheetIndex()->setCellValue('X' . $fila, $data_observadores);






        // VAMOS HACER UN MERGE CELDA DE LA CANTIDAD MAYOR DE LOS CONTADORES ANTERIORES
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $rowaffect);
        
       $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $rs['usuario_nombres']." ".$rs['usuario_apellidos']);
        
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,  $rs['proyecto_nombre']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,  $rs['area_nombre']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,  $rs['ubicacion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,  $rs['area_observada_nombre']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, $rs['nombre']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, $rs['tiempo_proyecto']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,  $rs['tiempo_trabajo']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,  $rs['guardia']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, $rs['ocupacion']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,  $rs['tarea']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila,  $rs['responsable']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,  $rs['riesgoCritico']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$fila,  $rs['petLog']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$fila, $rs['registro']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$fila,  $rs['razon_opt']);


        $rowaffect--;
        $fila++;

    };


    // Renombrar Hoja
    $objPHPExcel->getActiveSheet()->setTitle('Reportes de OPT');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('../reports/opt.xlsx');

    exit();

?>