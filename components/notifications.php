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
        notification(12,"Bienvenu","icon-eye");
        notification(13,"Bienvenu","icon-pencil");
        echo"</section>";
    }
?>