<?php
    include_once('../../lib/start_session.php');

    if(!secure_session('send_notif'))
    {
        $icon = secure_get('icon');
        $content = secure_get('content');
        $iduser = secure_get('iduser');
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($connect,"INSERT INTO `notifications` (iduser,icon,content,date) VALUES ('$iduser','$icon','$content','$date')");
        echo "INSERT INTO `notifications` (iduser,icon,content,date) VALUES ('$iduser','$icon','$content','$date'";
        $_SESSION['send_notif']=false;
    }

?>