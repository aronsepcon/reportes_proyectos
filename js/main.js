$(function() {

    $("#button_documento").on("click", function(event) {
 
        var sede = $("#sede").val();
        var tipo_documento = $("#tipo_documento").val();
        var nombreSede = '';
        
        $( "#sede option:selected" ).each(function() {
            nombreSede += $( this ).text() + " ";
          });

        window.location.href = tipo_documento+'?sede='+sede+'&nombre='+nombreSede;

    });
})