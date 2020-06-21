<?php 
    function messages()
    {
        echo "<section id='messages'>
        <div id='head_messages' onclick='switch_messages();'>Messages privés <i class='icon-comment'></i></div>
        <div id='content_messages'>
            
        </div>
        </section>";

        echo "<script type='text/javascript'>
        window.onload = function () {
            check_new_messages();
            update_list_contacts();
            list_contacts();
            refresh_page();
         }
        </script>";
    }
?>