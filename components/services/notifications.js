function write_tmp_notification(icon, content) {
  var section_notifs = document.getElementById("notifications");
  var actual_content = section_notifs.innerHTML;
  unique_id = Date.now();
  section_notifs.innerHTML =
    "<div class='notification' id='notification_" +
    unique_id +
    "'><i class='" +
    icon +
    "'></i><p>" +
    content +
    "<p></div>" +
    actual_content;
  setTimeout("remove_notification(" + unique_id + ");", 5000);
}

function remove_notification(id) {
  real_id = "notification_" + id;
  var notification = document.getElementById(real_id);
  notification.parentNode.removeChild(notification);
}
