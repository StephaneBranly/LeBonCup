function load_user_vinted() {
  // url exemple https://www.vinted.fr/member/32065735-jorera26
  const input = document.getElementById("import_vinted_url");

  const regex = /member\/([0-9]*)/g;
  var found = input.value.match(regex);
  const iduser = found[0].replace("member/", "");
  var url = "https://www.vinted.fr/api/v2/users/" + iduser + "/items";

  xhr = new XMLHttpRequest({ mozSystem: true });
  $.ajax({
    url: url,
    crossDomain: true,
    type: "GET",
    datatype: "json",
    success: function() {
      alert("Success");
    },
    error: function(data) {
      alert("Failed!");
      console.log(data);
    }
  });

  //   var select = document.getElementById("import_vinted_select");
  //   var new_content = "";
  //   select.innerHTML = new_content;
}

function import_vinted() {
  const input = document.getElementById("import_vinted_url");
  const url = "../components/services/proxy.php?url=" + input.value;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");

  xhr.onload = function() {
    console.log(xhr.responseText);
  };
  xhr.send();

  // $.ajax({
  //   url: url,
  //   method: "GET",
  //   headers: {
  //     "Access-Control-Allow-Origin": "*"
  //   },
  //   success: function(data) {
  //     alert("Success");
  //     console.log(data);
  //   },
  //   error: function(data) {
  //     alert("Failed!");
  //     console.log(data);
  //   }
  // });
  // url model : https://www.vinted.fr/femmes/vestes-en-jean/619102948-veste-en-jean
}
