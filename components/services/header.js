function search_sthg(this_) {
  var text_search = document.getElementById("text_search");
  var input_search = document.getElementById("input_search");

  if (text_search.style.display != "none") {
    text_search.style.display = "none";
    input_search.style.display = "inline";
    input_search.focus();
  }
}
