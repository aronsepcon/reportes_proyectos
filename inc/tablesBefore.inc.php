<?php
    require_once("mysql_conector.inc.php");
    require_once("constantes.inc.php");
    require_once "../words/words.php";

    $respuestaOK = true;
    $contenidoOk = "No hay error";
    $Error = "";

    $sede   = $_POST['sede'];
    $mes    = $_POST['me'];
    $anio   = $_POST['an'];
    $doc    = $_POST['doc'];

    switch ($doc) {
        case 'tops':
            $contenidoOk = consulTops($pdo,$mes,$anio);
            break;
        case 'seguridad':
            $contenidoOk = consultSafety($pdo,$mes,$anio,$sede);
            break;
        case 'incidencias':
            $contenidoOk = consultIncidency($pdo,$mes,$anio,$sede);
            break;
        case 'iperc':
            $contenidoOk = consultIperc($pdo,$mes,$anio,$sede);
            break;
        case 'opt':
            $contenidoOk = consultOpt($pdo, $mes, $anio,$sede);
            break;  

        case 'riesgos':
            $contenidoOk = consultRiesgos($pdo, $mes, $anio,$sede);
            break; 
        case 'topsNuevo':
            $contenidoOk = consultTopsNuevo($pdo, $mes, $anio,$sede);
            break;
        case 'ipercNuevo':
            $contenidoOk = consultIpercNuevo($pdo, $mes, $anio,$sede);
            break;
        case 'inspeccionAlmacen':
            $contenidoOk = consultReporteInspeccionAlmacen($pdo, $mes, $anio,$sede);
            break;
    
        case 'inspeccionOficina':
            $contenidoOk = consultReporteInspeccionOficina($pdo, $mes, $anio,$sede);
            break;
    }


    $salidaJson = array("respuesta" => $respuestaOK,
					    "error"     => $Error,
					    "contenido" => $contenidoOk);

    echo json_encode($salidaJson);
    

    function consultIncidency($pdo,$mes,$anio,$sede){
        /*$query = "SELECT
            incidencias.iddoc,
            incidencias.proyecto,
            incidencias.cliente,
            incidencias.lugar,
            incidencias.fecha,
            incidencias.hora,
            incidencias.descripcion,
            incidencias.reg,
            incidencias.elaborado,
            incidencias.foto
        FROM incidencias
        WHERE 
        MONTH(reg) = $mes AND
        YEAR(reg) = $anio";*/

        $TODOS_PROYECTOS = 100;
        $sedeSQL = "proyecto <> '$sede'";

        if($sede!= $TODOS_PROYECTOS){
            $sedeSQL = "proyecto = '$sede'";
        }

        $query = "SELECT
        incidencias.iddoc,
        incidencias.proyecto,
        incidencias.cliente,
        incidencias.lugar,
        incidencias.fecha,
        incidencias.hora,
        incidencias.descripcion,
        incidencias.reg,
        incidencias.elaborado,
        incidencias.foto, 
        proyectos.nombre AS nombreProyecto
        FROM
        incidencias
        INNER JOIN general AS proyectos ON incidencias.proyecto = proyectos.cod
        WHERE
        MONTH(incidencias.fecha) = $mes AND
        YEAR(incidencias.fecha) = $anio AND 
        proyectos.clase = 00 AND $sedeSQL order by incidencias.fecha desc";
        

        $statement 	= $pdo->prepare($query);
        $statement -> execute(array());
        $results 	= $statement ->fetchAll();
        $rowaffect 	= $statement->rowCount($query);
        $salida 	= "";
        $item = 1;

        if($rowaffect > 0) {
            foreach ($results as $rs) {
                
                $salida .= '<tr>
                                <td>'.$item.'</td>
                                <td>'.$rs['nombreProyecto'].'</td>
                                <td>'.$rs['cliente'].'</td>
                                <td>'.$rs['lugar'].'</td>
                                <td class="center">'.date("d/m/Y", strtotime($rs['fecha'])).'</td>
                                <td class="center">'.$rs['hora'].'</td>
                                <td>'.$rs['descripcion'].'</td>
                                <td>'.$rs['elaborado'].'</td>
                                <td class="center"><a href="'.$rs['iddoc'].'"><i class="fas fa-file-pdf"></i></a></td> 
                            </tr>';
                $item++;
            }
        }else{
            $salida = '<tr><td colspan="22" class="center"><h2>No hay registros para mostrar</h2></td></tr>';
        }

        return $salida;
    }


    function consultSafety($pdo,$mes,$anio,$sede) {

        $TODOS_PROYECTOS = 100;
        $sedeSQL = "sede <> '$sede'";
    
        if($sede!= $TODOS_PROYECTOS){
            $sedeSQL = "sede = '$sede'";
        }

        $query = "SELECT
                    detseguridad.idreg,
                    detseguridad.iddoc,
                    detseguridad.condicion,
                    detseguridad.clasificacion,
                    detseguridad.accion,
                    detseguridad.fecha,
                    detseguridad.seguimiento,
                    inspeccion_tipo.nombre AS tipo,
                    seguridad.sede,
                    seguridad.lugar,
                    seguridad.fecha AS fechaInspeccion,
                    seguridad.inspeccionado,
                    seguridad.responsable,
                    seguridad.obser01,
                    seguridad.obser02,
                    seguridad.obser03,
                    seguridad.reg,
                    detseguridad.evidencia,
                    proyectos.nombre AS proyecto ,

                    seguridad.ubicacion,
                    area_general.nombre AS area_nombre,
                    tipo_observacion.nombre AS  tipo_observacion


                FROM
                    detseguridad
                    INNER JOIN seguridad ON detseguridad.iddoc = seguridad.iddoc
                    INNER JOIN general AS proyectos ON seguridad.sede = proyectos.cod 
                    INNER JOIN area_general ON seguridad.idAreaObservada= area_general.id
                    INNER JOIN tipo_observacion ON detseguridad.tipo = tipo_observacion.id
                    INNER JOIN inspeccion_tipo ON inspeccion_tipo.id = seguridad.tipo

                WHERE
                    proyectos.clase = '00' AND
                    MONTH(seguridad.fecha) = $mes AND
                    YEAR(seguridad.fecha) = $anio AND $sedeSQL ORDER BY seguridad.fecha DESC";
        $statement 	= $pdo->prepare($query);
        $statement -> execute(array());
        $results 	= $statement ->fetchAll();
        $rowaffect 	= $statement->rowCount($query);
        $salida 	= "";


        $clas = ["","A","B","C"];
        $item = 1;

        if($rowaffect > 0) {
            foreach ($results as $rs) {
                

                
            $evidencia = explode(",", $rs['evidencia']);

            $evidencia = explode(",", $rs['evidencia']);

            $listaImagenes = '';
            $listaArchivos = '';

            foreach ($evidencia as $elemento) {
                if (strlen($elemento) > 0) {

                    if( strpos($elemento, '.pdf') > 0){

                        $listaArchivos .= ('<a href="'.CONSTANT('URL').$elemento.'"> <br>');
                    }
                    if( strpos($elemento, '.jpg') > 0 || strpos($elemento, '.png') > 0){

                        $listaImagenes .=  ('<img style="height:100px; width:100px;" src="../../ssma/public/photos/'.$elemento.'"><br>');
                    }
                
                }
            }

                $salida .= '<tr>
                                
                                 <td>'.$rowaffect.'</td>
                            <td>'.$rs['proyecto'].'</td>
                            
                            <td>'.$rs['area_nombre'].'</td>
                            <td>'.$rs['ubicacion'].'</td>

                            <td class="center">'.date("d/m/Y", strtotime($rs['fechaInspeccion'])).'</td>
                            <td>'.strtoupper($rs['inspeccionado']).'</td>
                            <td>'.$rs['tipo'].'</td>
                            
                            <td>'.$rs['tipo_observacion'].'</td>

                            <td>'.$rs['condicion'].'</td>
                            <td>'.$listaArchivos.$listaImagenes.'</td>
                            <td>'.$rs['accion'].'</td>
                            <td class="center">'.$clas[(int)$rs['clasificacion']].'</td>
                            <td>'.$rs['seguimiento'].'</td>
                            <td>'.date("d/m/Y", strtotime($rs['fecha'])).'</td>
                            <td>'.strtoupper($rs['responsable']).'</td>
                            <td></td>
                            <td></td>

                            </tr>';
                $rowaffect--;
            }
        }else{
            $salida = '<tr><td colspan="22" class="center"><h2>No hay registros para mostrar</h2></td></tr>';
        }

        return $salida;
    }


    function consulTops($pdo,$mes,$anio){
        $query = "SELECT
                        tops.idtop,
                        tops.lugar,
                        tops.reportado,
                        tops.fecha,
                        tops.observacion,
                        tops.actins,
                        tops.conins,
                        tops.actseg,
                        tops.relacion,
                        tops.descripcion,
                        tops.medidas,
                        tops.potencial,
                        tops.reg,
                        tops.conepp,
                        tops.tipepp,
                        tops.otros,
                        tops.area,
                        tops.foto,
                        tops.iduser,
                        tops.sede
                        FROM
                        tops
                        WHERE MONTH(reg) = $mes AND
                            YEAR(reg) = $anio 
                         /*GROUP BY
                        tops.descripcion*/
                        ORDER BY
                        tops.reg DESC";

                $statement 	= $pdo->prepare($query);
                $statement -> execute(array());
                $results 	= $statement ->fetchAll();
                $rowaffect 	= $statement->rowCount($query);
                $salida 	= "";

                $sede  = master($pdo,"00");
                $obser = master($pdo,"01");
                $relac = master($pdo,"02");

                $actins =  master($pdo,"06");
                $conins =  master($pdo,"07");
                $acseg  =  master($pdo,"08");

                $tipo = master($pdo,"03");
                $condicion = master($pdo,"04");
                $potencial = master($pdo,"05");
                $area = master($pdo,"09");

                if($rowaffect > 0) {
                    foreach ($results as $rs) {

                        $rel = $rs['relacion'] != "00" ? $relac[(int)$rs['relacion']] : "OTROS";
                        $tip = $rs['tipepp'] != "00" ? $tipo[(int)$rs['tipepp']] : "";
                        $con = $rs['conepp'] != "00" ? $condicion[(int)$rs['conepp']] : "";
                        $pot = $rs['potencial'] != "00" ? $potencial[(int)$rs['potencial']] : "";
                        $are = $rs['area'] != "00" ? $area[(int)$rs['area']] : "";

                        if ( $rs['actins'] != "00" ) {
                            $des = $actins[(int)$rs['actins']];
                        }elseif( $rs['conins'] != "00" ) {
                            $des = $conins[(int)$rs['conins']];
                        }elseif( $rs['actseg'] != "00" ){
                            $des = $acseg[(int)$rs['actseg']];
                        }
                        else{
                            $des = "";
                        }

                        $foto = $rs['foto'] != "" ? '<img src="'.constant("URL")."photos/".$rs['foto'].'" class="imgRow">' : "";
                        $salida .= '<tr>
                                        <td>'.$sede[(int)$rs['sede']].'</td>
                                        <td></td>
                                        <td>'.date("d/m/Y", strtotime($rs['fecha'])).'</td>
                                        <td class="center">'.$obser[(int)$rs['observacion']].'</td>
                                        <td>'.$des.'</td>
                                        <td></td>
                                        <td>'.$rs['reportado'].'</td>
                                        <td>'.$rs['descripcion'].'</td>
                                        <td>'.$rel.'</td>
                                        <td>'.$tip.'</td>
                                        <td>'.$con.'</td>
                                        <td>'.$pot.'</td>
                                        <td></td>
                                        <td class="center">'.$foto.'</td>
                                        <td>'.$rs['medidas'].'</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>'.$rs['otros'].'</td>
                                        <td>'.$are.'</td>
                                    </tr>';
                    }
                }else{
                    $salida = '<tr><td colspan="22" class="center"><h2>No hay registros para mostrar</h2></td></tr>';
                }

                return $salida;
    };

    function master($pdo,$clase) {
        $query = "SELECT
                    general.nombre
                    FROM
                    general
                    WHERE
                    general.clase = '$clase'";

        $statement  = $pdo->prepare($query);
        $statement -> execute(array());
        $results    = $statement ->fetchAll();
        $rowaffect  = $statement->rowCount($query);
        $salida     = []; 

        foreach ($results as $rs ) {
            # code...
            array_push($salida, $rs['nombre']);
        }

        return $salida;
    }

    function consultIperc($pdo, $mes, $anio,$sede)
{

    $TODOS_PROYECTOS = 100;
    $sedeSQL = " idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = " idProyecto = '$sede'";
    }

    $query = "SELECT id,
    idProyecto,
    nombre_proyecto,
    nombre_area,
    area_observada,
    ubicacion,
    nombre_tarea ,
    fecha,
    nombres_usuario,
    apellidos_usuario,
    empresa,
    registro ,

    riesgo1 ,
    comentario1 ,
    riesgo2 ,
    comentario2 ,
    riesgo3 ,
    comentario3 ,
    riesgo4 ,
    comentario4 ,
    riesgo5 ,
    comentario5 ,
    riesgo6 ,
    comentario6 ,
    riesgo7 ,
    comentario7 ,
    riesgo8 ,
    comentario8 ,
    riesgo9 ,
    comentario9 ,
    riesgo10 ,
    comentario10 ,
    riesgo11 ,
    comentario11 ,
    riesgo12 ,
    comentario12 ,
    riesgo13 ,
    comentario13 ,
    riesgo14 ,
    comentario14 ,
    riesgo15 ,
    comentario15 ,
    riesgo16 ,
    comentario16 ,
    riesgo_critico1 ,
    riesgo_critico2 ,
    riesgo_critico3 ,
    riesgo_critico4 ,
    riesgo_critico5 ,
    riesgo_critico6 ,
    riesgo_critico7 ,
    riesgo_critico8 ,
    riesgo_critico9 ,
    riesgo_manos1 ,
    riesgo_manos2 ,
    riesgo_manos3 ,
    riesgo_covid2 ,
    riesgo_covid3 ,
    riesgo_covid4 ,
    riesgo_covid5 ,
    riesgo_covid6 ,
    riesgo_covid7 FROM view_iperc WHERE MONTH(fecha) = $mes AND  YEAR(fecha) = $anio AND $sedeSQL ORDER BY fecha DESC ";

    $statement = $pdo->prepare($query);
    $statement->execute(array());
    $results = $statement->fetchAll();

    $salida = "";
    foreach ($results as $rs) {

        $data =
            $rs['id'] . '&' .
            $rs['nombre_proyecto'] . '&' .
            $rs['nombre_area'] . '&' .
            $rs['ubicacion'] . '&' .
            $rs['nombre_tarea'] . '&' .
            $rs['fecha'] . '&' .
            $rs['nombres_usuario'] . '&' .
            $rs['apellidos_usuario'] . '&' .
            $rs['empresa'] . '&' .
            $rs['registro'] . '&' .

            $rs['riesgo1'] . '&' .
            $rs['comentario1'] . '&' .
            $rs['riesgo2'] . '&' .
            $rs['comentario2'] . '&' .
            $rs['riesgo3'] . '&' .
            $rs['comentario3'] . '&' .
            $rs['riesgo4'] . '&' .
            $rs['comentario4'] . '&' .
            $rs['riesgo5'] . '&' .
            $rs['comentario5'] . '&' .
            $rs['riesgo6'] . '&' .
            $rs['comentario6'] . '&' .
            $rs['riesgo7'] . '&' .
            $rs['comentario7'] . '&' .
            $rs['riesgo8'] . '&' .
            $rs['comentario8'] . '&' .
            $rs['riesgo9'] . '&' .
            $rs['comentario9'] . '&' .
            $rs['riesgo10'] . '&' .
            $rs['comentario10'] . '&' .
            $rs['riesgo11'] . '&' .
            $rs['comentario11'] . '&' .
            $rs['riesgo12'] . '&' .
            $rs['comentario12'] . '&' .
            $rs['riesgo13'] . '&' .
            $rs['comentario13'] . '&' .
            $rs['riesgo14'] . '&' .
            $rs['comentario14'] . '&' .
            $rs['riesgo15'] . '&' .
            $rs['comentario15'] . '&' .
            $rs['riesgo16'] . '&' .
            $rs['comentario16'] . '&' .
            $rs['riesgo_critico1'] . '&' .
            $rs['riesgo_critico2'] . '&' .
            $rs['riesgo_critico3'] . '&' .
            $rs['riesgo_critico4'] . '&' .
            $rs['riesgo_critico5'] . '&' .
            $rs['riesgo_critico6'] . '&' .
            $rs['riesgo_critico7'] . '&' .
            $rs['riesgo_critico8'] . '&' .
            $rs['riesgo_critico9'] . '&' .
            $rs['riesgo_manos1'] . '&' .
            $rs['riesgo_manos2'] . '&' .
            $rs['riesgo_manos3'] . '&' .
           
            $rs['riesgo_covid2'] . '&' .
            $rs['riesgo_covid3'] . '&' .
            $rs['riesgo_covid4'] . '&' .
            $rs['riesgo_covid5'] . '&' .
            $rs['riesgo_covid6'] . '&' .
            $rs['riesgo_covid7'] . '&' .
            $rs['area_observada'];

        $salida .= '<tr>

                    <td>' . $rs['id'] . '</td>
                    <td>' . $rs['nombres_usuario'] . ' ' . $rs['apellidos_usuario'] . '</td>
                    <td>' . $rs['nombre_proyecto'] . '</td>
                    <td>' . $rs['nombre_area'] . '</td>
                    <td>' . $rs['area_observada'] . '</td>
                    <td>' . $rs['ubicacion'] . '</td>
                    <td>' . $rs['nombre_tarea'] . '</td>
                    <td>' . $rs['fecha'] . '</td>
                    <td>' . $rs['empresa'] . '</td>


                    <td value="' . $data . '"> <button class="getDetail">Detalle </button> </td>



                    </tr>';

    }

    return $salida;

}

