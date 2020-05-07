<?php    
    function _header($buttons){
    echo"<header>
        <div id='logo' onclick=\"open_link('../accueil');\"><img  src='../ressources/images/logo.png' alt='Logo LeBonCup'/></div>";
    if($buttons==true)
    {
        echo"<div id='place_an_ad' onclick=\"write_tmp_notification('icon-user','Vous devez etre connecté...');\">Déposer une annonce<i class='icon-plus-circled'></i></div>
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
        echo"<div id='login'><span onclick=\"view_profile('$user');\"><i class='icon-address-card-o'></i>$user</span><span onclick='deco(this);'><i class='icon-user-pair'></i>Se déconnecter</span></div>";
    }
    echo "</header>";

    notifications();
    } 
?>