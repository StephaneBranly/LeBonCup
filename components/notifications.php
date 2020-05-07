<?php    
    function notification($id,$content,$icon)
    {
        echo"<div class='notification' id='notification_$id'
        onclick='remove_notification($id)'>
            <i class='$icon'></i>
            <p>$content<p>
        </div>";
    }


    function notifications(){   
        echo"<section id='notifications'>";

        if(secure_session('notification_new'))
        {
            notification(0,secure_session('notification_content'),secure_session('notification_icon'));
            $_SESSION['notification_new']=false;
        }
        echo"</section>";
    }
?>