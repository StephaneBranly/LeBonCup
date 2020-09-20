function preview_email() {
  var form = document.getElementById("content_email");
  console.log(form.value);
  url = "../admin/preview_email?content=" + form.value;
  window.open(url, "_blank");
}
