<?php
    require_once('../inc/tables.inc.php');

    $sede = $_GET['sede'];
    $row = reporteNoConformidadNuevo($pdo, $sede);
    $proyectos = proyectos($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
    <link rel="stylesheet" href="../css/popup.css?<?php echo constant("VERSION") ?>">

    <script src="../js/jquery.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="modal">
        <h1>Espere...</h1>
    </div>
    <div class="wrap">
        <div class="headerWrap">
            <h1>No Conformidad - <?php echo $_GET['nombre']?></h1>
        </div>
        <div class="tableWrap">
            <table>
                <thead>
                    <tr>
                        <th colspan="6">Datos Generales</th>
                        <th>Descripción de la No Conformidad/Producto No Conforme</th>
                        <th colspan="6">Correccion - Accion Inmediata</th>
                        <th colspan="5">Acciones Correctivas</th>
                        <th colspan="2">Verificacion de Eficacia</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <th width="20px">ID</th>
                        <th>Fecha de Reporte</th>
                        <th>Tipo</th>
                        <th>Origen</th>
                        <th>Sede/Proyecto</th>
                        <th>Area</th>
                        <th>Proceso</th>
                        <th>Descripcion</th>
                        <th>Accion Inmediata/Correccion</th>
                        <th>Responsable</th>
                        <th>Fecha Limite</th>
                        <th>Fecha de Reporte de Evidencia</th>
                        <th>Estado de Accion</th>
                        <th>Accion Correctiva</th>
                        <th>Responsable</th>
                        <th>Fecha Limite</th>
                        <th>Fecha de Reporte de Evidencia</th>
                        <th>Estado de Accion</th>
                        <th>Fecha Propuesta</th>
                        <th>Fecha de Cierre/SM</th>
                        <th>Estado de solicitud de Mejora del SGI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>