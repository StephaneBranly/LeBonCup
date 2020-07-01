<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Accueil';
            $description_page="Page d'accueil du site LeBonCup, site ayant pour but de permettre la revente d'objets d'occasions, de services, etc, afin de favoriser la seconde main.";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);
     article("Reprise de LeBonCup, ouverture du site en version Beta","<img src='../ressources/images/logo.png'>Nous sommes fiers de vous annoncer que le site LeBoncup est ouvert en version Beta !<br/>A partir de ce site, vous pourrez vendre, acheter, échanger, donner ! <br/><br/>N'hésitez pas à participer à la vie du site en ajoutant du contenu. <br/>Si jamais vous avez des suggestions, vous pouvez les faire <a class='link' href='../suggestion'>ici</a> !");
     article("Temporaire, AdBlock","<img src='../ressources/images/adblock.png'>Afin de profiter d'une expérience optimale du site, nous vous recommandons de désactiver Adblock pour ce site !");
    _footer(); ?>
    </body>
	
</html>