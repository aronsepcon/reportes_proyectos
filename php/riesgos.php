<?php

require_once("../words/words.php");

require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = reportesRiesgos($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
    <link rel="stylesheet" href="../css/popup.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/riesgos.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Riesgos Críticos</title>
</head>



<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <d iv class="wrap">
        <div class="headerWrap">
            <h1>Reporte de Riesgos Críticos  - <?php echo $_GET['nombre'] ?> </h1>
        </div>

        <div class="divsearch">
            <div class="search">
                <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
                <!-- <a href="#" id="btnExport">Exportar a Excel</a>-->
            </div>
            <div class="options">
                <label for="mes">Mes</label>
                <input type="number" name="mes" id="mes" value="<?php echo date("m"); ?>" min="1" max="12">
                <label for="anio">Año</label>
                <input type="number" name="anio" id="anio" value="<?php echo date("Y"); ?>" min="2020" placeholder="año">
                <a href="#" id="btnBefore">Consultar Anteriores</a>
            </div>
        </div>

        <!--<form method="POST" id="formExcel">-->
        <div class="search">

            <input type="hidden" name="sede" id="sede" value="<?php echo $_GET['sede'] ?>">

        </div>
        <div class="divsearch">
            <div class="search">
                <label for="fechaInicio">Fecha de inicio</label>
                <input type="date" id="fechaInicio" name="fechaInicio">
                <label for="fechaFin">Fecha fin </label>
                <input type="date" id="fechaFin" name="fechaFin">

                <a href="#" id="btnExport">Exportar a Excel</a>
            </div>
        </div>


        <div class="tableWrap">
            <table id="riesgosTable">
                <thead>
                    <tr>

                        <th width="20px">ID </th>
                        <th width="20px">Elaborado por </th>
                        <th width="20px">Proyecto</th>
                        <th width="20px">Área</th>
                        <th width="20px">Ubicación</th>
                        <th width="20px">Área Observada</th>

                        <th width="20px">Descripción de la Tarea Auditada</th>
                        <th width="20px">Líder de auditoría</th>
                        <th width="20px">Participantes</th>
                        <th width="20px">Empresa</th>
                        <th width="20px">fecha</th>

                        <th width="20px">Fortalezas /acciones a tomar </th>
                        <th width="20px">fecha de cumplimiento</th>
                        <th width="20px">Responsable</th>


                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>


        <!-- ESTE ES EL POPUP  -->






</body>

</html>