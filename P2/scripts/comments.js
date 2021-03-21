function toggleComments() {
  var com = document.getElementById("commentSection");
  var show = document.getElementById("showButton");
  var hide = document.getElementById("hideButton");

  if(com.style.display === ""){
    com.style.display = "none";
  }

  if (com.style.display === "none") {
    com.style.display = "block";
    show.style.display = "none";
    hide.style.display = "block";
  } else {
    com.style.display = "none";
    show.style.display = "block";
    hide.style.display = "none";
  }
}

function postComment(){
  var article = document.getElementById("feed");
  var section = document.createElement("section");

  var name = document.getElementById("name");
  var email = document.getElementById("email");
  var comment = document.getElementById("comment");

  var ilegal = false;

  if(name.value === ""){
    name.style.borderColor = "#C20606";
    ilegal = true;
  }
  else{
    name.style.borderColor = "white";
  }

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

  if(comment.value === ""){
    ilegal = true;
  }

  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  var hours = today.getHours();
  var minutes = today.getMinutes();

  if(minutes < 10){
    minutes = '0' + minutes;
  }

  date = dd + '-' + mm + '-' + yyyy + '\t' + hours + ':' + minutes;

  if(!ilegal){
    section.innerHTML = 
    '<p>' + name.value + '</p>\n' +
    '<p>' + date + '</p>\n' +
    '<p class="commentBody">' + comment.value + '</p>\n';

    section.setAttribute('class','postedComment');
    article.appendChild(section);
    comment.value = "";
  }

}

function censorship(){
  var forbidden = ["xbox", "microsoft", "gamepass", "bill gates", "azure", "windows", "skype", "github", "kinect", "series x"];

  forbidden.forEach(censor)
}

function censor(item,index){
  var replacement = "";

  for(var i = 0; i < item.length; i++){
    replacement += "*";
  }

  var regexitem = new RegExp(item,"i");

  var comment = document.getElementById("comment");  
  var censored = comment.value.replace(regexitem,replacement);
  comment.value = censored;
}

function validateEmail(email) 
{
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}