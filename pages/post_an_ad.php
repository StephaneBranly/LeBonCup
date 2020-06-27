<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page="Déposer une annonce";
            $description_page="Section du site de l'association LeBoncup permettant d'ajouter une annonce";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	
    <?php
    if(secure_session('connected')==false)
    {
        echo "<body onLoad=\"RedirectionJavascript('accueil',1000);\">";
        _header(true);
        article("Vous n'êtes pas connectés",'Vous allez être redirigé vers l\'accueil...');
        $_SESSION['notification_icon']='icon-comment';
        $_SESSION['notification_new']=true;
        $_SESSION['notification_content']="Vous devez être connecté pour ajouter une annonce";
        
    }
    else
    {
        _header(true);
        post_ad();
    }
    
     _footer(); ?>
    </body>
	
</html>