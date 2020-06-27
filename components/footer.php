<?php
    function _footer(){
        echo"<footer>
        <div>
        <p>LeBonCup-Beta 2020 - <a class='link' href='../a-propos'>A propos</a> - <a class='link' href='../mentions-legales'>Mentions légales</a></p>
        </div>
        </footer>";

        if(secure_session("connected"))
            messages();
    }
?>

