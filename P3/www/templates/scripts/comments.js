window.onload = bindFunctions;

//Función para asignar los manejadores a los distintos eventos posibles. De esta forma se separa más el codigo JS del HTML
function bindFunctions(){
  document.getElementById("showButton").onclick = toggleComments;
  document.getElementById("postButton").onclick = postComment;
  document.getElementById("comment").oninput = censorship;
  //También nos aseguramos de que el textarea para escribir el comentario está vacío y que el botón para postear el cometario está oculto
  document.getElementById("comment").value = "";
  document.getElementById("postButton").style.display = "none";
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
  var button = document.getElementById("postButton");

  var name = document.getElementById("name");
  var email = document.getElementById("email");
  var comment = document.getElementById("comment");

  var ilegal = false;

  //Si el nombre de usuario está vacío al postear el comentario, se inhabilita la introducción del comentario en el html
  //También se avisa poniendo el marco del input para el nombre de color rojo
  if(name.value === ""){
    name.style.borderColor = "#C20606";
    ilegal = true;
  }
  else{
    name.style.borderColor = "white";
  }

  //Se valida el email introducido. En caso de no ser valido, se avisa poniendo el marco en rojo y mostrando el texto "Invalid Email" en rojo al lado del input
  if(!validateEmail(email.value)){
    email.style.borderColor = "#C20606";
    var notice = document.getElementById("invalidEmail");
    notice.textContent = "Invalid Email";
    ilegal = true;
  }
  else{
    email.style.borderColor = "white";
    var notice = document.getElementById("invalidEmail");
    notice.textContent = "";
  }

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
    '<p>' + name.value + '</p>\n' +
    '<p>' + date + '</p>\n' +
    '<p class="commentBody">' + comment.value + '</p>\n';

    section.setAttribute('class','postedComment');
    article.appendChild(section);
    comment.value = "";
    button.style.display = "none";
  }

}

//Función para aplicar el filtro de palabras prohibidas al escribir el comentario
function censorship(){
  var texarea = document.getElementById("comment");
  var button = document.getElementById("postButton");

  //También se aprovecha para ocultar el botón para postear el comentario si el textare esta vacio, es decir, no hay escrito ningún comentario
  if(texarea.value === ""){
    button.style.display = "none";
  }
  else{
    button.style.display = "block";
  }

  //Lista de palabras prohibidas
  var forbidden = ["xbox", "microsoft", "gamepass", "bill gates", "azure", "windows", "skype", "github", "kinect", "series x"];

  forbidden.forEach(censor)
}

//Para cada palabra prohibida se aplica esta función
function censor(item,index){
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