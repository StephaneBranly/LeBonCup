<?php    
    function _header($buttons){
        $user="";
    if (isset($_SESSION['user'])) 
    {
        $user=$_SESSION['user'];
    }
    echo"<header>
        <div id='logo' onclick=\"open_link('../accueil');\"><img  src='../ressources/images/logo.png' alt='Logo LeBonCup'/></div>";
    if($buttons==true)
    {
        echo" <a href='../deposer-une-annonce'><div id='place_an_ad'>Déposer une annonce<i class='icon-plus-circled'></i></div></a>
        <div id='search'><input placeholder='Rechercher' onkeypress='enter_header(event);' id='input_search' type='text'/><i class='icon-search' onclick='search_sthg();'></i></div>
       ";
    }
    if($user=="")
    {
        echo"<div id='login'><input type='text' id='input_login'/><span onclick='login(this);'><i class='icon-user-pair'></i>Se connecter</span></div>";
    }
    else 
    {
        echo"<div id='login' onclick='deco(this);'><i class='icon-user-pair'></i>$user</div>";
    }
    echo "</header>";
    } 
?>