function consultOpt($pdo, $mes, $anio,$sede){
        
    $TODOS_PROYECTOS = 100;
    $sedeSQL = " idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = " idProyecto = '$sede'";
    }

    $query = "SELECT
    id ,
    usuario_nombres ,
    usuario_apellidos ,
    proyecto_nombre ,
    area_nombre ,
    ubicacion,
    area_observada_nombre,
    tiempo_proyecto,
    fecha ,
    registro ,
    nombre ,
    tiempo_trabajo,
    guardia,
    ocupacion ,
    tarea ,
    razon_opt ,
    oportunidades ,
    firma_gerente ,
    area  ,
    responsable ,
        riesgoCritico,
        petLog
    FROM view_opt WHERE MONTH(registro) = $mes AND YEAR(registro) = $anio AND $sedeSQL ORDER BY registro desc ";
   
   $salida  = "";

   $statement  = $pdo->prepare($query);
   $statement -> execute(array());
   $results    = $statement ->fetchAll();
   $rowaffect = $statement->rowCount($query);

   foreach($results as $rs ){
      

        $salida .= '<tr>

                        <td>'.$rowaffect.'</td>
                        <td>'.$rs['usuario_nombres'].$rs['usuario_apellidos'].'</td>
                        <td>'.$rs['proyecto_nombre'].'</td>
                        <td>'.$rs['area_nombre'].'</td>
                        <td>'.$rs['ubicacion'].'</td>
                        <td>'.$rs['area_observada_nombre'].'</td>
                        <td>'.$rs['tiempo_proyecto'].'</td>
                
                        <td>'.$rs['registro'].'</td>
                        <td>'.$rs['nombre'].'</td>
                        <td>'.$rs['tiempo_trabajo'].'</td>
                        <td>'.$rs['guardia'].'</td>
                        <td>'.$rs['ocupacion'].'</td>
                        <td>'.$rs['tarea'].'</td>
                        <td>'.$rs['responsable'].'</td>
                        <td>'.$rs['riesgoCritico'].'</td>
                        <td>'.$rs['petLog'].'</td>
                        <td>'.$rs['razon_opt'].'</td>
                        <td>'.$rs['oportunidades'].'</td>
                        <td>'.$rs['firma_gerente'].'</td>
                       
                                

                        <td> <button class="getDetail">Detalle </button> </td>



                    </tr>';

                    $rowaffect--;
    }

    return $salida;
}

