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
    if(secure_session('connected')==false)
    {
        echo"<div id='login'><input type='text' id='input_login'/><span onclick='login(this);'><i class='icon-user-pair'></i>Se connecter</span></div>";
    }
    else 
    {
        $user=secure_session('user');
        echo"<div id='login'><span><i class='icon-cog'></i>$user</span><span onclick='deco(this);'><i class='icon-user-pair'></i>Se déconnecter</span></div>";
    }
    echo "</header>";
    } 
?>