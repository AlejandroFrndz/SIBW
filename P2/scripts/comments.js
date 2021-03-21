function toggleComments() {
    var com = document.getElementById("commentSection");
    var show = document.getElementById("showButton");
    var hide = document.getElementById("hideButton");
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