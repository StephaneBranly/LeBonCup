function import_ad() {
  const input = document.getElementById("input_import");
  const icon = document.getElementById("icon_import");
  const import_beta_message = document.getElementById("import_beta_message");

  const input_ad_price = document.getElementById("ad_price");
  const input_ad_title = document.getElementById("ad_title");
  const input_ad_description = document.getElementById("ad_description");
  const url = "../components/services/proxy_import.php?url=" + input.value;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");
  icon.innerHTML = "<span><i class='icon-spinner animate-spin ' ></i></span>";
  xhr.onload = function() {
    const response = JSON.parse(xhr.responseText);
    if (response.status == "OK") {
      const ad = response.ad;
      input_ad_description.value = ad.description;
      input_ad_title.value = ad.title;
      input_ad_price.value = ad.price;
      import_beta_message.style.display = "inline-block";
     
      if (ad.img1) loadExternalImage("f1", ad.img1);
      if (ad.img2) loadExternalImage("f2", ad.img2);
      if (ad.img3) loadExternalImage("f3", ad.img3);
      write_notification(
        "icon-ok-circled2",
        "Annonce importée de " + ad.importedFrom,
        10000
      );
    } else
      write_notification("icon-cancel-circled", "Erreur importation", 10000);
    icon.innerHTML =
      "<span onclick='import_ad()'><i class='icon-plus' ></i></span>";
  };
  xhr.send();

  // url model : https://www.vinted.fr/femmes/vestes-en-jean/619102948-veste-en-jean
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

function loadExternalImage(name,url)
{
  nameDiv = "image_" + name;
const div = document.getElementById(nameDiv);
div.classList.add("remove");
div.classList.remove("add");
div.innerHTML =
  "<img id='image_"+name+"_img' /><i class='icon-cancel-circled2' onclick=\"imgDeleteImage('" +
  name +
  "');\"></i>";
  const input_extern = document.getElementById("input_extern_"+name);
  input_extern.value = url;
  const img = document.getElementById(nameDiv+'_img');
  img.src = url;
}

function handleInputImport(event) {
  if (event.which == 13 || event.keyCode == 13) {
    import_ad();
  }
}