function consultRiesgos($pdo,$mes,$anio,$sede){

    $TODOS_PROYECTOS = 100;
    $sedeSQL = "idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "idProyecto = '$sede'";
    }

    $query = "  SELECT 
    id,
    usuario_nombres,
    usuario_apellidos,
    proyecto_nombre,
    area_nombre,
    area_observada_nombre,
    ubicacion,

    tarea_auditada ,
    lider_auditoria,
    participantes,
    empresa,
    fecha ,
    fortalezas_acciones,
    fecha_cumplimiento,
    responsable,
    registro

    FROM view_documento_riesgo  WHERE MONTH(fecha) = $mes AND YEAR(fecha) = $anio  AND $sedeSQL ORDER BY fecha desc ";
   
   $salida  = "";

   $statement  = $pdo->prepare($query);
   $statement -> execute(array());
   $results    = $statement ->fetchAll();
   $rowaffect = $statement->rowCount($query);

   foreach($results as $rs ){
      
   
        $salida .= '<tr>

                        <td>'.$rowaffect.'</td>
                        <td>'.$rs['usuario_nombres'].$rs['usuario_apellidos'].'</td>
                        <td>'.$rs['proyecto_nombre'].'</td>
                        <td>'.$rs['area_nombre'].'</td>
                        <td>'.$rs['ubicacion'].'</td>
                        <td>'.$rs['area_observada_nombre'].'</td>
                        <td>'.$rs['tarea_auditada'].'</td>
                        <td>'.$rs['lider_auditoria'].'</td>
                        <td>'.$rs['participantes'].'</td>
                        <td>'.$rs['empresa'].'</td>
                        <td>'.$rs['fecha'].'</td>
                        <td>'.$rs['fortalezas_acciones'].'</td>
                        <td>'.$rs['fecha_cumplimiento'].'</td>
                        <td>'.$rs['responsable'].'</td>

                                                      
                    </tr>';
        
                    $rowaffect--;
    }

    return $salida;
}

