<?php
    function article($title,$description)
    {
        echo"<section class='article'>
            <div class='content_section'>
                <h1 class='section_name'>$title</h1>
                <p>$description</p>
            </div>
        </section>";
    }
?>