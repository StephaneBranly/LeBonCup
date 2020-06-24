var vlist_contacts = [];

function switch_messages() {
  content = document.getElementById("content_messages").style;
  if (content.display == "inline-block") content.display = "none";
  else content.display = "inline-block";
}

function open_contact(contact, username) {
  actual_page = ["contact", contact];
  url = "../components/services/get_messages.php?contact=" + contact;
  content = document.getElementById("content_messages");
  content_html =
    "<div id='active_contact'><i onclick='list_contacts();' class='icon-left-open'></i><i class='icon-user'></i>" +
    contact +
    "</div><div id='messages_list'>";

  $.get(url, {}).done(function(data) {
    messages = JSON.parse(data);
    messages = Array.from(messages);
    messages.forEach(objectMessage => {
      content_html +=
        " <div class='" +
        objectMessage.view +
        "'><span>" +
        objectMessage.text +
        "</span></div>";
    });

    content_html +=
      "</div><span style='display:none' id='idcontact'>" + contact + "</span>";
    content_html +=
      "<div id='send_message'><input id='content_text' onkeypress='enter_send_message(event);' type='text'/><i class='icon-paper-plane' onclick='send_message();'></i></div>";
    content.innerHTML = content_html;
    element = document.getElementById("messages_list");

    element.scrollTop = element.scrollHeight;
  });
}

function list_contacts() {
  content_html = "<div id='messages_list'>";
  actual_page = ["list", ""];
  content = document.getElementById("content_messages");
  for (i in vlist_contacts) {
    content_html +=
      " <div class='contact' onclick=\"open_contact('" +
      vlist_contacts[i] +
      "','username');\"><i class='icon-user'></i>" +
      vlist_contacts[i] +
      "</div>";
  }
  content.innerHTML = content_html + "</div>";
}

function enter_send_message() {
  if (event.which == 13 || event.keyCode == 13) {
    send_message();
  }
}

function send_message() {
  text_input = document.getElementById("content_text");
  content_text = text_input.value;
  idcontact = document.getElementById("idcontact").innerHTML;
  var xhr = new XMLHttpRequest();
  url =
    "../components/services/send_message.php?text=" +
    content_text +
    "&iduser=" +
    idcontact;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      response = readBody(xhr);
    }
  };
  xhr.open("GET", url);
  xhr.send("");
  text_input.value = "";
  check_new_messages();
}

function check_new_messages() {
  $.get("../components/services/check_new_messages.php", {}).done(function(
    data
  ) {
    if (data == "1") {
      update_list_contacts(false);
      refresh_page();
    } else setTimeout("check_new_messages();", 5000);
  });
}

function update_list_contacts(show) {
  $.get("../components/services/get_list_contacts.php", {}).done(function(
    data
  ) {
    vlist_contacts = JSON.parse(data);
  });
  if (show) list_contacts();
}

function refresh_page() {
  if (actual_page[0] == "contact") open_contact(actual_page[1], actual_page[1]);
  else list_contacts();
  setTimeout("check_new_messages();", 5000);
}
