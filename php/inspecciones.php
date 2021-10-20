<?php
    require_once("../inc/tables.inc.php");
    
    $sede = $_GET['sede'];
    $row = repoInspecciones($pdo,$sede);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION")?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/tops.js?<?php echo constant("VERSION")?>"></script>

    <title>Reporte de Inspecciones</title>
</head>
<body>
<div class="modal">
    <h1>Espere...</h1>
</div>
<div class="wrap">
    <div class="headerWrap">
        <h3>ACCIONES CORRECTIVAS Y/O PREVENTIVAS DE INSPECCIONES SSMA</h3>
    </div>
    <div class="divsearch">
        <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
        <a href="#" id="btnExport">Exportar a Excel</a>
    </div>
    <div class="tableWrap">
            <table id="topsTable">
                <thead>
                    <tr>
                        <th width="20px">ITEM</th>
                        <th width="140px">PROYECTO</th>
                        <th width="90px">FECHA DE LA INSPECCIÓN </th>
                        <th width="20px">INSPECCIÓN REALIZADA POR</th>
                        <th width="20px">TIPO DE INSPECCIÓN</th>
                        <th width="20px">CONDICIÓN O ACTO SUBESTANDAR</th>
                        <th width="250px">EVIDENCIA DE LO ENCONTRADO (REGISTRO, IMAGEN O FOTO, OTROS)</th>
                        <th width="250px">ACCIÓN CORRECTIVA</th>
                        <th width="20px">CLASIFICACIÓN</th>
                        <th width="150px">DIAS DE IMPLEMENTACIÓN</th>
                        <th width="150px">FECHA DE IMPLEMENTACIÓN</th>
                        <th width="150px">RESPONSABLE DE LA EJECUCIÓN</th>
                        <th width="180px">EVIDENCIA DE LA ACCIÓN  CORRECTIVA IMPLEMENTADA (REGISTRO, IMAGEN O FOTO)</th>
                        <th width="240px">COMENTARIOS ADICIONALES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row?>
                </tbody>
            </table>       
    </div>
</body>

</html>