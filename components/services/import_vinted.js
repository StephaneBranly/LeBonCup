function load_user_vinted() {
  // url exemple https://www.vinted.fr/member/32065735-jorera26
  const input = document.getElementById("import_vinted_url");

  const regex = /member\/([0-9]*)/g;
  var found = input.value.match(regex);
  const iduser = found[0].replace("member/", "");
  url = "https://www.vinted.fr/api/v2/users/" + iduser + "/items";
  xhr = new XMLHttpRequest();

  $.ajax({
    url: url,
    type: "GET",
    datatype: "json",
    success: function() {
      alert("Success");
    },
    error: function() {
      alert("Failed!");
    },
    beforeSend: setHeader
  });

  //   var select = document.getElementById("import_vinted_select");
  //   var new_content = "";
  //   select.innerHTML = new_content;
}

function import_vinted() {
  var input = document.getElementById("import_vinted_url");

  // url model : https://www.vinted.fr/femmes/vestes-en-jean/619102948-veste-en-jean
}

function setHeader(xhr) {
  xhr.setRequestHeader("Access-Control-Request-Headers", "Origin");
}
