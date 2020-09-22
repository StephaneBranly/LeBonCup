function import_ad() {
  const input = document.getElementById("input_import");
  const icon = document.getElementById("icon_import");
  const import_beta_message = document.getElementById("import_beta_message");
  const import_beta_button = document.getElementById("import_beta_button");

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
      import_beta_button.innerHTML =
        "<button onclick=\"openImages('" +
        ad.img1 +
        "','" +
        ad.img2 +
        "','" +
        ad.img3 +
        "')\"><i class='icon-photo'></i>Ouvrir les images de votre annonce Vinted (nouvel onglet)</button>";

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
