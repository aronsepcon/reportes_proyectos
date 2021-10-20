<?php
    require_once("../PHPExcel/PHPExcel.php");
    require_once("mysql_conector.inc.php");
    require_once("constantes.inc.php");
    require_once("tables.inc.php");
    require_once("../words/words.php");
    
    $TODOS_PROYECTOS = 100;
    /*
    $mes = $_POST['me'];
    $anio = $_POST['an'];*/
    $sede = $_POST['sede'];
    $fechaInicioMatriz = $_POST['fecha_inicio'];
    $fechaFinMatriz = $_POST['fecha_fin'];

    $sedeSQL = "idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "idProyecto = '$sede'";
    }

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
    $objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
    $objPHPExcel->getProperties()->setTitle("Reporte IPER"); // Titulo
    $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
    $objPHPExcel->getProperties()->setDescription("Reporte de IPERC"); //Descripción
    $objPHPExcel->getProperties()->setKeywords("IPERC"); //Etiquetas
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

    //$objPHPExcel->getActiveSheet()->getStyle('B5:BK5')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FF0000') ) ) );

    //alineacion
    $objPHPExcel->getActiveSheet()->getStyle('B3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B5:Z5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Titulo
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE IPERC game');

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
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);

    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(35);

    $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(35);

    //alto de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

    // Agregar Informacion

    $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'Orden');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'Elaborado por');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Proyecto');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Área');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Ubicación');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Área observada');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H5', 'Tarea');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'Empresa');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'Fecha');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('K5', constant('RIESGO_1'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M5', constant('RIESGO_2'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('O5', constant('RIESGO_3'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('P5', 'Comentario');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q5', constant('RIESGO_4'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('S5', constant('RIESGO_5'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('T5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('U5', constant('RIESGO_6'));

    $objPHPExcel->setActiveSheetIndex()->setCellValue('V5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('W5', constant('RIESGO_7'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('X5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Y5', constant('RIESGO_8'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Z5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AA5', constant('RIESGO_9'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AB5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AC5', constant('RIESGO_10'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AD5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AE5', constant('RIESGO_11'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AF5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AG5', constant('RIESGO_12'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AH5', 'Comentario');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('AI5', constant('RIESGO_13'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AJ5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AK5', constant('RIESGO_14'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AL5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AM5', constant('RIESGO_15'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AN5', 'Comentario');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AO5', constant('RIESGO_16'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AP5', 'Comentario');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('AQ5', constant('RIESGO_CRITICO1'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AR5', constant('RIESGO_CRITICO2'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AS5', constant('RIESGO_CRITICO3'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AT5', constant('RIESGO_CRITICO4'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AU5', constant('RIESGO_CRITICO5'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AV5', constant('RIESGO_CRITICO6'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AW5', constant('RIESGO_CRITICO7'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AX5', constant('RIESGO_CRITICO8'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AY5', constant('RIESGO_CRITICO9'));

    $objPHPExcel->setActiveSheetIndex()->setCellValue('AZ5', constant('RIESGO_MANO1'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BA5', constant('RIESGO_MANO2'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BB5', constant('RIESGO_MANO3'));

    $objPHPExcel->setActiveSheetIndex()->setCellValue('BC5', constant('RIESGO_COVID1'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BD5', constant('RIESGO_COVID2'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BE5', constant('RIESGO_COVID3'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BF5', constant('RIESGO_COVID4'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BG5', constant('RIESGO_COVID5'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BH5', constant('RIESGO_COVID6'));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('BI5', constant('RIESGO_COVID7'));

    //aca iran los datos de la tabla
    $fila = 6;

    $query = "SELECT id,
    idProyecto,
    nombre_proyecto,
    nombre_area,
    area_observada,
    ubicacion,
    nombre_tarea ,
    fecha,
    nombres_usuario,
    apellidos_usuario,
    empresa,
    registro ,

    riesgo1 ,
    comentario1 ,
    riesgo2 ,
    comentario2 ,
    riesgo3 ,
    comentario3 ,
    riesgo4 ,
    comentario4 ,
    riesgo5 ,
    comentario5 ,
    riesgo6 ,
    comentario6 ,
    riesgo7 ,
    comentario7 ,
    riesgo8 ,
    comentario8 ,
    riesgo9 ,
    comentario9 ,
    riesgo10 ,
    comentario10 ,
    riesgo11 ,
    comentario11 ,
    riesgo12 ,
    comentario12 ,
    riesgo13 ,
    comentario13 ,
    riesgo14 ,
    comentario14 ,
    riesgo15 ,
    comentario15 ,
    riesgo16 ,
    comentario16 ,
    riesgo_critico1 ,
    riesgo_critico2 ,
    riesgo_critico3 ,
    riesgo_critico4 ,
    riesgo_critico5 ,
    riesgo_critico6 ,
    riesgo_critico7 ,
    riesgo_critico8 ,
    riesgo_critico9 ,
    riesgo_manos1 ,
    riesgo_manos2 ,
    riesgo_manos3 ,
    riesgo_covid2 ,
    riesgo_covid3 ,
    riesgo_covid4 ,
    riesgo_covid5 ,
    riesgo_covid6 ,
    riesgo_covid7 FROM view_iperc WHERE fecha >= '$fechaInicioMatriz'  AND fecha < DATE_ADD('$fechaFinMatriz',INTERVAL 1 DAY) AND $sedeSQL  ORDER BY fecha DESC ";

    echo $query;

$statement  = $pdo->prepare($query);
$statement -> execute(array());
$results    = $statement ->fetchAll();



foreach($results as $rs ){

        $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, $rs['id']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['nombres_usuario'] . ' ' . $rs['apellidos_usuario']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, $rs['nombre_proyecto']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, $rs['nombre_area']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, $rs['ubicacion']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, $rs['area_observada']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, $rs['nombre_tarea']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, $rs['empresa']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, $rs['fecha']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $rs['riesgo1'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, $rs['comentario1']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, $rs['riesgo2'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $rs['comentario2']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $rs['riesgo3'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, $rs['comentario3']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('Q' . $fila, $rs['riesgo4'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('R' . $fila, $rs['comentario4']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('S' . $fila, $rs['riesgo5'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila, $rs['comentario5']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, $rs['riesgo6'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('V' . $fila, $rs['comentario6']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('W' . $fila, $rs['riesgo7'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('X' . $fila, $rs['comentario7']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Y' . $fila, $rs['riesgo8'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('Z' . $fila, $rs['comentario8']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AA' . $fila, $rs['riesgo9'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AB' . $fila, $rs['comentario9']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AC' . $fila, $rs['riesgo10'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AD' . $fila, $rs['comentario10']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AE' . $fila, $rs['riesgo11'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AF' . $fila, $rs['comentario11']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AG' . $fila, $rs['riesgo12'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AH' . $fila, $rs['comentario12']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('AI' . $fila, $rs['riesgo13'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AJ' . $fila, $rs['comentario13']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AK' . $fila, $rs['riesgo14'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AL' . $fila, $rs['comentario14']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AM' . $fila, $rs['riesgo15'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AN' . $fila, $rs['comentario15']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AO' . $fila, $rs['riesgo16'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AP' . $fila, $rs['comentario16']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('AQ' . $fila, $rs['riesgo_critico1'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AR' . $fila, $rs['riesgo_critico2'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AS' . $fila, $rs['riesgo_critico3'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AT' . $fila, $rs['riesgo_critico4'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AU' . $fila, $rs['riesgo_critico5'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AV' . $fila, $rs['riesgo_critico6'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AW' . $fila, $rs['riesgo_critico7'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AX' . $fila, $rs['riesgo_critico8'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('AY' . $fila, $rs['riesgo_critico9'] == '1' ? 'Si' : 'No');

        $objPHPExcel->setActiveSheetIndex()->setCellValue('AZ' . $fila, $rs['riesgo_manos1'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BA' . $fila, $rs['riesgo_manos2'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BB' . $fila, $rs['riesgo_manos3'] == '1' ? 'Si' : 'No');

        $objPHPExcel->setActiveSheetIndex()->setCellValue('BD' . $fila, $rs['riesgo_covid2'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BE' . $fila, $rs['riesgo_covid3'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BF' . $fila, $rs['riesgo_covid4'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BG' . $fila, $rs['riesgo_covid5'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BH' . $fila, $rs['riesgo_covid6'] == '1' ? 'Si' : 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('BI' . $fila, $rs['riesgo_covid7'] == '1' ? 'Si' : 'No');

        $fila++;

    };
    // Renombrar Hoja
    $objPHPExcel->getActiveSheet()->setTitle('Reportes de IPERC');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('../reports/iperc.xlsx');
    exit();


?>
