function change_content(id, content) {
  var element = document.getElementById(id);
  element.innerHTML = content;
}

function copy_to_clipboard(id, content) {
  var range = document.createRange();
  range.selectNode(document.getElementById(id));
  window.getSelection().removeAllRanges(); // clear current selection
  window.getSelection().addRange(range); // to select text
  document.execCommand("copy");
  window.getSelection().removeAllRanges(); // to deselect
  text = content + " a été copié";
  write_notification("icon-doc", text, 2000);
}
function open_link(url) {
  document.location.href = url;
}

String.prototype.sansAccent = function() {
  var accent = [
    /[\300-\306]/g,
    /[\340-\346]/g, // A, a
    /[\310-\313]/g,
    /[\350-\353]/g, // E, e
    /[\314-\317]/g,
    /[\354-\357]/g, // I, i
    /[\322-\330]/g,
    /[\362-\370]/g, // O, o
    /[\331-\334]/g,
    /[\371-\374]/g, // U, u
    /[\321]/g,
    /[\361]/g, // N, n
    /[\307]/g,
    /[\347]/g // C, c
  ];
  var noaccent = [
    "A",
    "a",
    "E",
    "e",
    "I",
    "i",
    "O",
    "o",
    "U",
    "u",
    "N",
    "n",
    "C",
    "c"
  ];

  var str = this;
  for (var i = 0; i < accent.length; i++) {
    str = str.replace(accent[i], noaccent[i]);
  }

  return str;
};

function RedirectionJavascript(page, time) {
  url = "../" + page;
  setTimeout("{document.location.href=url;}", time);
}

function readBody(xhr) {
  var data;
  if (!xhr.responseType || xhr.responseType === "text") {
    data = xhr.responseText;
  } else if (xhr.responseType === "document") {
    data = xhr.responseXML;
  } else {
    data = xhr.response;
  }
  return data;
}

function LikeAd(id) {
  var xhr = new XMLHttpRequest();
  url = "../components/services/like_ad.php?id=" + id;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      new_content = readBody(xhr);
      change_content("likes", new_content);
    }
  };
  xhr.open("GET", url);
  xhr.send("");
}

function updateNumberResults() {
  text = document.getElementById("input_search").value;
  idcat = document.getElementById("category").value;
  var xhr = new XMLHttpRequest();
  url =
    "../components/services/count_results.php?text=" + text + "&idcat=" + idcat;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      new_content = readBody(xhr);
      change_content("numberResults", new_content);
    }
  };
  xhr.open("GET", url);
  xhr.send("");
}

function updateResults() {
  text = document.getElementById("input_search").value;
  idcat = document.getElementById("category").value;
  filter = document.getElementById("filter").value;
  if (document.getElementById("like_filter"))
    like_filter = document.getElementById("like_filter").checked;
  else like_filter = false;
  var xhr = new XMLHttpRequest();
  url =
    "../components/services/update_results.php?text=" +
    text +
    "&idcat=" +
    idcat +
    "&like_filter=" +
    like_filter +
    "&filter=" +
    filter;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      new_content = readBody(xhr);
      change_content("results", new_content);
    }
  };
  xhr.open("GET", url);
  xhr.send("");
}

function write_updates(first) {
  var xhr = new XMLHttpRequest();
  let content = "";
  let content_div = document.getElementById("updates_content");
  url = "../ressources/updates.json";
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      data = JSON.parse(readBody(xhr));

      if (first) {
        version = data["versions"][0];
        content +=
          "<h3>" +
          version.version +
          " (" +
          version.date +
          ") - " +
          version.title +
          "</h3>";
        content += "<p>" + version.description + "</p>";
        content += "<ul>";
        for (j = 0; j < version["news"].length; j++)
          content += "<li>" + version["news"][j] + "</li>";
        content += "</ul>";
        content +=
          "<a class='link' href='../a-propos'>Voir le contenu de toutes les mises à jour</a>";
      } else {
        for (i = 0; i < data["versions"].length; i++) {
          version = data["versions"][i];
          content +=
            "<h3>" +
            version.version +
            " (" +
            version.date +
            ") - " +
            version.title +
            "</h3>";
          content += "<p>" + version.description + "</p>";
          content += "<ul>";
          for (j = 0; j < version["news"].length; j++)
            content += "<li>" + version["news"][j] + "</li>";
          content += "</ul>";
        }
      }

      content_div.innerHTML = content;
    }
  };
  xhr.open("GET", url);
  xhr.send("");
}
