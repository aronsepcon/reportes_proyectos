$(function() {
    
    var SEDE = '';


    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#topsTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    /*$("#btnExport").on("click", function(e) {
        e.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        $.post("../inc/exportRiesgos.inc.php", { me: $("#mes").val(), an: $("#anio").val() },
                function(data, textStatus, jqXHR) {

                    console.log('answer')

                    console.log(data);
                }
            )
            .always(function() {
                //papa descargar el archivo 
                var url = "../reports/riesgos.xlsx";
                e.preventDefault();
                window.location.href = url;

                $('.modal').css('opacity', '0');
                $('.modal').css('z-index', '-1');
            });

        return false;
    });*/

    $("#btnBefore").on("click", function(event) {
        event.preventDefault()

        console.log("mes " + $("#mes").val() + " : año " + $("#anio").val())
        SEDE = $("#sede").val();


        $.post("../inc/tablesBefore.inc.php", { doc: 'riesgos', me: $("#mes").val(), an: $("#anio").val(),sede :SEDE },
            function(data, textStatus, jqXHR) {

                console.log(data);

                if (data.respuesta) {
                    $("#riesgosTable tbody").empty()
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

        $.post("../inc/exportRiesgos.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

                console.log(data);

            },
            "json"
        ).always(function() {
            //papa descargar el archivo 
            var url = "../reports/riesgos.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }

})