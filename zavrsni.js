function myFunction() {
  var comment = document.getElementById("hide");
  var btn = document.getElementById("HideShow");
  if (comment.style.display === "none") {
      HideShow.innerHTML = 'Hide comments'
      comment.style.display = "block";
  } else {
      HideShow.innerHTML = 'Show comments'
      comment.style.display = "none";
  }
};

