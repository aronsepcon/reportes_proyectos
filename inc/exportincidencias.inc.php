<?php 
    require_once("../PHPExcel/PHPExcel.php");
    require_once("mysql_conector.inc.php");
    require_once("constantes.inc.php");
    require_once("tables.inc.php");


    /*$mes    = $_POST['me'];
    $anio   = $_POST['an'];*/

    $TODOS_PROYECTOS = 100;

    $sede = $_POST['sede'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $sedeSQL = "proyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "proyecto = '$sede'";
    }

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Helena Minaya"); // Nombre del autor
    $objPHPExcel->getProperties()->setLastModifiedBy("Helena Minaya"); //Ultimo usuario que lo modificó
    $objPHPExcel->getProperties()->setTitle("Reporte Incidencias"); // Titulo
    $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
    $objPHPExcel->getProperties()->setDescription("Reporte de Incidencias"); //Descripción
    $objPHPExcel->getProperties()->setKeywords("reportes de incidencias"); //Etiquetas
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
    $objPHPExcel->getActiveSheet()->getStyle('B5:AM5')->applyFromArray($TituloTabla);

    //alineacion
    $objPHPExcel->getActiveSheet()->getStyle('B3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B5:AM5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //Titulo 
    $objPHPExcel->getActiveSheet()->setCellValue('B3','REPORTE DE INCIDENCIAS');

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

    //alto de la fila
    $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);

    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'Proyecto /Sede');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'Área');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Cliente');


    $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Daño material < $500');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Daño material > $500');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Derrame de Hidrocarburos < 2 m3 ');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H5', 'Derrame de Hidrocarburos > 2 m3');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I5', 'Accidente Vehicular con Herido');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J5', 'Accidente Vehicular sin Herido');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K5', 'Accidente Vehicular < 500 $');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L5', 'Accidente Vehicular > 500 $');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M5', '(F.A.C) Caso de Primeros Auxilios');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N5', '(M.T.O) Accidente Con Tratamiento Médico');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('O5', '(R.W.C) Accidente Con Trabajo Restringido');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('P5', '(L.T.I) Accidente Con Pérdida de Jornada');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q5', '(F.T.L) Fatalidad');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R5', 'Incidente');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('S5', '(E.O) Enfermedad Ocupacional');


    $objPHPExcel->setActiveSheetIndex()->setCellValue('T5', 'Lugar');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('U5', 'Fecha');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('V5', 'hora');


    $objPHPExcel->setActiveSheetIndex()->setCellValue('W5', 'Nombre de la persona involucrada');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('X5', 'DNI/CE');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Y5', 'Sexo');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Z5', 'Edad');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AA5', 'Cuenta con seguro (SI/NO)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AB5', 'Lugar y fecha de nacimiento');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AC5', 'domicilio');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AD5', 'estado civil');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AE5', 'departamento');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AF5', 'provincia');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AG5', 'cargo');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AH5', 'instrucción');

    $objPHPExcel->setActiveSheetIndex()->setCellValue('AI5', 'DESCRIPCIÓN DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL (Incluyendo nombres y cargos de las personas involucradas)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AJ5', 'ACCIONES INMEDIATAS DESPUES DEL ACCIDENTE/INCIDENTE/ENFERMEDAD OCUPACIONAL (Atención médica, evacuación, reparación de daños materiales, acciones correctivas, etc)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AK5', 'Elaborado por ');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('AL5', 'Evidencia');

        
        //aca iran los datos de la tabla
        $fila = 6;


        $sql = "SELECT
                incidencias.iddoc,
                incidencias.proyecto,
                incidencias.cliente,
                incidencias.lugar,
                incidencias.fecha,
                incidencias.hora,
                incidencias.descripcion,
                incidencias.reg,
                incidencias.elaborado,
                incidencias.foto,
                
                incidencias.materialmenor,
                incidencias.materialmayor,
                incidencias.derramemenor,
                incidencias.derramemayor,
                incidencias.conherido,
                incidencias.sinherido,
                incidencias.vehicularmenor,
                incidencias.vehicularmayor,
                incidencias.fac,
                incidencias.mto,
                incidencias.rwc,
                incidencias.lti,
                incidencias.ftl,
                incidencias.incidente,
                incidencias.eo,
                incidencias.persona,
                incidencias.documento,
                incidencias.sexo,
                incidencias.edad,
                incidencias.nacimiento,
                incidencias.domicilio,
                incidencias.civil,
                incidencias.dpto,
                incidencias.prov,
                incidencias.dist,
                incidencias.cargo,
                incidencias.instruccion,
                incidencias.acciones,
                incidencias.usuario,
                incidencias.seguro,
                incidencias.acciones,
                general.nombre,
                area_general.nombre AS area_nombre
                FROM
                incidencias
                INNER JOIN general ON incidencias.proyecto = general.cod
                INNER JOIN area_general ON incidencias.idAreaObservada=area_general.id
                WHERE general.clase = 00  AND incidencias.fecha  >= '$fecha_inicio'  
                AND incidencias.fecha <  DATE_ADD('$fecha_fin',INTERVAL 1 DAY) AND $sedeSQL   order by incidencias.fecha desc
                ";

  

        $statement = $pdo->prepare($sql);
        $statement -> execute(array());
        $results = $statement ->fetchAll();
        $rowaffect = $statement->rowCount($sql);


        //salida de datos
        if ($rowaffect > 0) {
            foreach ($results as $rs) {

                $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila,$rs['nombre']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila,$rs['area_nombre']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,$rs['cliente']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,$rs['materialmenor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,$rs['materialmayor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,$rs['derramemenor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,$rs['derramemayor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,$rs['conherido'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,$rs['sinherido'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,$rs['vehicularmenor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,$rs['vehicularmayor'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,$rs['fac'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila,$rs['mto'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,$rs['rwc'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$fila,$rs['lti'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$fila,$rs['ftl'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$fila,$rs['incidente'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('S'.$fila,$rs['eo'] == "1" ? "x" : "");
                $objPHPExcel->setActiveSheetIndex()->setCellValue('T'.$fila,$rs['lugar']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('U'.$fila,$rs['fecha']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('V'.$fila,$rs['hora']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('W'.$fila,$rs['persona']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('X'.$fila,$rs['documento']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('Y'.$fila,$rs['sexo']= "MA" ? "MASCULINO" : "FEMENINO");

                $objPHPExcel->setActiveSheetIndex()->setCellValue('Z'.$fila,$rs['edad']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AA'.$fila,$rs['seguro']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AB'.$fila,$rs['nacimiento']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AC'.$fila,$rs['domicilio']);
                $estado_civil='';
                switch ($rs['civil']) {
                    case 'CO':
                        $estado_civil='CONVIVIENTE';
                        break;
                    case 'CA':
                        $estado_civil='CASADO';
                        break;
                    case 'SO':
                        $estado_civil='SOLTERO';
                        break;
                    case 'DI':
                       $estado_civil='DIVORCIADO';
                        break;
                    case 'VI':
                        $estado_civil='VIUDO';
                        break;
                    case 'OT':
                        $estado_civil='OT';
                        break;
                }

                $objPHPExcel->setActiveSheetIndex()->setCellValue('AD'.$fila,$estado_civil);

                $objPHPExcel->setActiveSheetIndex()->setCellValue('AE'.$fila,$rs['dpto']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AF'.$fila,$rs['prov']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AG'.$fila,$rs['cargo']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AH'.$fila,$rs['instruccion']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AI'.$fila,$rs['descripcion']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AJ'.$fila,$rs['acciones']);
                $objPHPExcel->setActiveSheetIndex()->setCellValue('AK'.$fila,$rs['elaborado']);
                //$objPHPExcel->setActiveSheetIndex()->setCellValue('AL'.$fila,$rs['elaborado']);*/
                
                /*$foto = "../../ssma/public/photos/".$rs['foto'];

                if ( $rs['foto'] != 'public/img/noimagen.jpg' && file_exists($foto)) {
                    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(50);
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setCoordinates('AL'.$fila);
                    $objDrawing->setName($rs['foto']);
                    $objDrawing->setDescription( constant("URL")."photos/".$rs['foto']);
                    $objDrawing->setPath("../../ssma/public/photos/".$rs['foto']);

                    $objDrawing->setHeight(50);
                    
                    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                }*/               
                $fila++;                
            }
        };
        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Reportes de Incidencias');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('../reports/incidencias.xlsx');
        exit();
        echo "bad";
?>