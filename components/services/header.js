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