$(function() {

    var SEDE = '';

    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#topsTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
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

        $.post("../inc/exportIpercNuevo.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

                console.log(data);

            },
            "json"
        ).always(function() {
            //papa descargar el archivo 
            var url = "../reports/iperc.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }




    $("#btnExportMatriz").on("click", function(event) {
        event.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        downloadEncabezadoTopsNuevoMatriz(event);

        return false;
    });


    
    function downloadEncabezadoTopsNuevoMatriz(event) {

        SEDE = $("#sede").val();
        FECHA_INICIO = $("#fechaInicio").val();
        FECHA_FIN = $("#fechaFin").val();

        $.post("../inc/exportMatrizIperc.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

            },
            "json"
        ).always(function() {

            var url = "../reports/matriziperc.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }



    



    /**
     * 
     * 
     */


    $("#btnBefore").on("click", function(event) {
        event.preventDefault()

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        SEDE = $("#sede").val();

        $.post("../inc/tablesBefore.inc.php", { doc: 'ipercNuevo', me: $("#mes").val(), an: $("#anio").val() ,sede :SEDE},
            function(data, textStatus, jqXHR) {

                console.log(data);

                if (data.respuesta) {
                    $("#topsTable tbody").empty()
                        .append(data.contenido);


                }


                $('.modal').css('opacity', '0');
                $('.modal').css('z-index', '-1');
            },
            "json"
        );

        return false;
    });


})