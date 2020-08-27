function updateImage(name) {
  nameInput = "input_" + name;
  e = document.getElementById(nameInput);
  var imgLivePath = e.value;
  var img_extions = imgLivePath
    .substring(imgLivePath.lastIndexOf(".") + 1)
    .toLowerCase();
  if (img_extions == "png" || img_extions == "jpg" || img_extions == "jpeg")
    readURL(e, name);
}
function readURL(input, name) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
    reader.onload = function(e) {
      name = "image_" + name;
      div = document.getElementById(name);
      div.style.backgroundImage = "url('" + e.target.result + ")";
      alert(e.target.result);
      alert("MAJ");
    };
  }
}
function imgDeleteImage() {
  $("#diplay_img").attr("src", "not-any-img.jpg");
}
