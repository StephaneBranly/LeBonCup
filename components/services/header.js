function search_sthg() {
  var input_search = document.getElementById("input_search").value;
  input_search = input_search.sansAccent();
  input_search = input_search.replace(new RegExp(" ", "g"), "-").toLowerCase();
  url = "../search/toutes-categories/" + input_search;
  document.location.href = url;
}

function enter_header(event) {
  if (event.which == 13 || event.keyCode == 13) {
    search_sthg();
  }
}

function login(event) {
  var input_login = document.getElementById("input_login").value;
  url = "../login/" + input_login;
  document.location.href = url;
}

function deco(event) {
  url = "../login/";
  document.location.href = url;
}
