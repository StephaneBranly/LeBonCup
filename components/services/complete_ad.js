function change_photo(url) {
  var viewer = document.getElementById("photo");
  viewer.src = url;
}

function enlarge_photo() {
  var viewer = document.getElementById("photo");
  var viewer_enlarge = document.getElementById("viewer_enlarge");
  current_url = viewer.src;
  viewer_enlarge.src = current_url;
  viewer_enlarge.style.display = "inline-block";
}

function back_photo() {
  var viewer_enlarge = document.getElementById("viewer_enlarge");
  viewer_enlarge.style.display = "none";
}
