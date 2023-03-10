<?php
session_start();

header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('Etc/UTC');

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("inc/tables.inc.php");
$proyectos = proyectos($pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- <link rel="stylesheet" href="css/style.css?v1.0.5">-->
    <link rel="stylesheet" href="css/main.css?v1.0.6">

    <script src="js/jquery.js"></script>
    <script src="js/main.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reportes SSMA</title>
</head>

<body>
    <div class="contenido_main">

        <div class="headerWrap">
            <h1>Reportes de Documentos</h1>
        </div>
        <div class="bodyWrap">
            <div>
                <select name="sede" id="sede">
                    <?php echo $proyectos ?>
                </select>
            </div>

                <select name="tipo_documento" id="tipo_documento">
                    <option value="php/topsNuevo.php">Tarjetas Top </option>
                    <option value="php/inspecciones.php">Inspección Gerencial </option>
                    <option value="#">Suspención de Trabajos </option>
                    <option value="#">Auditoria PTAR </option>
                    <option value="php/seguridad.php">Inspección Planeada de Seguridad </option>
                    <option value="php/repoincidencia.php">Reporte de Incidencias </option>
                   <!-- <option value="php/iperc.php">IPERC </option>-->
                    <option value="php/opt.php">OPT </option>
                    <option value="php/riesgos.php">Riesgos Críticos </option>
                    <option value="php/matriz.php">Matriz Mensual </option>
                    <option value="php/ipercNuevo.php">IPERC</option>
                    <option value="php/InspeccionAlmacen.php">Inspección almacen</option>
                    <option value="php/InspeccionOficina.php">Inspección oficina</option>
                    <option value="php/InspeccionBotiquin.php">Inspección botiquin</option>
                    <option value="php/InspeccionEscalera.php">Inspección de escaleras fijas y portátiles </option>
                    <option value="php/InspeccionExtintor.php">Inspección de extintores </option>
                    <option value="php/InspeccionEstacionEmergencia.php">Inspección de estación de emergencia </option>
                    <option value="php/InspeccionTablero.php">Inspección mensual de tableros electricos </option>

                    <option value="php/InspeccionTaller.php">Inspección de talleres </option>
                    <option value="php/GasComprimido.php">Check list almacenamiento de Gases Comprimidos</option>
                    <option value="php/ProductoQuimico.php">Inspección almacén de productos químicos</option>
                    <option value="php/instalacionElectrica.php">Instalaciones electricas temporales</option>
                    <option value="php/inspeccionDerrame.php">Inspección de Kit Antiderrame</option>
                    <option value="php/inspeccionCamilla.php">Inspección de camillas</option>
                    <option value="php/noConformidad.php">No Conformidad</option>
                </select>

        </div>
        <div class="bodyWrap">
        <button id="button_documento">Buscar</button>

        </div>

    </div>
</body>

</html>