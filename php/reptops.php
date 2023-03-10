<?php
    require_once("../inc/tables.inc.php");

    $row = reporteTops($pdo);
    $proyectos = proyectos($pdo);

    

    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION")?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/tops.js?<?php echo constant("VERSION")?>"></script>

    <title>Reporte Tops</title>
</head>
<body>
<div class="modal">
    <h1>Espere...</h1>
</div>
<div class="wrap">
    <div class="headerWrap">
        <h1>Listado de TOPs</h1>
    </div>
    <div class="divsearch">
        <div class="search">
            <input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
            <a href="#" id="btnExport">Exportar a Excel</a>
                        

        </div>
        <div class="options">
            <label for="mes">Mes</label>
            <input type="number" name="mes" id="mes" value="<?php echo date("m");?>" min="1" max="12">
            <label for="anio">Año</label>
            <input type="number" name="anio" id="anio" value="<?php echo date("Y");?>" min="2020" placeholder="año">
            <a href="#" id="btnBefore">Consultar Anteriores</a>
        </div> 
    </div>
    <div class="tableWrap">
            <table id="topsTable">
                <thead>
                    <tr>
                        <th width="20px">Código de la Obra</th>
                        <th width="140px">No.del Asunto/configurar para que salga un número unico</th>
                        <th width="90px">Fecha</th>
                        <th width="20px">Tipo de Observación</th>
                        <th width="20px">Detalle del Tipo de Observación</th>
                        <th width="20px">Clasificación SSMA</th>
                        <th width="250px">Reportado por:</th>
                        <th width="250px">Descripción de la Observación Acto o condición/Casi Accidente</th>
                        <th width="20px">Relacionado con</th>
                        <th width="150px">Tipo de Epp</th>
                        <th width="150px">Condición del epp</th>
                        <th width="150px">Potencial del Riesgo</th>
                        <th width="180px">Acciones para prevenir la repetición</th>
                        <th width="240px">Evidencia de la observación/caso accidente encontrado(registro,imagen o foto,otros)</th>
                        <th width="240px">Acción Inmediata (correctiva)/Que medidas correctivas se tomaron para eliminar el acto o condición sub estandar</th>
                        <th width="240px">Sugerencia para Acción de Mejora (si corresponde)</th>
                        <th width="80px">Supervisor Responsable</th>
                        <th width="120px">Evidencia de la acción implementada (registro, imagen o foto, otros)</th>
                        <th width="120px">Seguimiento</th>
                        <th width="20px">SEMANA</th>
                        <th width="120px">Detalle de Otros</th>
                        <th width="120px">Area Observada</th>
                        <th width="120px">Lugar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row?>
                </tbody>
            </table>       
    </div>
</body>

</html>