<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php");?>
<!DOCTYPE html>
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
        $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

        _header(true);
    
        $description_a_propos = "Site créé par Stéphane BRANLY<br/>Code disponible en Opensource sur <a class='link' href='https://github.com/StephaneBranly/LeBonCup'>Github</a>.<br/>Plus d'informations sur l'association LeBonCup sur le <a class='link' href='https://assos.utc.fr/assos/leboncup'>portail des assos</a>.<br/>Icones issues de <a class='link' href='http://fontello.com/'>fontello.com</a>.";
        article("A propos",$description_a_propos);
        article("Historique des mises à jour","<p id ='updates_content'></p>");

        echo "<script type='text/javascript'>write_updates(0);</script>";

    _footer(); ?>
    </body>
	
</html>