<?php
    function _header($buttons){
    echo"<header>
        <a href='../accueil'><div id='logo'><img  src='../ressources/images/logo.png' alt='Logo LeBonCup'/></div></a>";
    if($buttons==true)
    {
        echo" <a href='../deposer-une-annonce'><div id='place_an_ad'>Déposer une annonce<i class='icon-note'></i></div></a>
        <div id='research'><input placeholder='Rechercher' id='input_research' type='text'/><i class='icon-search'></i></div>
       ";
    }
        echo"<div id='login'><i class='icon-user-pair'></i>Se connecter</div>
    </header>";
    }
?>