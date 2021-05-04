var palabrasProhibidas;
window.onload = bindFunctions;

//Función para asignar los manejadores a los distintos eventos posibles. De esta forma se separa más el codigo JS del HTML
function bindFunctions(){
  document.getElementById("showButton").onclick = toggleComments;
  document.getElementById("postButton").setAttribute("disabled",true);
  document.getElementById("comment").oninput = censorship;
  //También nos aseguramos de que el textarea para escribir el comentario está vacío y que el botón para postear el cometario está oculto
  document.getElementById("comment").value = "";
  palabrasProhibidas = document.getElementById("palabrasProhibidas").dataset.palabrasProhibidas;
  palabrasProhibidas = JSON.parse(palabrasProhibidas);
}

//Función para mostrar/ocultar la sección de comentarios
function toggleComments() {
  var com = document.getElementById("commentSection");
  var show = document.getElementById("showButton");

  if(com.style.display === ""){
    com.style.display = "none";
  }

  //En función de si la sección era visible o no, se muestra u oculta y se cambia el texto del botón
  if (com.style.display === "none") {
    com.style.display = "block";
    show.innerText = "Hide Comments";
  } else {
    com.style.display = "none";
    show.innerText = "Show Comments";
  }
}

//Función para postear un nuevo comentario
function postComment(){
  var article = document.getElementById("feed");
  var section = document.createElement("section");

  var comment = document.getElementById("comment");

  var ilegal = false;

  //Si el comentario está vacío, también se anula la introducción en el html
  if(comment.value === ""){
    ilegal = true;
  }

  //Se calcula la fecha actual, con el formato dd-mm-yyyy hh:mm para incluirla en el comentario posteado
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  var hours = today.getHours();
  var minutes = today.getMinutes();
  var seconds = today.getSeconds();

  if(minutes < 10){
    minutes = '0' + minutes;
  }
  if(seconds < 10){
    seconds = '0' + seconds;
  }

  date = yyyy + '-' + mm + '-' + dd + '\t' + hours + ':' + minutes + ":" + seconds;

  //Si todo ha ido bien, se incluye una nueva sección en el html con el nuevo comentario
  if(!ilegal){
    section.innerHTML = 
    '<p>' + date + '</p>\n' +
    '<p class="commentBody">' + comment.value + '</p>\n';

    section.setAttribute('class','postedComment');
    article.appendChild(section);
    comment.value = "";
  }

}

//Función para aplicar el filtro de palabras prohibidas al escribir el comentario
function censorship(){
  var boton = document.getElementById("postButton");
  var text = document.getElementById("comment");

  if(text.value === ""){
    boton.disabled = true;
  }
  else{
    boton.disabled = false;
  }

  palabrasProhibidas.forEach(censor);
}

//Para cada palabra prohibida se aplica esta función
function censor(item){
  var replacement = "";

  //Se construye la cadena con el número de * correspondientes a cada palabra
  for(var i = 0; i < item.length; i++){
    replacement += "*";
  }

  //Se construye una expresión regular para buscar la palabra prohibida, case insensitive
  //Se realiza también de forma global para censurar todas las palabras detectadas, por ejemplo al pegar un texto en la caja, en lugar de deternos únicamente en la primera coincidencia encontrada
  var regexitem = new RegExp(item,"gi");

  var comment = document.getElementById("comment");  
  var censored = comment.value.replace(regexitem,replacement);
  comment.value = censored;
}

//Expresión regular (simple) para validar un email. Basta con que la cadena pasada tenga la estructura string@string.string
function validateEmail(email) 
{
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}