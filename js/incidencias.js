$(function(){

    var SEDE = '';
    
    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#incidenciasTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('body').on('click','#incidenciasTable a',function (event) {
        event.preventDefault();
        
        $("#previeWindow").fadeIn();
        $(".loader").fadeIn();

        $archivo = "../pdf/"+$(this).attr("href")+".pdf";

        $.post("../inc/pdfIncidencia.inc.php", {idIncidencia:$(this).attr("href")},
            function (data, textStatus, jqXHR) {
                $(".loader").fadeOut();
                $(".pdfSheet").fadeIn();
                $("object").attr("data",$archivo);
            }
        );

        return false;
    })

    $("#closePdfPrev").on("click", function (event) {
        event.preventDefault();

        $("object").attr("data","");
        $("#previeWindow").fadeOut();
        
        return false;
    });

    $("#btnBefore").on("click", function (event) {
        event.preventDefault()

        SEDE = $("#sede").val();
  
        $.post("../inc/tablesBefore.inc.php", {doc:'incidencias',me:$("#mes").val(),an:$("#anio").val(),sede : SEDE},
          function (data, textStatus, jqXHR) {
            if ( data.respuesta ) {
                $("#incidenciasTable tbody").empty()
                                            .append(data.contenido);
            }
          },
          "json"
        );
  
        return false;
      });


    
    /*$("#btnExport").on("click", function(e) {
        e.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        $.post("../inc/exportincidencias.inc.php", { me: $("#mes").val(), an: $("#anio").val() },
                function(data, textStatus, jqXHR) {},
                "json"
            )
            .always(function(data) {
                console.log(data);
                //papa descargar el archivo 
                var url = "../reports/incidencias.xlsx";
                e.preventDefault();
                window.location.href = url;

                $('.modal').css('opacity', '0');
                $('.modal').css('z-index', '-1');
            });

        return false;
    });*/


    /**
     * 
     * 
     * 
     */


    

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

        $.post("../inc/exportincidencias.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

                console.log(data);

            },
            "json"
        ).always(function() {
            //papa descargar el archivo 
            var url = "../reports/incidencias.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }


})



