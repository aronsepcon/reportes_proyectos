$(function(){
    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#topsTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#btnExport").on("click", function (e) {
        e.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        $.post("../inc/exporttops.inc.php", { me:$("#mes").val(),an:$("#anio").val() },
          function (data, textStatus, jqXHR) {
          },
          "json"
        )
        .always(function() {
          //papa descargar el archivo 
          var url = "../reports/tops.xlsx";
          e.preventDefault();
          window.location.href = url;

          $('.modal').css('opacity', '0');
          $('.modal').css('z-index', '-1');
        });

        return false;
    });

        $("#btnExportMatriz").on("click", function(e) {
        e.preventDefault();

        $('.modal').css('opacity', '1');
        $('.modal').css('z-index', '3');

        $.post("../inc/matrizMetas.inc.php", { me: $("#mes").val(), an: $("#anio").val() },
                function(data, textStatus, jqXHR) {

                    console.log('answer')

                    console.log(data);
                },
                "json"
            )
            .always(function() {
                //papa descargar el archivo 
                var url = "../reports/matrizmetas.xlsx";
                e.preventDefault();
                window.location.href = url;

                $('.modal').css('opacity', '0');
                $('.modal').css('z-index', '-1');
            });

        return false;
    });

    $("#btnBefore").on("click", function (event) {
      event.preventDefault()

      $.post("../inc/tablesBefore.inc.php", {doc:'tops',me:$("#mes").val(),an:$("#anio").val()},
        function (data, textStatus, jqXHR) {
          if ( data.respuesta ) {
              $("#topsTable tbody").empty()
                            .append(data.contenido);
          }
        },
        "json"
      );

      return false;
    });
})