function consultTopsNuevo($pdo, $mes, $anio,$sede) {


    $TODOS_PROYECTOS = 100;
    $sedeSQL = "sede <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "sede = '$sede'";
    }

    $query = "SELECT
                idtop,
                lugar,
                reportado,
                fecha,
                observacion,
                actins,
                conins,
                actseg,
                relacion,
                descripcion,
                medidas,
                potencial,
                reg,
                conepp,
                tipepp,
                otros,
                area,
                foto,
                iduser,
                sede,
                observado_lugar,
                observado_puesto,
                tiempo_proyecto,
                horario_observacion,
                rango_edad,
                lesion,
                obstaculo,
                observado_cambio ,
                observado_retroalimentacion,
                observado_reincidente,
                observado_comentario,
                area_nombre

                FROM
                view_tops 
                
                    WHERE MONTH(reg) = $mes AND
                        YEAR(reg) = $anio AND $sedeSQL
                   
                    ORDER BY
                    view_tops.reg DESC";

    $statement  = $pdo->prepare($query);
    $statement -> execute(array());
    $results    = $statement ->fetchAll();
    $rowaffect  = $statement->rowCount($query);

    $salida     = " ";

    $sede  = master($pdo,"00");
    
    
    $obser = master($pdo,"01");
    $relac = master($pdo,"02");

    $actins =  master($pdo,"06");
    $conins =  master($pdo,"07");
    $acseg  =  master($pdo,"08");

    $tipo = master($pdo,"03");
    $condicion = master($pdo,"04");
    $potencial = master($pdo,"05");
    $area = master($pdo,"09");
    $idRow=1;

    foreach ($results as $rs) {
        $rel = $rs['relacion'] != "00" ? $relac[(int)$rs['relacion']] : "OTROS";
        $tip = $rs['tipepp'] != "00" ? $tipo[(int)$rs['tipepp']] : "";
        $con = $rs['conepp'] != "00" ? $condicion[(int)$rs['conepp']] : "";
        $pot = $rs['potencial'] != "00" ? $potencial[(int)$rs['potencial']] : "";
        $area_text = $rs['area'] != "00" ? $area[(int)$rs['area']] : "";

        $observacion_detalle = "";
        if ( $rs['actins'] != "00" ) {

            $observacion_detalle =  $actins[(int)$rs['actins']];
        }elseif( $rs['conins'] != "00" ) {

            $observacion_detalle =  $conins[(int)$rs['conins']];
        }elseif( $rs['actseg'] != "00" ){

            $observacion_detalle =  $acseg[(int)$rs['actseg']];
        }

        $observado_cambio=$rs['observado_cambio'] == '1' ? 'Si' : 'No';
        $observado_retroalimentacion=$rs['observado_retroalimentacion'] == '1' ? 'Si' : 'No';
        $observado_reincidente=$rs['observado_reincidente'] == '1' ? 'Si' : 'No';

        $foto = $rs['foto'] != "" ? '<img src="'.constant("URL_PHOTO")."photos/".$rs['foto'].'" class="imgRow">' : "";
        $salida .= '<tr>

        <td>'.$rowaffect.'</td>
        <td>'.$rs['reportado'].'</td>
        <td>'.$sede[(int)$rs['sede']].'</td>
        <td>'.$rs['area_nombre'].'</td>
        <td>'.$rs['observado_lugar'].'</td>
        <td>'.$area_text.'</td>
        <td>'.$rs['observado_puesto'].'</td>
        <td>'.$rs['tiempo_proyecto'].'</td>
        <td>'.$rs['horario_observacion'].'</td>
        <td>'.$rs['rango_edad'].'</td>
        <td>'.date("d/m/Y", strtotime($rs['fecha'])).'</td>
        <td>'.date("d/m/Y", strtotime($rs['reg'])).'</td>
        <td class="center">'.getObservacion($rs['observacion']).'</td>
        <td>'.$observacion_detalle.'</td>    
        <td>'.$rel.'</td>
        <td>'.$rs['otros'].'</td>
        <td>'.$tip.'</td>
        <td>'.$con.'</td>
        <td>'.$rs['descripcion'].'</td>
        <td>'.$rs['medidas'].'</td>
        <td>'.$pot.'</td>
        <td class="center">'.$foto.'</td>
        <td>'.$rs['lesion'].'</td>
        <td>'.$rs['obstaculo'].'</td>
        <td>'.$observado_cambio.'</td>
        <td>'.$observado_retroalimentacion.'</td>
        <td>'.$observado_reincidente.'</td>
        <td>'.$rs['observado_comentario'].'</td>

    </tr>';     

    $rowaffect--;
    }

    return $salida;
}



