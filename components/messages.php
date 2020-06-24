<?php 
    function messages()
    {
        $status_pm = secure_session('status_pm');
        if($status_pm==null)
            $_SESSION['status_pm']='list';
        $contact = secure_session('contact_pm');
        echo "<section id='messages'>
        <div id='head_messages' onclick='switch_messages();'>Messages privés <i class='icon-comment'></i></div>
        <div id='content_messages'>
            
        </div>
        </section>";
        $status_pm = secure_session('status_pm');
        echo "<script type='text/javascript'>
        var actual_page = ['$status_pm', '$contact'];";
        if($status_pm=='list')
            echo "setTimeout(\"{ check_new_messages(); update_list_contacts(true); }\",100);";
        else
            echo "setTimeout(\"{ check_new_messages(); update_list_contacts(false); open_contact('$contact', '$contact'); }\",100);";
        echo "</script>";
    }
?>