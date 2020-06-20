<?php 
    function messages()
    {
        echo "<section id='messages'>
        <div id='head_messages' onclick='switch_messages();'>Messages privés <i class='icon-comment'></i></div>
        <div id='content_messages'>
            <div class='contact' onclick=\"open_contact('stephane_branly');\"><i class='icon-user'></i>stephane_branly</div>
            <!--<div id='active_contact'><i class='icon-left-open'></i><i class='icon-user'></i>stephane_branly</div>
            <div class='me'><span>Bonjour, comment vas-tu ?</span></div>
            <div class='friend'><span>Bien et toi ?</span></div>
            <div class='me'><span>Bonjour, comment vas-tu ?</span></div>-->
        </div>
        </section>";
    }

?>