function getObservacion($idObservacion){
    $data='[{"id":"01","state":false,"nombre":"Acto sub estándar "},{"id":"02","state":false,"nombre":"Condición sub estándar"},{"id":"03","state":false,"nombre":"Acto Seguro"}]';
    $json=json_decode($data,true);

    $name="";

    foreach ($json as $value) {
        if($value['id']==$idObservacion){
            $name=$value['nombre'];
        }    
    }

    return $name;
}



function consultIpercNuevo($pdo, $mes, $anio,$sede)
{

    
    $TODOS_PROYECTOS = 100;
    $sedeSQL = " idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = " idProyecto = '$sede'";
    }

    $query = "SELECT id,
            idProyecto,
            nombre_proyecto,
            nombre_area,
            area_observada,
            ubicacion,
            nombre_tarea ,
            fecha,
            nombres_usuario,
            apellidos_usuario,
            empresa,
            tipoRiesgo,
            registro  FROM view_iperc_nuevo WHERE MONTH(registro) = $mes AND  YEAR(registro) = $anio AND $sedeSQL ORDER BY registro DESC ";

    $statement = $pdo->prepare($query);
    $statement->execute(array());
    $results = $statement->fetchAll();

    $salida = "";
    foreach ($results as $rs) {
        $salida .= '<tr>

                    <td>' . $rs['id'] . '</td>
                    <td>' . $rs['nombres_usuario'] . ' ' . $rs['apellidos_usuario'] . '</td>
                    <td>' . $rs['nombre_proyecto'] . '</td>
                    <td>' . $rs['nombre_area'] . '</td>
                    <td>' . $rs['area_observada'] . '</td>
                    <td>' . $rs['ubicacion'] . '</td>
                    <td>' . $rs['nombre_tarea'] . '</td>
                    <td>' . $rs['fecha'] . '</td>
                    <td>' . $rs['registro'] . '</td>
                    <td>' . $rs['empresa'] . '</td>
                    <td>' . $rs['tipoRiesgo'] . '</td>
                    </tr>';

    }

    return $salida;

}


