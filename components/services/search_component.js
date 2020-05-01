$(function() {
  $("#slider-range").slider({
    range: true,
    min: 0,
    max: 500,
    values: [75, 300],
    slide: function(event, ui) {
      $("#amount").val(ui.values[0] + "€ - " + ui.values[1] + "€");
    }
  });
  $("#amount").val(
    "$" +
      $("#slider-range").slider("values", 0) +
      " - $" +
      $("#slider-range").slider("values", 1)
  );
});

function show_categories(this_) {
  var categories = document.getElementById("categories");

  if (categories.style.display == "none") {
    categories.style.display = "inline-block";
  } else {
    categories.style.display = "none";
  }
}

function change_category(category) {
  var categories = document.getElementById("categories");
  var label_category = document.getElementById("label_category");
  label_category.innerHTML = category;
  categories.style.display = "none";
  modify_link();
}
function modify_link() {
  var input = document.getElementById("input_search").value;
  var label_category = document.getElementById("label_category").innerHTML;

  input = input.replace(new RegExp(" ", "g"), "-").toLowerCase();
  label_category = label_category
    .replace(new RegExp(" ", "g"), "-")
    .toLowerCase();
  document.getElementById("search_link").href =
    "../search/" + label_category + "/" + input;
}