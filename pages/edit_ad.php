<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php"); ?>
<!DOCTYPE html>
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

    $id = secure_get('id');
    $id=strtolower(SQLProtect($id,true));
    $query = mysqli_query($connect,"SELECT * FROM `ads` WHERE `idad`=$id");
    $res = mysqli_fetch_array($query);
    if(secure_session('connected')==false)
    {
        echo "<body onLoad=\"RedirectionJavascript('accueil',1000);\">";
        _header(true);
        article("Vous n'êtes pas connectés",'Vous allez être redirigé vers l\'accueil...');
        $_SESSION['notification_icon']='icon-comment';
        $_SESSION['notification_new']=true;
        $_SESSION['notification_content']="Vous devez être connecté pour modifier votre annonce";
        
    } else if(secure_session('user')==$res['seller'] || is_admin())
    {
        _header(true);
        edit_anad($id);
    }
    else
    {
        echo "<body onLoad=\"RedirectionJavascript('accueil',1000);\">";
        _header(true);
        article("Vous n'êtes pas en droit de modifier cette annonce...",'Vous allez être redirigé vers l\'accueil...');
        $_SESSION['notification_icon']='icon-comment';
        $_SESSION['notification_new']=true;
        $_SESSION['notification_content']="Vous ne pouvez modifier que vos annonces";
    }
     _footer(); ?>
    </body>
	
</html>