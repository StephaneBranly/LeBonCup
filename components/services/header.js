function research_sthg(this_) {
  var text_research = document.getElementById("text_research");
  var input_research = document.getElementById("input_research");

  if (text_research.style.display != "none") {
    text_research.style.display = "none";
    input_research.style.display = "inline";
    input_research.focus();
  }
}
