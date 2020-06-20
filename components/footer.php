<?php
    function _footer(){
        echo"<footer>
        <div>
        <p>LeBonCup 2020 - Stéphane BRANLY - Bêta version</p>
        </div>
        </footer>";

        if(secure_session("connected"))
            messages();
    }
?>

