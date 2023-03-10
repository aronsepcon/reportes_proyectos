$(function() {

    $("#btnExportMatriz").on("click", function(e) {
        e.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        $("#formExcelMatriz").trigger('submit');


        return false;
    });


    //enviar formulario
    $("#formExcelMatriz").on('submit', function(event) {
        /* Act on the event */

        var str = $(this).serialize();


        $.post("../inc/matrizMetas.inc.php", str,
                function(data, textStatus, jqXHR) {

                   
                },
            )
            .always(function() {
                //papa descargar el archivo 
                var url = "../reports/matrizmetas.xlsx";
                event.preventDefault();
                window.location.href = url;

                $('.modal').css('opacity', '0');
                $('.modal').css('z-index', '-1');
            });

        return false;
    });


})