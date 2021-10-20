<?php
require_once("../inc/tables.inc.php");

$sede = $_GET['sede'];
$row = reporteTopsNuevo($pdo, $sede);
$proyectos = proyectos($pdo);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
    <link rel="stylesheet" href="../css/popup.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/topsNuevo.js?<?php echo constant("VERSION") ?>"></script>

    <title>Reporte Tops</title>
</head>

<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h1>Tops - <?php echo $_GET['nombre'] ?> </h1>
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
                <a href="#" id="btnExportMatriz">Exportar Matriz a Excel</a>
            </div>
        </div>
        <!--</form> -->
        <!--
        <form method="POST" id="formExcelMatriz">
            <div class="divsearch">
                <div class="search">
                    <label for="fechaInicioMatriz">Fecha de inicio</label>
                    <input type="date" id="fechaInicioMatriz" name="fechaInicioMatriz">
                    <label for="fechaFinMatriz">Fecha fin </label>
                    <input type="date" id="fechaFinMatriz" name="fechaFinMatriz">

                    <a href="#" id="btnExportMatriz">Exportar Matriz a Excel</a>
                </div>
            </div>
        </form>
-->
        <div class="tableWrap">
            <table id="topsTableNuevo">
                <thead>
                    <tr>
                        <th width="20px">ID</th>
                        <th width="90px">Reportado por</th>
                        <th width="20px">Proyecto</th>
                        <th width="20px">Área</th>
                        <th width="250px">Ubicación</th>
                        <th width="250px">Área Observada</th>
                        <th width="20px">Puesto del observado</th>
                        <th width="120px">Tiempo en el proyecto</th>
                        <th width="120px">Horario </th>
                        <th width="120px">Rango de edad</th>
                        <th width="120px">Fecha</th>
                        <th width="120px">Registro</th>
                        <th width="20px">Tipo de Observación</th>
                        <th width="20px">Detalle del Tipo de Observación</th>
                        <th width="20px">Relacionado con</th>
                        <th width="20px">Otros</th>

                        <th width="150px">Tipo de Epp</th>
                        <th width="150px">Condición del epp</th>
                        <th width="250px">Descripción de la Observación Acto o condición/Casi Accidente</th>
                        <th width="240px">Acción Inmediata (correctiva)/Que medidas correctivas se tomaron para eliminar el acto o condición sub estandar</th>
                        <th width="150px">Potencial del Riesgo</th>
                        <th width="240px">Evidencia de la observación/caso accidente encontrado(registro,imagen o foto,otros)</th>
                        <th width="120px">Lesión</th>
                        <th width="120px">Obstaculo</th>
                        <th width="120px">Cambio observado</th>
                        <th width="120px">Retroalimentación </th>
                        <th width="120px">Reincidente</th>
                        <th width="120px">Comentario</th>
                        <th width="120px">Editar potencial</th>

                    </tr>
                </thead>
                <tbody>
                    <?php echo $row ?>
                </tbody>
            </table>
        </div>

        <!-- ESTE ES EL POPUP  -->
        <div class="popup" id="popup-1">
            <div class="overlay"></div>
            <div class="content">
                <div id="conten-data">
                    <input type="hidden" id="nombre_supervisor">
                    <input type="hidden" id="dni_supervisor">
                    <input type="hidden" id="id_documento">

                    <div class="content-move">

                        <form class="div-popup" method="POST" id="formpopup">

                            <h4>¿Cuál es el potencial de pérdida?</h4>
                            <select id="listaPotencial" name="potencial">

                            </select>
                            <!-- ACTUALIZAMOS EL DOCUMENTO CON EL SUPERVISOR ASIGNADO Y FECHA DE CONTRATO-->
                            <div class="center div-top">
                                <button class="buttonAdd" type="submit" id="btnUpdateDocumento">Actualizar</button>
                                <button class="buttonDeletePopup clickPopup-close" type="submit" id="btnUpdateDocumento">Cancelar</button>

                            </div>

                        </form>

                    </div>
                </div>
                <div class="loader"></div>
            </div>
        </div>
</body>

</html>