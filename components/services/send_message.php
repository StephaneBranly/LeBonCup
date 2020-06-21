<?php
    include_once('../../lib/start_session.php');

    if(secure_session('connected'))
    {
        $iduser = SQLProtect(secure_get('iduser'),1);
        $text = SQLProtect(secure_get('text'),1);
        $send_by = secure_session('user');
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($connect,"INSERT INTO `messages` (dest,send_by,text,date) VALUES ('$iduser','$send_by','$text','$date')");
    }
?>