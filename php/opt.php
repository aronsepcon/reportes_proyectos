<?php

require_once("../words/words.php");

require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = reportesOpt($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
    <link rel="stylesheet" href="../css/popup.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/opt.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte Tops</title>
</head>



<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <d iv class="wrap">
        <div class="headerWrap">
            <h1>Reporte OPT - <?php echo $_GET['nombre'] ?></h1>
        </div>

        <div class="divsearch">
            <div class="search">
                <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
                <!--<a href="#" id="btnExport">Exportar a Excel</a>
                <a href="#" id="btnExportMatriz">Exportar Matriz a Excel</a>-->
            </div>
            <div class="options">
                <label for="mes">Mes</label>
                <input type="number" name="mes" id="mes" value="<?php echo date("m"); ?>" min="1" max="12">
                <label for="anio">Año</label>
                <input type="number" name="anio" id="anio" value="<?php echo date("Y"); ?>" min="2020" placeholder="año">
                <a href="#" id="btnBefore">Consultar Anteriores</a>
            </div>
        </div>


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
                <a href="#" id="btnExportMatriz">Exportar Matriz a Excel</a>
            </div>
        </div>


        <div class="tableWrap">
            <table id="topsTable">
                <thead>
                    <tr>

                        <th width="20px">ID </th>
                        <th width="20px">Elaborado por </th>
                        <th width="20px">Proyecto</th>
                        <th width="20px">Área</th>
                        <th width="20px">Ubicación</th>
                        <th width="20px">Área Observada</th>
                        <th width="20px">Tiempo en el proyecto</th>
                        <th width="20px">Fecha</th>
                        <!--<th width="20px">Registro</th>-->
                        <th width="20px">Nombre </th>
                        <th width="20px">Tiempo en el trabajo</th>
                        <th width="20px">Guardia </th>
                        <th width="20px">Ocupación</th>
                        <th width="20px">Tarea</th>
                        <th width="20px">Responsable</th>
                        <th width="20px">Riesgo crítico</th>
                        <th width="20px">Pet Log</th>

                        <th width="20px">Razón de la OPT</th>
                        <th width="20px">Oportunidades</th>
                        <th width="20px">Firma del gerente </th>


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