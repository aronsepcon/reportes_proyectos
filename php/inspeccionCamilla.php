<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = getReporteInspeccionCamilla($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/inspeccionCamilla.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Inspección de camillas </title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>Inspección de camillas - <?php echo $_GET['nombre'] ?> </h3>
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
                        <th width="140px">Tipos inspección</th>
                        <th width="90px">Sede </th>
                        <th width="20px">Área</th>
                        <th width="20px">Lugar de inspección</th>
                        <th width="250px">Elaborado por</th>
                        <th width="20px">Responsable del área</th>
                        <th width="250px">fecha</th>
                        <th width="20px">resgistro</th>
                        
                        <th width="150px">Ubicación</th>
                        <th width="150px">Condicones de la camilla</th>
                        <th width="150px">Collarín cervical regulable</th>
                        <th width="150px">Fijador de cabeza</th>
                        <th width="150px">Ubicación de la camilla disponible</th>
                        <th width="150px">Señalización de camilla</th>
                        <th width="150px">Férulas neumaticas de 6 piezas</th>
                        <th width="150px">Arnés de sujección corporal</th>
                        <th width="150px">Protección de la camilla</th>


                        <th width="180px">Clasificación</th>
                        <th width="240px">Acción correctiva</th>
                        <th width="240px">Fecha de cumplimiento</th>
                        <th width="240px">Seguimiento</th>

                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>