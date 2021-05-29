$(document).ready(function(){
    searchBar.onkeyup = busqueda;
    $("#searchBar").focus(function(){
        $("#results").css("width","105px");
        $("#results").css("display","block");
        $("#results").animate({width: "265px"});
    });
    $("#searchBar").focusout(function(){
        setTimeout(function(){
            $("#results").css("display","none");
        },100);
    });
});

function busqueda(){
    var str = $("#searchBar").val();
    if(str.length == 0){
        $("#results").html("");
        return;
    }

    $.ajax({
        data: {str},
        url: 'busqueda.php',
        type: 'get',
        success : function(respuesta){
            mostrarResultados(respuesta,str);
        }
    });

}

function mostrarResultados(respuesta,str){
    var html = "";
    if(respuesta.length > 0){
        for(var i = 0; i < respuesta.length-1; i++){
            html += "<li><a href='evento.php?ev=" + respuesta[i].DB_idEv + "&cadena=" + str + "' class='searchLink'>" + respuesta[i].titulo + "</a></li><br>";
        }
        html += "<li><a href='evento.php?ev=" + respuesta[respuesta.length-1].DB_idEv + "&cadena=" + str +"' class='searchLink'>" + respuesta[respuesta.length-1].titulo + "</a></li>";
        $("#results").html(html);
    }
    else{
        $("#results").html("No events found");
    }
}