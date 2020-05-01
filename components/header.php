<?php
    function _header($buttons){
    echo"<header>
        <div id='logo' onclick=\"open_link('../accueil');\"><img  src='../ressources/images/logo.png' alt='Logo LeBonCup'/></div>";
    if($buttons==true)
    {
        echo" <a href='../deposer-une-annonce'><div id='place_an_ad'>Déposer une annonce<i class='icon-plus-circled'></i></div></a>
        <div id='search'><input placeholder='Rechercher' onkeypress='enter_header(event);' id='input_search' type='text'/><i class='icon-search' onclick='search_sthg();'></i></div>
       ";
    }
        echo"<div id='login'><i class='icon-user-pair'></i>Se connecter</div>
    </header>";
    }
?>