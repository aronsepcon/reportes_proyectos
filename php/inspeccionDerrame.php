<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = getReporteInspeccionDerrame($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/inspeccionDerrame.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Inspeccion Kit Antiderrame.</title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>Inspeccion Kit Antiderrame - <?php echo $_GET['nombre'] ?> </h3>
        </div>
        <div class="divsearch">
            <div class="search">
                <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">


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
            <table id="tablaReporte">
                <thead>
                    <tr>
                        <th width="20px">Item</th>
                        <th width="90px">Sede </th>
                        <th width="20px">Área</th>
                        <th width="250px">Elaborado por</th>
                        <th width="250px">Responsable de la inspección</th>
                        <th width="20px">Fecha</th>
                        <th width="20px">Registro</th>
                        <th width="20px">Observaciones</th>

                        <th width="200px">Equipos Material para control de derrame </th>
                        <th width="200px">Bandeja de contención</th>
                        <th width="200px">Paños absorventes</th>
                        <th width="200px">Trapos industriales</th>
                        <th width="200px">Bolsas plásticas</th>
                        <th width="200px">Pala</th>
                        <th width="200px">Pico</th>
                        <th width="200px">Salchichas absorventes</th>
                        <th width="200px">Bolsas o sacos de propileno</th>
                        <th width="200px">Guantes de nitrilo</th>
                        <th width="200px">Respirador de media cara con filtro para vapores orgánicos</th>
                        <th colspan="3" width="200px">Otros 1</th>
                        <th colspan="3" width="200px">Otros 2</th>
                        <th colspan="3" width="200px">Otros 3</th>
                        <th colspan="3" width="200px">Otros 4</th>


                    </tr>

                    <tr>
                        <th width="20px"></th>
                        <th width="90px"></th>
                        <th width="20px"></th>
                        <th width="250px"></th>
                        <th width="250px"></th>
                        <th width="20px"></th>
                        <th width="20px"></th>
                        <th width="20px"></th>

                        <th width="200px">Cantidad de materiales en cada kit</th>
                        <th width="200px">1 equipos moviles</th>
                        <th width="200px">10 equipos / 20 estación</th>
                        <th width="200px">N.A</th>
                        <th width="200px">2 equipos /5 estación</th>
                        <th width="200px">1</th>
                        <th width="200px">1</th>
                        <th width="200px">5 equipos /10 estación</th>
                        <th width="200px">N.A</th>
                        <th width="200px">2 Pares ( estación), 1 par para equipos moviles</th>
                        <th width="200px">(Solo estación de emergencia 1)</th>
                        <th colspan="3" width="200px">Rollo de cinta de señalización( solo estacion)</th>
                        <th colspan="3" width="200px">Traje tivek (solo estacion)</th>
                        <th colspan="3" width="200px">Gafas 2par (solo estacion)</th>
                        <th colspan="3" width="200px"></th>


                    </tr>

                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>