<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php"); ?>
<!DOCTYPE html>
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page="Faire une suggestion";
            $description_page="Section du site de l'association LeBonCup permettant de faire une suggestion.";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	
    <?php
        $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

    _header(true);
    suggestion();
    _footer(); 
    ?>
    </body>
	
</html>