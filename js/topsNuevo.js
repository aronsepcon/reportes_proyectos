$(function() {

    var potenciaGeneral = '';
    var idTopGeneral = '';

    var SEDE = '';
    var FECHA_INICIO = '';
    var FECHA_FIN = '';


    $("#buscarDatos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#topsTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#btnBefore").on("click", function(event) {
        event.preventDefault()

        SEDE = $("#sede").val();

        $.post("../inc/tablesBefore.inc.php", { doc: 'topsNuevo', me: $("#mes").val(), an: $("#anio").val() ,'sede' :SEDE },
            function(data, textStatus, jqXHR) {
                if (data.respuesta) {
                    $("#topsTableNuevo tbody").empty()
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

        $.post("../inc/exportEncabezadoTopsNuevo.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

                console.log(data);

            },
            "json"
        ).always(function() {
            //papa descargar el archivo 
            var url = "../reports/topsnuevo.xlsx";
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


    $("#btnTops").on("click", function(event) {
        event.preventDefault();
        window.open('topsNuevoEstadistica.php');
        console.log('prueba');
        return false;
    });


    
    function downloadEncabezadoTopsNuevoMatriz(event) {

        SEDE = $("#sede").val();
        FECHA_INICIO = $("#fechaInicio").val();
        FECHA_FIN = $("#fechaFin").val();

        $.post("../inc/exportMatrizTopsVictor.inc.php", {"sede" : SEDE ,"fecha_inicio" :FECHA_INICIO , "fecha_fin" :FECHA_FIN},
            function (data, textStatus, jqXHR) {

            },
            "json"
        ).always(function() {

            var url = "../reports/matriztops.xlsx";
            event.preventDefault();
            window.location.href = url;

            $('.modal').css('opacity', '0');
            $('.modal').css('z-index', '-1');
        });

    }



    

    
    /**
     * 
     * INICIAMOS EL PROCESO DEL POP UP PARA AGREGAR UNA NUEVA OBSERVACION A LA TABLA PRINCIPAL DE OBSERVACIONES
     * 
     */


    
     $("#topsTableNuevo").on("click", ".verPdf", function (event) {
        event.preventDefault();

        var urlPdf = $(this).val();
        window.open('http://localhost/ssmaprueba/'+urlPdf);

        return false;
    })


    // 1. CLICK SOBRE agregar observacion


    $("#topsTableNuevo").on("click", ".editar", function (event) {
        event.preventDefault();

        idTopGeneral = $(this).val();
        potenciaGeneral = $(this).attr("potencial");


        $("#popup-1").addClass("active");
        $(".loader").hide();

        listaPerdida($(this).attr("potencial"));

        return false;
    })


    function listaPerdida(potencial) {

        var htmlPerdida = '';
        var arrayPerdida = [["01", "Alto"], ["02", "Medio"], ["03", "Bajo"], ["04", ""]];

        arrayPerdida.forEach(perdida => {
            if (potencial != perdida[0]) {
                htmlPerdida += '<option value="' + perdida[0] + '">' + perdida[1] + '</option>';
            } else {
                htmlPerdida += '<option value="' + perdida[0] + '" selected>' + perdida[1] + '</option>';
            }
        });

        //$("#listaPotencial").append(htmlPerdida);
        document.getElementById("listaPotencial").innerHTML = htmlPerdida;

    }




    // 5. LUEGO DE LLENAR TODOS LOS CAMPOS VAMOS A AGREGAR LA OBSERVACION REALIZADA Y VA SER AÑADIDO A LA TABLA PRINCIPAL


    $("#btnUpdateDocumento").click(function (event) {
        event.preventDefault();


        $("#formpopup").trigger('submit');



        return false;
    });




    // 7. Enviamos el formulario con la imagen en memoria para que sea almacenado en un directorio de imagenes

    $("#formpopup").on('submit', function (event) {

        event.preventDefault();
        var str = $("#formpopup").serialize();
        console.log(str);

        $(".loader").show();
        $("#formpopup").hide();

        console.log("variables");
        console.log($("#listaPotencial").val());
        console.log(idTopGeneral);
        potenciaGeneral = $("#listaPotencial").val();
        estado = $("#estadoActivo").val();

        $.post("../inc/editarTops.inc.php", { idTop : idTopGeneral , potencial:$("#listaPotencial").val(),estado:$("#estadoActivo").val()},
        function(data, textStatus, jqXHR) {

            $("#formpopup").show();

            $(".loader").hide();

            $(".loader").hide();


            //$("#"+idTopGeneral).append(tipoPotencial(potenciaGeneral));
            document.getElementById('button_'+idTopGeneral).innerHTML = '<button  class="editar" value="'+idTopGeneral+'" potencial="'+$("#listaPotencial").val()+'" > editar</button> ';
            document.getElementById(idTopGeneral).innerHTML = tipoPotencial(potenciaGeneral);

            console.log(data);

            $("#popup-1").removeClass("active");
            $("#formpopup").trigger("reset");
        },
        "json"
    
    );

        return false;
    });

    function tipoPotencial(potencial){

        nombrePotencial = '';

        if(potencial == '01'){
            nombrePotencial = 'POTENCIAL ALTO';
        }else if(potencial == '02'){
            nombrePotencial = 'POTENCIAL MEDIO';
        }else if(potencial == '03'){
            nombrePotencial = 'POTENCIAL BAJO';
        }else if(potencial == '04'){
            nombrePotencial = '';
        }
        return nombrePotencial;
    }


    // 8. Cerramos el popup
    $(".clickPopup-close").click(function (event) {
        event.preventDefault();

        $("#popup-1").removeClass("active");
        $("#formpopup").trigger("reset");
        return false;

    });



})