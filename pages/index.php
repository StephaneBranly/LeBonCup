<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php");?>
<!DOCTYPE html>
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Accueil';
            $description_page="Vendez, achetez, échangez, donnez.   LeBonCup est la plateforme dédiée pour trouver ou ajouter des annonces sur des biens et services !";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
        <meta property='og:image'  content='https://assos.utc.fr/leboncup/ressources/images/logo.png'/>
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
        $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

     _header(true);
     last_ads();
     article("Reprise de LeBonCup, ouverture du site en version Beta","<img src='../ressources/images/logo.png'>Nous sommes fiers de vous annoncer que le site LeBoncup est ouvert en version Beta !<br/>A partir de ce site, vous pourrez vendre, acheter, échanger, donner ! <br/><br/>N'hésitez pas à participer à la vie du site en ajoutant du contenu. <br/>Si jamais vous avez des suggestions, vous pouvez les faire <a class='link' href='../suggestion'>ici</a> !");
     
     article("Dernière mise à jour","<p id ='updates_content'></p>");
        echo "<script type='text/javascript'>write_updates(1);</script>";
    
    _footer(); ?>
    </body>
	
</html>