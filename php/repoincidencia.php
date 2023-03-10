<?php
require_once("../inc/tables.inc.php");
require_once("../inc/constantes.inc.php");

$sede = $_GET['sede'];
$row = repoIncidencias($pdo, $sede);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
    <link rel="stylesheet" href="../css/all.css">

    <script src="../js/jquery.js"></script>
    <script src="../js/incidencias.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Incidencias</title>
</head>

<body>
    <div class="modalWindow" id="previeWindow">
        <div class="pdfSheet">
            <div class="loader"></div>
            <a href="#" id="closePdfPrev"><i class="fas fa-times"></i></a>
            <object data="" type="application/pdf" width="100%" height="600px"></object>
        </div>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>Reporte de Incidencias - <?php echo $_GET['nombre'] ?> </h3>
        </div>
        <div class="divsearch">
            <div class="search">
                <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
                <!--<a href="#" id="btnExport">Exportar a Excel</a> -->
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
            </div>
        </div>
        <div class="tableWrap">
            <table id="incidenciasTable">
                <thead>
                    <tr>
                        <th width="10px">ITEM</th>
                        <th width="20px">PROYECTO</th>
                        <th width="20px">CLIENTE</th>
                        <th width="20px">LUGAR</th>
                        <th width="20px">FECHA INCIDENTE</th>
                        <th width="20px">HORA</th>
                        <th width="140px">DESCRIPCION</th>
                        <th width="250px">ELABORADO POR</th>
                        <th width="20px">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>