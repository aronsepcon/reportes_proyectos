<?php
require_once "../PHPExcel/PHPExcel.php";
require_once "mysql_conector.inc.php";
require_once "constantes.inc.php";
require_once "tables.inc.php";
require_once "../words/words.php";




$fechaInicioMatriz = $_POST['fechaInicioMatriz'];
$fechaFinMatriz = $_POST['fechaFinMatriz'];

$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");


$extractMonth=explode("-", $fechaInicioMatriz)[2];

$mesElegido=0;

if (explode("0", $extractMonth)[0] == "0") {

    $mesElegido = explode("0", $extractMonth)[1] - 1;
} else {
    $mesElegido = $extractMonth - 1;
}

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("SEPCON"); // Nombre del autor
$objPHPExcel->getProperties()->setLastModifiedBy("SEPCON"); //Ultimo usuario que lo modificó
$objPHPExcel->getProperties()->setTitle("Matriz de Metas"); // Titulo
$objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
$objPHPExcel->getProperties()->setDescription("Matriz de Metas"); //Descripción
$objPHPExcel->getProperties()->setKeywords("Metas"); //Etiquetas
$objPHPExcel->getProperties()->setCategory("Reporte excel"); //Categorias

$Titulo = array(
    'font' => array(
        'bold' => true,
        'size' => 14,
        'name' => 'Calibri Light',
    ));

$subTitulo = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Calibri Light',
        'color' => array('rgb' => 'FF0000'),
    ));

$TituloTabla = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Calibri Light',
    ));

$fontEfectuadas = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
        'name' => 'Calibri Light',
        'color' => array('rgb' => '0000FF'),

    ));

$fontProgramadas = array(
    'font' => array(
        'size' => 9,
        'name' => 'Calibri Light',
        'color' => array('rgb' => '3366FF'),

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

$backgroundCellGeneral = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF',
    ),
);

$backgroundCellGrey = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'D9D9D9',
    ),
);

$backgroundCellYellow = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFF99',
    ),
);

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

$backgroundCellStrongGrey = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'BFBFBF',
    ),
);

$backgroundCellStrongGrey1 = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'D0CECE',
    ),
);

$backgroundCellTooStrongGrey = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => '969696',
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getFill()->applyFromArray($backgroundCellGeneral);

//estilo de fuentes
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($Titulo);
$objPHPExcel->getActiveSheet()->getStyle('B8:Q8')->applyFromArray($TituloTabla);

$objPHPExcel->getActiveSheet()->getStyle('B10:B11')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('C10:C11')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('E10:E42')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('F10:F42')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('H10:H42')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('I10:I42')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('K10:L30')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('L10:L30')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('N10:N42')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('O10:O42')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('Q10:Q42')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('R10:R42')->applyFromArray($fontProgramadas);

$objPHPExcel->getActiveSheet()->getStyle('B10:B11')->applyFromArray($fontEfectuadas);
$objPHPExcel->getActiveSheet()->getStyle('C10:C11')->applyFromArray($fontProgramadas);

//Alineación de todos las celdas centradas
$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:Z2000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:Z2000')->getAlignment()->setWrapText(true);

// ALNIEACION LEFT

