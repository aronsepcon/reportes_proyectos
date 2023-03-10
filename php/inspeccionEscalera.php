<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = getReporteInspeccionEscalera($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/inspeccionEscalera.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Inspección escalera </title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>Inspección de escaleras fijas y portátiles - <?php echo $_GET['nombre'] ?> </h3>
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
                        <th width="200px">Sede </th>
                        <th width="200px">Área</th>
                        <th width="200px">Supervisor</th>
                        <th width="100px">Empresa</th>
                        <th width="200px">Elaborado por</th>
                        <th width="100px">fecha</th>
                        <th width="100px">resgistro</th>
                        
                        <th width="150px">Codigo</th>
                        <th width="150px">Tipo</th>
                        <th width="180px">Condición</th>
                        <th width="240px">Comentarios</th>

                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>