<?php
    include('../../lib/start_session.php');
    if(secure_session('connected'))
    {
        $send_by=secure_session('user');
        $last_update_message=secure_session('last_update_message');
        if($last_update_message == null)
            $last_update_message=0;
        $query = mysqli_query($connect,"SELECT * FROM `messages` WHERE (`send_by` = '$send_by' OR `dest`= '$send_by' ) AND `idmessage` > $last_update_message ORDER BY `idmessage` ASC");
        $new_messages=0;
        while($res = mysqli_fetch_array($query))
        {
            $_SESSION['last_update_message']=$res['idmessage'];
            if($res['dest']==$send_by)
            {
                $view='friend';
                $contact=$res['send_by'];
            }
            else
            {
                $view='me';
                $contact=$res['dest'];
            }
            $text_message=show_clean_string($res['text']);
            $message= array("dest" =>$res['dest'],"username" =>$res['dest'],"view" => $view,"text" => $text_message);
            $session_id="private_messages_".$contact;
            $old_messages = secure_session($session_id);
            if($old_messages==null)
                $old_messages=array();
            array_push($old_messages, $message); 
            $_SESSION[$session_id]=$old_messages;
            $list_contact=secure_session("private_messages_list_contacts");
            if($list_contact==null || $list_contact=="")
                $list_contact=array();
                
            array_unshift($list_contact, $contact);
            $list_contact=array_unique($list_contact);
            $_SESSION['private_messages_list_contacts']=$list_contact;
            $new_messages=1;
        }
        echo $new_messages;
    }
?>