//Alineación de la seccion de leyenda de acronimos
$objPHPExcel->getActiveSheet()->getStyle('A9:A42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('A9:A42')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('A9:A42')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle('D10:D43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('J10:J43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('G10:G43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('M10:M43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('P10:P43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('S10:S43')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('V10:V44')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

$objPHPExcel->getActiveSheet()->getStyle('U10:U44')->getNumberFormat()->applyFromArray(
    array(
        'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE,
    ));

// =====================================CABECERA 1  DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('A1:W2')->applyFromArray($borderCellAll);

//LOGO DE LA EMPRESA
$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setCoordinates('A1');
$objDrawing->setName('nueva imagen');
$objDrawing->setDescription('imagen ');
$objDrawing->setPath("../img/logo.png");
$objDrawing->setHeight(80);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setOffsetX(25);
$objDrawing->setOffsetY(5);

//TITULO DEL REPORTE
$objPHPExcel->getActiveSheet()->mergeCells('B1:R2');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B1', 'MATRIZ DE METAS MENSUALES EN SSMA PRUEBA');

//FECHA Y REVISION DEL DOCUMENTO
$objPHPExcel->getActiveSheet()->mergeCells('S1:W2');
$objPHPExcel->setActiveSheetIndex()->setCellValue('S1', "PSPC-110-X-PR-011-FR-001 \n Revisión:0 \n Emisión:21/06/2021 \n Página: 1 de 1 ");

// =====================================CABECERA 2 DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A4', 'PROYECTO');
$objPHPExcel->getActiveSheet()->mergeCells('B4:G4');
$objPHPExcel->getActiveSheet()->getStyle('B4:G4')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B4', ' 20PP03 L. Relaves Este / 00679 ');

$objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H4', 'MES');
$objPHPExcel->getActiveSheet()->mergeCells('I4:J4');
$objPHPExcel->getActiveSheet()->getStyle('I4:J4')->getFill()->applyFromArray($backgroundCellGrey);

$objPHPExcel->setActiveSheetIndex()->setCellValue('I4', $arrayMeses[$mesElegido]);

$objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($TituloTabla);
$objPHPExcel->getActiveSheet()->mergeCells('K4:L4');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K4', 'ELABORADO POR:');
$objPHPExcel->getActiveSheet()->mergeCells('M4:W4');
$objPHPExcel->getActiveSheet()->getStyle('M4:W4')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('M4', 'Arturo Calderón');

// =====================================CABECERA 3 DEL EXCEL ===================================================

$objPHPExcel->getActiveSheet()->mergeCells('A6:A7');
$objPHPExcel->getActiveSheet()->getStyle('A6:A7')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($TituloTabla);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A6', "LINEA DE MANDO \n (colorcar nombre de c/u)");

$objPHPExcel->getActiveSheet()->mergeCells('B6:D6');
$objPHPExcel->getActiveSheet()->getStyle('B6:D6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B6', "PROGRAMA PERSONALIZADO DE INSPECCIONES");

$objPHPExcel->getActiveSheet()->getStyle('B7:D7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('C7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('E6:G6');
$objPHPExcel->getActiveSheet()->getStyle('E6:G6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E6', "REPORTE DE ACTOS Y CONDICIONES SUB ESTANDARES (TARJETA TOP O RAC´S)");

$objPHPExcel->getActiveSheet()->getStyle('E7:G7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('F7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('G7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('H6:J6');
$objPHPExcel->getActiveSheet()->getStyle('H6:J6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H6', "INSPECCION PLANEADA DE SEGURIDAD (PROGRAMA DE INSPECCIONES 2021)");

$objPHPExcel->getActiveSheet()->getStyle('H7:J7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('I7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('J7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('K6:M6');
$objPHPExcel->getActiveSheet()->getStyle('K6:M6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K6', "OBSERVACION PLANEADA DE LA TAREA");

$objPHPExcel->getActiveSheet()->getStyle('K7:M7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('M7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('N6:P6');
$objPHPExcel->getActiveSheet()->getStyle('N6:P6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('N6', "INSPECCION IPERC CONTINUO");

$objPHPExcel->getActiveSheet()->getStyle('N7:P7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('N7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('O7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('P7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('Q6:S6');
$objPHPExcel->getActiveSheet()->getStyle('Q6:S6')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q6', "AUDITORIA DE RIESGOS CRITICOS ");

$objPHPExcel->getActiveSheet()->getStyle('Q7:S7')->getFill()->applyFromArray($backgroundCellYellow);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q7', "EFECTUADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('R7', "PROGRAMADAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('S7', "%");

$objPHPExcel->getActiveSheet()->mergeCells('T6:T7');
$objPHPExcel->getActiveSheet()->getStyle('T6:T7')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('T6', "ACTIVIDADES");

$objPHPExcel->getActiveSheet()->mergeCells('U6:W7');
$objPHPExcel->getActiveSheet()->getStyle('U6:W7')->getFill()->applyFromArray($backgroundCellGrey);
$objPHPExcel->setActiveSheetIndex()->setCellValue('U6', "PROMEDIO ESTANDAR");

// =====================================CUERPO DEL EXCEL ===================================================

//ancho de columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('w')->setWidth(5);

$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(60);

$objPHPExcel->getActiveSheet()->mergeCells('A9:W9');
$objPHPExcel->getActiveSheet()->getStyle('A9:W9')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A9')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A9', "Gerente/Superintendete");

$objPHPExcel->getActiveSheet()->mergeCells('A12:W12');
$objPHPExcel->getActiveSheet()->getStyle('A12:W12')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A12')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A12', "Jefes de Área");

$objPHPExcel->getActiveSheet()->mergeCells('A19:W19');
$objPHPExcel->getActiveSheet()->getStyle('A19:W19')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A19')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A19', "Supervisión");

$objPHPExcel->getActiveSheet()->mergeCells('A31:W31');
$objPHPExcel->getActiveSheet()->getStyle('A31:W31')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A31')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A31', "Capataz");

$objPHPExcel->getActiveSheet()->getStyle('A43:T43')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('A43')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A43', "TOTALES");

$objPHPExcel->getActiveSheet()->getStyle('R44:T44')->getFill()->applyFromArray($backgroundCellStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('R44')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('R44', "IDP");

$objPHPExcel->getActiveSheet()->mergeCells('U44:W44');
$objPHPExcel->getActiveSheet()->getStyle('U44:W44')->getFill()->applyFromArray($backgroundCellTooStrongGrey);
$objPHPExcel->getActiveSheet()->getStyle('R44')->applyFromArray($TituloTabla);
$objPHPExcel->setActiveSheetIndex()->setCellValue('R44', "IDP");

// CAMPOS QUE ESTAN SOMBREADOS Y DONDE NO LLENAMOS CON DATA

$objPHPExcel->getActiveSheet()->mergeCells('B13:D18');
$objPHPExcel->getActiveSheet()->getStyle('B13:D18')->getFill()->applyFromArray($backgroundCellStrongGrey1);

$objPHPExcel->getActiveSheet()->mergeCells('B20:D30');
$objPHPExcel->getActiveSheet()->getStyle('B20:D30')->getFill()->applyFromArray($backgroundCellStrongGrey1);

$objPHPExcel->getActiveSheet()->mergeCells('B32:D42');
$objPHPExcel->getActiveSheet()->getStyle('B32:D42')->getFill()->applyFromArray($backgroundCellStrongGrey1);

$objPHPExcel->getActiveSheet()->mergeCells('K32:M42');
$objPHPExcel->getActiveSheet()->getStyle('K32:M42')->getFill()->applyFromArray($backgroundCellStrongGrey1);

// VAMOS A REALIZAR LA CONSULTA PARA OBTENER LOS VALORES

$fila = 10;
$sql = "SELECT
ssma.usuarioMeta.nombresApellidos,

ssma.usuarioMeta.cantidadProgramadaGerencial AS programadaGerencial,

(SELECT COUNT(*)
FROM ssma.tops
WHERE ssma.tops.iduser =ssma.usuarioMeta.usuario AND
              '2021-06-01'  <= ssma.tops.reg AND  
              '2021-06-19'  >=  ssma.tops.reg  AND 
              
              ssma.tops.sede = '06'
              ) AS efectuadaTops,

ssma.usuarioMeta.cantidadProgramadaTops AS programadaTops,

(SELECT COUNT(*)
FROM ssma.seguridad
WHERE ssma.seguridad.idusuario = ssma.usuarioMeta.internal AND
 
              '2021-06-01'  <= ssma.seguridad.reg AND  
              '2021-06-19'  >=  ssma.seguridad.reg  AND 
              
              ssma.seguridad.sede = '06'
              ) AS efectuadaSeguridad,

ssma.usuarioMeta.cantidadProgramadaSeguridad AS programadaSeguridad,

(SELECT COUNT(*)
FROM ssma.opt
WHERE ssma.opt.idusuario = ssma.usuarioMeta.internal AND

              '2021-06-01'  <= ssma.opt.registro AND  
              '2021-06-19'  >=  ssma.opt.registro  AND 


              ssma.opt.idProyecto = '06'
              ) AS efectuadaOpt,

ssma.usuarioMeta.cantidadProgramadaOpt AS programadaOpt,

(SELECT COUNT(*)
FROM ssma.iperc
WHERE ssma.iperc.idusuario = ssma.usuarioMeta.internal AND
             

              '2021-06-01'  <= ssma.iperc.registro AND  
              '2021-06-19'  >=  ssma.iperc.registro  AND 


              ssma.iperc.idProyecto = '06'
              ) AS efectuadaIperc,

ssma.usuarioMeta.cantidadProgramadaIperc AS programadaIperc,

(SELECT COUNT(*)
FROM ssma.documento_riesgos
WHERE ssma.documento_riesgos.idusuario = ssma.usuarioMeta.internal AND
            


              '2021-06-01'  <= ssma.documento_riesgos.registro AND  
              '2021-06-19'  >= ssma.documento_riesgos.registro AND 
              
              ssma.documento_riesgos.idProyecto = '06'
              ) AS efectuadaRiesgo,

ssma.usuarioMeta.cantidadProgramadaRiesgo AS programadaRiesgo

FROM usuarioMeta ";

echo $sql;

$statement = $pdo->prepare($sql);
$statement->execute(array());
$results = $statement->fetchAll();
$rowaffect = $statement->rowCount($sql);

//salida de datos
if ($rowaffect > 0) {
    foreach ($results as $rs) {

        if ($fila != 12 && $fila != 19 && $fila != 31) {

            $objPHPExcel->setActiveSheetIndex()->setCellValue('A' . $fila, $rs['nombresApellidos']);

            $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $fila, 0);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $fila, $rs['programadaGerencial']);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $fila, '=IF(IFERROR(B' . $fila . '/C' . $fila . ',0)> 1,1,IFERROR(B' . $fila . '/C' . $fila . ',0))');

            $numeradorTop = $rs['efectuadaTops'] != null ? $rs['efectuadaTops'] : 0;
            $denominadorTop = $rs['programadaTops'] != null ? $rs['programadaTops'] : 0;

            if ($denominadorTop > 0) {

                if ($numeradorTop < $denominadorTop) {

                    $divisionTop = ($numeradorTop / $denominadorTop) * 100;

                } else {

                    $divisionTop = 100;
                }
            }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $fila, $numeradorTop);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $fila, $denominadorTop);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $fila, '=IF(IFERROR(E' . $fila . '/F' . $fila . ',0)> 1,1,IFERROR(E' . $fila . '/F' . $fila . ',0))');

            $numeradorSeguridad = $rs['efectuadaSeguridad'] != null ? $rs['efectuadaSeguridad'] : 0;
            $denominadorSeguridad = $rs['programadaSeguridad'] != null ? $rs['programadaSeguridad'] : 0;

            if ($denominadorSeguridad > 0) {

                if ($numeradorSeguridad < $denominadorSeguridad) {

                    $divisionSeguridad = ($numeradorSeguridad / $denominadorSeguridad) * 100;

                } else {

                    $divisionSeguridad = 100;
                }
            }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $fila, $numeradorSeguridad);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('I' . $fila, $denominadorSeguridad);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('J' . $fila, '=IF(IFERROR(H' . $fila . '/I' . $fila . ',0)> 1,1,IFERROR(H' . $fila . '/I' . $fila . ',0))');

            $numeradorOpt = $rs['efectuadaOpt'] != null ? $rs['efectuadaOpt'] : 0;
            $denominadorOpt = $rs['programadaOpt'] != null ? $rs['programadaOpt'] : 0;

            if ($denominadorOpt > 0) {

                if ($numeradorOpt < $denominadorOpt) {

                    $divisionOpt = ($numeradorOpt / $denominadorOpt) * 100;

                } else {

                    $divisionOpt = 100;
                }
            }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('K' . $fila, $numeradorOpt);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('L' . $fila, $denominadorOpt);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('M' . $fila, '=IF(IFERROR(K' . $fila . '/L' . $fila . ',0)> 1,1,IFERROR(K' . $fila . '/L' . $fila . ',0))');

            $numeradorIperc = $rs['efectuadaIperc'] != null ? $rs['efectuadaIperc'] : 0;
            $denominadorIperc = $rs['programadaIperc'] != null ? $rs['programadaIperc'] : 0;

            if ($denominadorIperc > 0) {

                if ($numeradorIperc < $denominadorIperc) {

                    $divisionIperc = ($numeradorIperc / $denominadorIperc) * 100;

                } else {

                    $divisionIperc = 100;
                }
            }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('N' . $fila, $numeradorIperc);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('O' . $fila, $denominadorIperc);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('P' . $fila, '=IF(IFERROR(N' . $fila . '/O' . $fila . ',0)> 1,1,IFERROR(N' . $fila . '/O' . $fila . ',0))');

            $numeradorRiesgo = $rs['efectuadaRiesgo'] != null ? $rs['efectuadaRiesgo'] : 0;
            $denominadorRiesgo = $rs['programadaRiesgo'] != null ? $rs['programadaRiesgo'] : 0;

            if ($denominadorRiesgo > 0) {

                if ($numeradorRiesgo < $denominadorRiesgo) {

                    $divisionRiesgo = ($numeradorRiesgo / $denominadorRiesgo) * 100;

                } else {

                    $divisionRiesgo = 100;
                }
            }

            $objPHPExcel->setActiveSheetIndex()->setCellValue('Q' . $fila, $numeradorRiesgo);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('R' . $fila, $denominadorRiesgo);
            $objPHPExcel->setActiveSheetIndex()->setCellValue('S' . $fila, '=IF(IFERROR(Q' . $fila . '/R' . $fila . ',0)> 1,1,IFERROR(Q' . $fila . '/R' . $fila . ',0))');

            $objPHPExcel->setActiveSheetIndex()->setCellValue('T' . $fila, '=R' . $fila . '+O' . $fila . '+L' . $fila . '+I' . $fila . '+F' . $fila . '+C' . $fila);

            $objPHPExcel->getActiveSheet()->mergeCells('U' . $fila . ':W' . $fila);

            /*if ($fila == 10 || $fila == 11) {

                $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, '=(D' . $fila . '+G' . $fila . '+J' . $fila . '+M' . $fila . '+P' . $fila . '+S' . $fila . ') / 6 ');

                $divisionTotal = ($divisionTop + $divisionSeguridad + $divisionOpt + $divisionIperc + $divisionRiesgo) / 6;

                echo $divisionTotal;

                if ($divisionTotal < 50) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellRed);

                }
                if ($divisionTotal >= 50 && $divisionTotal < 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

                }
                if ($divisionTotal >= 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

                }

            } else {

                $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, '=(G' . $fila . '+J' . $fila . '+M' . $fila . '+P' . $fila . '+S' . $fila . ') / 5 ');

                $divisionTotal = ($divisionTop + $divisionSeguridad + $divisionOpt + $divisionIperc + $divisionRiesgo) / 5;

                echo $divisionTotal;

                if ($divisionTotal < 50) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellRed);

                }
                if ($divisionTotal >= 50 && $divisionTotal < 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

                }
                if ($divisionTotal >= 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

                }

            }*/



            if ($fila <= 11){
        
                        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, '=(D' . $fila . '+G' . $fila . '+J' . $fila . '+M' . $fila . '+P' . $fila . '+S' . $fila . ') / 6 ');

                $divisionTotal = ($divisionTop + $divisionSeguridad + $divisionOpt + $divisionIperc + $divisionRiesgo) / 6;

                echo $divisionTotal;

                if ($divisionTotal < 50) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellRed);

                }
                if ($divisionTotal >= 50 && $divisionTotal < 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

                }
                if ($divisionTotal >= 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

                }

            }

            if( $fila >= 13 && $fila <= 30){



                        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, '=(D' . $fila . '+G' . $fila . '+J' . $fila . '+M' . $fila . '+P' . $fila . '+S' . $fila . ') / 5 ');

                $divisionTotal = ($divisionTop + $divisionSeguridad + $divisionOpt + $divisionIperc + $divisionRiesgo) / 6;

                echo $divisionTotal;

                if ($divisionTotal < 50) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellRed);

                }
                if ($divisionTotal >= 50 && $divisionTotal < 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

                }
                if ($divisionTotal >= 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

                }
                    

            }

            if($fila >=32 && $fila <= 42 ){
                    


                        $objPHPExcel->setActiveSheetIndex()->setCellValue('U' . $fila, '=(D' . $fila . '+G' . $fila . '+J' . $fila . '+M' . $fila . '+P' . $fila . '+S' . $fila . ') / 4 ');
                        
                $divisionTotal = ($divisionTop + $divisionSeguridad + $divisionOpt + $divisionIperc + $divisionRiesgo) / 6;

                echo $divisionTotal;

                if ($divisionTotal < 50) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellRed);

                }
                if ($divisionTotal >= 50 && $divisionTotal < 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellYellowLight);

                }
                if ($divisionTotal >= 80) {

                    $objPHPExcel->getActiveSheet()->getStyle('U' . $fila)->getFill()->applyFromArray($backgroundCellGreen);

                }
            }

        }

        $fila++;
    }
}

