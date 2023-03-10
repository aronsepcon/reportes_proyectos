<?php 
    require_once("../PHPExcel/PHPExcel.php");
    require_once("mysql_conector.inc.php");
    require_once("constantes.inc.php");
    require_once("tables.inc.php");

    $mes    = $_POST['me'];
    $anio   = $_POST['an'];

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
    $objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
    $objPHPExcel->getProperties()->setTitle("Reporte Tarjetas Top"); // Titulo
    $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
    $objPHPExcel->getProperties()->setDescription("Reporte de Tops"); //Descripción
    $objPHPExcel->getProperties()->setKeywords("tarjetas tops"); //Etiquetas
    $objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias
       
    $Titulo = array(
     'font'  => array(
     'bold'  => true,
     'size'  => 14,
     'name'  => 'Verdana'
    ));

    $TituloTabla = array(
     'font'  => array(
     'bold'  => true,
     'size'  => 9,
     'name'  => 'Arial'
    ));

    // Crea un nuevo objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    //combinar celdas
    $objPHPExcel->getActiveSheet()->mergeCells('B3:U3');

    //estilo de fuentes
    $objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($Titulo);
    $objPHPExcel->getActiveSheet()->getStyle('B5:Z5')->applyFromArray($TituloTabla);

    //alineacion
    $objPHPExcel->getActiveSheet()->getStyle('B3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B5:Z5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Titulo 
    $objPHPExcel->getActiveSheet()->setCellValue('B3','REPORTE DE TARJETAS TOPS');

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
    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(35);


    //alto de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'Código de la Obra');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'No.del Asunto/configurar para que salga un número único');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Fecha');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Tipo de Observación');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Detalle del Tipo de Observacion');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Clasificación SSMA');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H5', 'Reportado por:');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'Descripción de la Observación Acto o condición/Casi Accidente');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'Relacionado con');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'Tipo de Epp');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'Condición del epp');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M5', 'Potencial del Riesgo');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N5', 'Acciones para prevenir la repetición');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('O5', 'Evidencia de la observación/caso accidente encontrado(registro,imagen o foto,otros)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('P5', 'Acción Inmediata (correctiva)/Que medidas correctivas se tomaron para eliminar el acto o condición sub estandar');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q5', 'Sugerencia para Acción de Mejora (si corresponde)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R5', 'Supervisor Responsable');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('S5', 'Evidencia de la acción implementada (registro, imagen o foto, otros)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('T5', 'Seguimiento');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('U5', 'Detalle de Otros');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('W5', 'Area Observada');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('X5', 'Lugar');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Y5', 'dni');

        //aca iran los datos de la tabla
        $fila = 6;


        $sql = "SELECT
                        tops.idtop,
                        tops.observado_lugar,
                        tops.reportado,
                        tops.fecha,
                        tops.observacion,
                        tops.actins,
                        tops.conins,
                        tops.actseg,
                        tops.relacion,
                        tops.descripcion,
                        tops.medidas,
                        tops.potencial,
                        tops.reg,
                        tops.conepp,
                        tops.tipepp,
                        tops.otros,
                        tops.area,
                        tops.foto,
                        tops.iduser,
                        tops.sede,
                        rrhh.tabla_aquarius.dni AS dni
                        FROM
                        tops 
                                                INNER JOIN 
                                                rrhh.tabla_aquarius ON tops.iduser=rrhh.tabla_aquarius.usuario
                        WHERE MONTH(reg) = $mes AND
                            YEAR(reg) = $anio 
         
                        ORDER BY
                        tops.reg DESC";

        $statement = $pdo->prepare($sql);
        $statement -> execute(array());
        $results = $statement ->fetchAll();
        $rowaffect = $statement->rowCount($sql);

        $sede  = master($pdo,"00");
        $obser = master($pdo,"01");
        $relac = master($pdo,"02");

        $actins =  master($pdo,"06");
        $conins =  master($pdo,"07");
        $acseg  =  master($pdo,"08");

        $tipo = master($pdo,"03");
        $condicion = master($pdo,"04");
        $potencial = master($pdo,"05");
        $area = master($pdo,"09");

        //salida de datos
        if ($rowaffect > 0) {
            foreach ($results as $rs) {

                $rel = $rs['relacion'] != "00" ? $relac[(int)$rs['relacion']] : "OTROS";
                $tip = $rs['tipepp'] != "00" ? $tipo[(int)$rs['tipepp']] : "";
                $con = $rs['conepp'] != "00" ? $condicion[(int)$rs['conepp']] : "";
                $pot = $rs['potencial'] != "00" ? $potencial[(int)$rs['potencial']] : "";
                $are = $rs['area'] != "00" ? $area[(int)$rs['area']] : "";

                if ( $rs['actins'] != "00" ) {
                    $des = $actins[(int)$rs['actins']];
                }elseif( $rs['conins'] != "00" ) {
                    $des = $conins[(int)$rs['conins']];
                }elseif( $rs['actseg'] != "00" ){
                    $des = $acseg[(int)$rs['actseg']];
                }
                else{
                    $des = "";
                }

                $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila,$sede[(int)$rs['sede']]);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,date("d/m/Y", strtotime($rs['fecha'])));
                $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,$obser[(int)$rs['observacion']]);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,$des);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,$rs['reportado']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,$rs['descripcion']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,$rel);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,$tip);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,$con);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,$pot);

                $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,"");

                $foto = "../../ssma/public/photos/".$rs['foto'];

                if ( $rs['foto'] != '' && file_exists($foto)) {
                    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(50);
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setCoordinates('O'.$fila);
                    $objDrawing->setName($rs['foto']);
                    $objDrawing->setDescription( constant("URL")."photos/".$rs['foto']);
                    $objDrawing->setPath("../../ssma/public/photos/".$rs['foto']);

                    $objDrawing->setHeight(50);
                    
                    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                }
                
                
                $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$fila,$rs['medidas']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('V'.$fila,$rs['otros']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('W'.$fila,$are);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('X'.$fila,$rs['observado_lugar']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('Y'.$fila,$rs['dni']);

                $fila++;                
            }
        };
        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Reportes de Tarjetas Tops');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('../reports/tops.xlsx');
        exit();
?>