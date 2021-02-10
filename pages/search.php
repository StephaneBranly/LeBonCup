<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Rechercher';
            $description_page="Section du site de l'association LeBonCup permettant d'effectuer une recherche.";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
        <meta property='og:image'  content='https://assos.utc.fr/leboncup/ressources/images/logo.png'/>
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
        $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

        _header(false);
        search_component();
        echo "<x id='results'></x>";
        _footer(); ?>
    </body>
	
</html>