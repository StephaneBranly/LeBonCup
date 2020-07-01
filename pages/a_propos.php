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
            $nom_page='A propos';
            $description_page="Section à propos du site de l'association LeBonCup";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);

     
    
     $description_a_propos = "Site créé par Stéphane BRANLY<br/>Code disponible en Opensource sur <a class='link' href='https://github.com/StephaneBranly/LeBonCup'>Github</a>.<br/>Plus d'informations sur l'association LeBonCup sur le <a class='link' href='https://assos.utc.fr/assos/leboncup'>portail des assos</a>.<br/>Icones issues de <a class='link' href='http://fontello.com/'>fontello.com</a>.";
    article("A propos",$description_a_propos);
    _footer(); ?>
    </body>
	
</html>