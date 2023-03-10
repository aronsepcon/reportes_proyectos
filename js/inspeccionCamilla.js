$(function() {

    var SEDE = '';
    var FECHA_INICIO = '';
    var FECHA_FIN = '';


    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#incidenciasTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#btnBefore").on("click", function(event) {
        event.preventDefault()
        SEDE = $("#sede").val();
        $.post("../inc/tablesBefore.inc.php", { doc: 'inspeccionCamilla', me: $("#mes").val(), an: $("#anio").val() ,sede :SEDE },
            function(data, textStatus, jqXHR) {
                console.log(data);
                if (data.respuesta) {
                    $("#tablaReporte tbody").empty()
                        .append(data.contenido);
                }
            },
            "json"
        );

        return false;
    });
    

    $("#btnExport").on("click", function(event) {
        event.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        downloadEncabezadoTopsNuevo(event);


        return false;
    });

    function downloadEncabezadoTopsNuevo(event) {

        SEDE = $("#sede").val();
        FECHA_INICIO = $("#fechaInicio").val();
        FECHA_FIN = $("#fechaFin").val();

        console.log(SEDE);
        console.log(FECHA_INICIO);
        console.log(FECHA_FIN);

        $.post("../inc/exportInspeccionCamilla.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

                console.log(data);

            },
            "json"
        ).always(function() {
            //papa descargar el archivo 
            var url = "../reports/inspeccionCamilla.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }



})