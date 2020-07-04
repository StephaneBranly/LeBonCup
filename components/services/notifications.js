function write_notification(icon, content, tmp) {
  var section_notifs = document.getElementById("notifications");
  var actual_content = section_notifs.innerHTML;
  unique_id = Date.now();
  section_notifs.innerHTML =
    '<div onclick="remove_notification(' +
    unique_id +
    ");\" class='notification' id='notification_" +
    unique_id +
    "'><i class='" +
    icon +
    "'></i><p>" +
    content +
    "</p></div>" +
    actual_content;
  if (tmp) {
    setTimeout("remove_notification(" + unique_id + ");", tmp);
  }
}

function remove_notification(id) {
  real_id = "notification_" + id;
  var notification = document.getElementById(real_id);
  notification.parentNode.removeChild(notification);
}
