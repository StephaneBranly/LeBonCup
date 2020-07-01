<?php
    include_once('../../lib/start_session.php');

    if(secure_session('send_notif'))
    {
        $icon = SQLProtect(secure_get('icon'),1);
        $content = remove_balise(SQLProtect(secure_get('content'),1));
        $iduser = SQLProtect(secure_get('iduser'),1);
        $date = date('Y-m-d H:i:s');
        $query = mysqli_query($connect,"INSERT INTO `notifications` (iduser,icon,content,date) VALUES ('$iduser','$icon','$content','$date')");
        $_SESSION['send_notif']=false;
    }

?>