$objPHPExcel->getActiveSheet()->mergeCells('U43:W43');
$objPHPExcel->getActiveSheet()->mergeCells('R44:T44');

//ancho de columnas
$objPHPExcel->setActiveSheetIndex()->setCellValue('B43', '=SUM(B10:B11)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C43', '=SUM(C10:C11)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D43', '=AVERAGE(D10:D11)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E43', '=SUM(E10:E42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F43', '=SUM(F10:F42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G43', '=AVERAGE(G10:G42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('H43', '=SUM(H10:H42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I43', '=SUM(I10:I42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('J43', '=AVERAGE(J10:J42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('K43', '=SUM(K10:K30)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('L43', '=SUM(L10:L30)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('M43', '=AVERAGE(M10:M30)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('N43', '=SUM(N10:N42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('O43', '=SUM(O10:O42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('P43', '=AVERAGE(P10:P42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q43', '=SUM(Q10:Q42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('R43', '=SUM(R10:R42)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('S43', '=AVERAGE(S10:S42)');

//=+REDONDEAR((D43+G43+J43+M43+P43+S43)/6;4)

$objPHPExcel->setActiveSheetIndex()->setCellValue('U44', '=ROUND((D43+G43+J43+M43+P43+S43)/6,4)');

$objPHPExcel->getActiveSheet()->mergeCells('A3:W3');
$objPHPExcel->getActiveSheet()->mergeCells('A5:W5');
$objPHPExcel->getActiveSheet()->mergeCells('A8:W8');

// Bordes para todos las celdas que contengan informacion acerca del reporte
$objPHPExcel->getActiveSheet()->getStyle('A4:W44')->applyFromArray($borderCellAll);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('MATRIZ DE METAS');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../reports/matrizmetas.xlsx');
exit();
