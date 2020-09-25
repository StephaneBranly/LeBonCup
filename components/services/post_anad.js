function updateImage(name) {
  const nameInput = "input_" + name;
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
      nameDiv = "image_" + name;
      const div = document.getElementById(nameDiv);
      div.style.backgroundImage = "url('" + e.target.result + "')";
      div.classList.add("remove");
      div.classList.remove("add");
      div.innerHTML =
        "<i class='icon-cancel-circled2' onclick=\"imgDeleteImage('" +
        name +
        "');\"></i>";
    };
  }
}
function imgDeleteImage(name) {
  const nameInput = "input_" + name;
  const nameDiv = "image_" + name;
  input = document.getElementById(nameInput);
  div = document.getElementById(nameDiv);
  div.style.backgroundImage = "url('')";
  // check to remove the current file in the input.

  div.classList.remove("remove");
  div.classList.add("add");
  div.innerHTML = "<i class=' icon-plus'></i>";
}

function adImage(id) {
  const input = document.getElementById("input_" + id);
  if (!input.files || !input.files[0]) input.click();
}
