<?php
    include('../../lib/start_session.php');
    
    if(secure_session('connected'))
    {
        $contact=secure_get('contact');
        $session_id="private_messages_".$contact;
        echo json_encode(secure_session($session_id));
    }
?>