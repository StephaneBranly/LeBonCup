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

function handleImport() {
  const input = document.getElementById("input_import");
  const container = document.getElementById("import_anad");
  const url = input.value;
  const patternVintedRegex = new RegExp(/^https?:\/\/www.vinted/, "i");
  if (url.match(patternVintedRegex)) {
    container.classList.add("vinted");
  } else {
    container.classList.remove("vinted");
  }
}

function openImages(img1, img2, img3) {
  if (img1) openImage("image1-Vinted.jpg", img1);
  if (img2) openImage("image2-Vinted.jpg", img2);
  if (img3) openImage("image3-Vinted.jpg", img3);
}

function openImage(filename, text) {
  window.open(text, "_blank");
}