function consultReporteInspeccionAlmacen($pdo,$mes,$anio,$sede){

    $TODOS_PROYECTOS = 100;
    $sedeSQL = "idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "idProyecto = '$sede'";
    }

    try{

        $query = "SELECT     
        tipo_inspeccion,
        idProyecto,
        sede, 
        area,
        lugar_inspeccion,
        usuario,
        usuario_responsable,
        fecha,
        registro,
        id_tipo_inspeccion_almacen,
        tipo_inspeccion_almacen,
        respuesta,
        condicion,
        calificacion,
        accion_correctiva,
        usuario_responsable_detalle,
        fecha_cumplimiento,
        seguimiento,
        evidencia
        
        FROM view_inspeccion_almacen
        WHERE  MONTH(registro) = $mes AND  
                YEAR(registro) = $anio AND 
                respuesta = 2 AND 
                $sedeSQL
        ORDER BY registro DESC";

        $salida     = "";

        $statement  = $pdo->prepare($query);
        $statement -> execute(array());
        $results    = $statement ->fetchAll();
        $rowaffect 	= $statement->rowCount($query);

        foreach($results as $rs ){
            

            $evidencia = explode(",", $rs['evidencia']);

            $listaImagenes = '';
            $listaArchivos = '';

            foreach ($evidencia as $elemento) {
                if (strlen($elemento) > 0) {

                    if( strpos($elemento, '.pdf') > 0){

                        $listaArchivos .= ('<a href="'.CONSTANT('URL').$elemento.'"> <br>');
                    }
                    if( strpos($elemento, '.jpg') > 0 || strpos($elemento, '.png') > 0){

                        $listaImagenes .=  ('<img style="height:100px; width:100px;" src="../../ssma/public/photos/'.$elemento.'"><br>');
                    }
                
                }
            }

            $salida .= '<tr>
            <td>'.$rowaffect.'</td>
            <td>'.$rs['tipo_inspeccion'].'</td>
            <td>'.$rs['sede'].'</td>
            <td>'.$rs['area'].'</td>
            <td>'.$rs['lugar_inspeccion'].'</td>
            <td>'.$rs['usuario'].'</td>
            <td>'.$rs['usuario_responsable'].'</td>
            <td>'.$rs['fecha'].'</td> 
            <td>'.$rs['registro'].'</td>
            <td>'.$rs['tipo_inspeccion_almacen'].'</td>
            <td>'.valorRespuesta($rs['respuesta']).'</td>
            <td>'.$rs['condicion'].'</td>
            <td>'.valorCalificacion($rs['calificacion']).'</td>
            <td>'.$rs['accion_correctiva'].'</td>
            <td>'.$rs['usuario_responsable_detalle'].'</td>
            <td>'.$rs['fecha_cumplimiento'].'</td>
            <td>'.$rs['seguimiento'].'</td>
            <td>'.$listaImagenes.$listaArchivos.'</td>
            </tr>';


            $rowaffect--;

        }

        return $salida;

   
    }catch(PDOException $e){
       echo $e->getMessage();
       return false;
    }


}



