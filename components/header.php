<?php    
    function _header($buttons){
    echo"<header>
        <div id='logo' onclick=\"open_link('../accueil');\"><img  src='../ressources/images/logo.png' alt='Logo LeBonCup'/></div>";
    if(secure_session('connected')==true)
        echo"<div id='place_an_ad' onclick=\"open_link('../new_ad');\">Déposer une annonce<i class='icon-plus-circled'></i></div>";
    else
        echo"<div id='place_an_ad' onclick=\"write_notification('icon-comment','Vous devez être connecté pour ajouter une annonce','5000');\">Déposer une annonce<i class='icon-plus-circled'></i></div>";
    if($buttons==true)
    {
        echo"<div id='search'><input placeholder='Rechercher' onkeypress='enter_header(event);' id='input_search' type='text'/><i class='icon-search' onclick='search_sthg();'></i></div>";
    }
    if(secure_session('connected')==false)
    {
        echo"<div id='login'><span onclick=\"RedirectionJavascript('pages/log.php?section=login',0);\"><i class='icon-user-pair'></i>Se connecter</span></div>";
    }
    else 
    {
        $user=secure_session('user');
        $username=secure_session('username');
        echo"<div id='login'><span onclick=\"view_profile('$user');\"><i class='icon-address-card-o'></i>$username</span><span onclick=\"RedirectionJavascript('logout',0);\"><i class='icon-user-pair'></i>Se déconnecter</span></div>";
    }
    echo "</header>";

    notifications();
    } 
?>