<?php
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
    if(isset($nom_page) && isset($description_page))
    {
        echo"<title>LeBonCup - $nom_page</title>
        <meta name='Language' content='fr'/>
        <meta name='Description' content=\"$description_page\"/>
        <meta name='Keywords' content='$nom_page, leboncup, annonces, ads, utc, assos.utc.fr, assos, revente'>
        <meta name='Robots' content='all'>";
    }
?>