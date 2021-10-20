<?php

require_once "../words/words.php";

require_once "../inc/tables.inc.php";

$sede = $_GET['sede'];
$row = getReporteIpercByDate($pdo, $sede);

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css?<?php echo constant("VERSION") ?>">
	<link rel="stylesheet" href="../css/popup.css?<?php echo constant("VERSION") ?>">
	<script src="../js/jquery.js"></script>
	<script src="../js/iperc.js?<?php echo constant("VERSION") ?>"></script>
	<title>Reporte Tops</title>
</head>

<body>
	<div class="modal">
		<h1>Espere...</h1>
	</div>
	<div class="wrap">
		<div class="headerWrap">
			<h1>Reporte IPERC - <?php echo $_GET['nombre'] ?></h1>
		</div>
		<div class="divsearch">
			<div class="search">
				<input type="text" name="buscarDatos" id="buscarDatos" placeholder="Buscar...">
			</div>
			<div class="options">
				<label for="mes">Mes</label>
				<input type="number" name="mes" id="mes" value="<?php echo date("m"); ?>" min="1" max="12">
				<label for="anio">Año</label>
				<input type="number" name="anio" id="anio" value="<?php echo date("Y"); ?>" min="2020" placeholder="año"> <a href="#" id="btnBefore">Consultar Anteriores</a>
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
		<!--<form method="POST" id="formExcel">
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
            </form>-->


		<div class="tableWrap">
			<table id="topsTable">
				<thead>
					<tr>
						<th width="20px"> id </th>
						<th width="100px"> Elaborado por </th>
						<th width="100px"> Proyecto </th>
						<th width="100px"> Área </th>
						<th width="100px"> Área Observada</th>
						<th width="100px"> Ubicación </th>
						<th width="100px"> Tarea </th>
						<th width="50px"> fecha </th>
						<th width="100px"> Empresa </th>
						<th width="50px"> Detalle </th>
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
				<div class="close-btn clickPopup-close" onclick="togglePopup()">&times;</div>
				<div id="conten-data">
					<div class="content-move">
						<div class="item_popup">
							<p class="title_general" width="20px"> id </p>
							<p id="id"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Elaborado por </p>
							<p id="nombres_usuario"> </p>
							<p id="apellidos_usuario"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Proyecto </p>
							<p id="nombre_proyecto"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Área </p>
							<p id="nombre_area"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Área Observada</p>
							<p id="area_observada"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Ubicación </p>
							<p id="ubicacion"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Tarea </p>
							<p id="nombre_tarea"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> fecha </p>
							<p id="fecha"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Empresa </p>
							<p id="empresa"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px"> Registro </p>
							<p id="registro"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_1'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo1"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario1"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_2'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo2"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario2"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_3'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo3"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario3"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_4'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo4"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario4"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_5'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo5"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario5"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_6'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo6"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario6"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_7'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo7"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario7"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_8'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo8"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario8"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_9'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo9"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario9"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_10'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo10"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario10"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_11'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo11"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario11"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_12'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo12"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario12"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_13'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo13"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario13"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_14'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo14"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario14"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_15'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo15"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario15"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_16'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo16"> </p>
						</div>
						<div class="item_popup">
							<p id="comentario16"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO1'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico1"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO2'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico2"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO3'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico3"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO4'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico4"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO5'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico5"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO6'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico6"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO7'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico7"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO8'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico8"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_CRITICO9'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_critico9"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_MANO1'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_manos1"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_MANO2'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_manos2"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_MANO3'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_manos3"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID1'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid1"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID2'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid2"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID3'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid3"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID4'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid4"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID5'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid5"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID6'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid6"> </p>
						</div>
						<div class="item_popup">
							<p class="title_general" width="20px">
								<?php echo constant('RIESGO_COVID7'); ?>
							</p>
						</div>
						<div class="item_popup">
							<p id="riesgo_covid7"> </p>
						</div>
					</div>
				</div>
				<div class="loader"></div>
			</div>
		</div>
</body>

</html>