<?php
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
    if(isset($nom_page) && isset($description_page))
    {
        echo"<title>LeBonCup - $nom_page</title>
        <meta name='Language' content='fr'/>
        <meta name='Description' content='$description_page, du site'/>
        <meta name='Keywords' content='$nom_page, key2'>
        <meta name='Robots' content='all'>";
    }
?>