function consultReporteInspeccionOficina($pdo,$mes,$anio,$sede){

    $TODOS_PROYECTOS = 100;
    $sedeSQL = "idProyecto <> '$sede'";

    if($sede!= $TODOS_PROYECTOS){
        $sedeSQL = "idProyecto = '$sede'";
    }

    try{

        $query = "SELECT     
        tipo_inspeccion,
        idProyecto,
        sede, 
        area,
        lugar_inspeccion,
        usuario,
        usuario_responsable,
        fecha,
        registro,
        pregunta,
        respuesta,
        condicion,
        calificacion,
        accion_correctiva,
        usuario_responsable_detalle,
        fecha_cumplimiento,
        seguimiento,
        evidencia
        
        FROM view_inspeccion_oficina
        WHERE  MONTH(registro) = $mes AND  
                YEAR(registro) = $anio AND 
                respuesta = 2 AND 
                $sedeSQL
        ORDER BY registro DESC";

        $salida     = "";

        $statement  = $pdo->prepare($query);
        $statement -> execute(array());
        $results    = $statement ->fetchAll();
        $rowaffect 	= $statement->rowCount($query);

        foreach($results as $rs ){
            

            $evidencia = explode(",", $rs['evidencia']);

            $listaImagenes = '';
            $listaArchivos = '';

            foreach ($evidencia as $elemento) {
                if (strlen($elemento) > 0) {

                    if( strpos($elemento, '.pdf') > 0){

                        $listaArchivos .= ('<a href="'.CONSTANT('URL').$elemento.'"> <br>');
                    }
                    if( strpos($elemento, '.jpg') > 0 || strpos($elemento, '.png') > 0){

                        $listaImagenes .=  ('<img style="height:100px; width:100px;" src="../../ssma/public/photos/'.$elemento.'"><br>');
                    }
                
                }
            }

            $salida .= '<tr>
            <td>'.$rowaffect.'</td>
            <td>'.$rs['tipo_inspeccion'].'</td>
            <td>'.$rs['sede'].'</td>
            <td>'.$rs['area'].'</td>
            <td>'.$rs['lugar_inspeccion'].'</td>
            <td>'.$rs['usuario'].'</td>
            <td>'.$rs['usuario_responsable'].'</td>
            <td>'.$rs['fecha'].'</td> 
            <td>'.$rs['registro'].'</td>
            <td>'.$rs['pregunta'].'</td>
            <td>'.valorRespuesta($rs['respuesta']).'</td>
            <td>'.$rs['condicion'].'</td>
            <td>'.valorCalificacion($rs['calificacion']).'</td>
            <td>'.$rs['accion_correctiva'].'</td>
            <td>'.$rs['usuario_responsable_detalle'].'</td>
            <td>'.$rs['fecha_cumplimiento'].'</td>
            <td>'.$rs['seguimiento'].'</td>
            <td>'.$listaImagenes.$listaArchivos.'</td>
            </tr>';


            $rowaffect--;

        }

        return $salida;

   
    }catch(PDOException $e){
       echo $e->getMessage();
       return false;
    }


}