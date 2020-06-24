<?php
    function _footer(){
        echo"<footer>
        <div>
        <p>LeBonCup-Beta 2020 - <span class='link' onclick=\"open_link('../a-propos');\">A propos</span> - <span class='link' onclick=\"open_link('../mentions-legales');\">Mentions légales</span></p>
        </div>
        </footer>";

        if(secure_session("connected"))
            messages();
    }
?>

