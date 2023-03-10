<?php
    require_once("../inc/tables.inc.php");

    $row = reporteTops($pdo);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION")?>">

    <script src="../js/jquery.js"></script>
    <script src="../js/matriz.js?<?php echo constant("VERSION")?>"></script>

    <title>Matriz Mensual</title>
</head>
<body>
<div class="modal">
    <h1>Espere...</h1>
</div>
<div class="wrap">
    <div class="headerWrap">
        <h1>Matriz Mensual</h1>
    </div>

<!--
    <div class="divsearch">

        <div class="options">
            <label for="mes">Mes</label>
            <input type="number" name="mes" id="mes" value="<?php echo date("m");?>" min="1" max="12">
            <label for="anio">Año</label>
            <input type="number" name="anio" id="anio" value="<?php echo date("Y");?>" min="2020" placeholder="año">
        </div> 
        <div class="search">
            <a href="#" id="btnExportMatriz">Exportar a Excel</a>
        </div>
    </div>
-->

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

    <div class="tableWrap">
             
    </div>
</body>

</html>