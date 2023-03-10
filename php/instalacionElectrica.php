<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = getReporteInstalacionElectrica($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/instalacionElectrica.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte - Instalaciones electricas temporales </title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>Instalaciones electricas temporales - <?php echo $_GET['nombre'] ?> </h3>
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
                        <th width="200px">Obra / Fase</th>
                        <th width="250px">Campamento</th>
                        <th width="250px">Elaborado por</th>
                        <th width="250px">Responsable</th>
                        <th width="20px">Fecha</th>
                        <th width="20px">Registro</th>
                        <th width="200px">Elemento</th>
                        <th width="200px">Estado</th>
                        <th width="200px">Observación</th>

                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>