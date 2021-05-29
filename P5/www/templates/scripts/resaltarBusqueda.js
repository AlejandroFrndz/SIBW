$(document).ready(function(){
    var cadena = $("#cadenaBusqueda").html();
    var replacement = "<em>" + cadena + "</em>";
    
    var cuerpo = $("#eventBody");

    var regexitem = new RegExp(cadena,"gi");

    if(cadena.length > 0){
        var destacado = cuerpo.html().replace(regexitem,replacement);
        cuerpo.html(destacado);
    }
});