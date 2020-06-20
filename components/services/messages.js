function switch_messages() {
  content = document.getElementById("content_messages").style;
  if (content.display == "inline-block") content.display = "none";
  else content.display = "inline-block";
}

messages = [
  "branlyst",
  "stephane_branly",
  [
    ["me", "Ceci est un test"],
    ["me", "Ceci est deuxième test"],
    ["friend", "Ceci est un test"]
  ]
];

function open_contact(contact) {
  content_html =
    "<div id='active_contact'><i onclick='return_contacts();' class='icon-left-open'></i><i class='icon-user'></i>" +
    messages[1] +
    "</div>";
  content = document.getElementById("content_messages");

  for (i in messages[2]) {
    content_html +=
      " <div class='" +
      messages[2][i][0] +
      "'><span>" +
      messages[2][i][1] +
      "</span></div>";
  }
  content.innerHTML = content_html;
}

function return_contacts() {
  content_html = "";
  content = document.getElementById("content_messages");
  for (i in messages) {
    content_html +=
      " <div class='contact' onclick=\"open_contact('" +
      messages[0] +
      "');\"><i class='icon-user'></i>" +
      messages[1] +
      "</div>";
  }
  content.innerHTML = content_html;
}
