<?php
    include('../../lib/start_session.php');
    
    if(secure_session('connected'))
    {
        $contact=SQLProtect(secure_get('contact'),1);
        $session_id="private_messages_".$contact;
        echo json_encode(secure_session($session_id));
    }
?>