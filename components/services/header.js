function search_sthg() {
  var input_search = document.getElementById("input_search").value;
  input_search.replace(new RegExp(" ", "g"), "-").toLowerCase();
  url = "../search/toutes-categories/" + input_search;
  document.location.href = url;
}
