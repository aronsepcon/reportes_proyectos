<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = repoSeguridad($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/seguridad.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte de Inspecciones </title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h3>INSPECCIÓN PLANEADA DE SEGURIDAD  - <?php echo $_GET['nombre'] ?> </h3>
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
                <a href="#" id="btnExportMatriz">Exportar Matriz a Excel</a>
            </div>
        </div>
        <!--
    <form method="POST" id="formExcel">
                <div class="divsearch">
                    <div class="search">
                        <label for="fechaInicio">Fecha de inicio</label>
                        <input type="date" id="fechaInicio" name="fechaInicio">
                        <label for="fechaFin">Fecha fin </label>
                        <input type="date" id="fechaFin" name="fechaFin"> 
                        
                        <a href="#" id="btnExport">Exportar a Excel</a> 

                    </div>
                </div>
            </form>

            <form method="POST" id="formExcelMatriz">
                <div class="divsearch">
                    <div class="search">
                        <label for="fechaInicioMatriz">Fecha de inicio</label>
                        <input type="date" id="fechaInicioMatriz" name="fechaInicioMatriz">
                        <label for="fechaFinMatriz">Fecha fin </label>
                        <input type="date" id="fechaFinMatriz" name="fechaFinMatriz"> 
                                                <a href="#" id="btnExportMatriz" >Exportar Matriz a Excel</a> 

                    </div>
                </div>
            </form>
-->


        <div class="tableWrap">
            <table id="seguridadTable">
                <thead>
                    <tr>
                        <th width="20px">ITEM</th>
                        <th width="140px">PROYECTO</th>
                        <th width="140px">ÁREA</th>
                        <th width="140px">UBICAIÓN</th>
                        <th width="90px">FECHA DE LA INSPECCIÓN </th>
                        <th width="20px">INSPECCIÓN REALIZADA POR</th>
                        <th width="20px">TIPO DE INSPECCIÓN</th>
                        <th width="140px">TIPO OBERVACIÓN</th>
                        <th width="20px">CONDICIÓN O ACTO SUBESTANDAR</th>
                        <th width="250px">EVIDENCIA DE LO ENCONTRADO (REGISTRO, IMAGEN O FOTO, OTROS)</th>
                        <th width="250px">ACCIÓN CORRECTIVA</th>
                        <th width="20px">CLASIFICACIÓN</th>
                        <th width="150px">DIAS DE IMPLEMENTACIÓN</th>
                        <th width="150px">FECHA DE IMPLEMENTACIÓN</th>
                        <th width="150px">RESPONSABLE DE LA EJECUCIÓN</th>
                        <th width="180px">EVIDENCIA DE LA ACCIÓN CORRECTIVA IMPLEMENTADA (REGISTRO, IMAGEN O FOTO)</th>
                        <th width="240px">COMENTARIOS ADICIONALES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>
</body>

</html>