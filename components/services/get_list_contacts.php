<?php
    include('../../lib/start_session.php');
    
    if(secure_session('connected'))
    {
        $session_id="private_messages_list_contacts";
        echo json_encode(secure_session($session_id));
    }
?>