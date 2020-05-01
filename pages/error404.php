<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/" />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Error 404';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);
    article("Oups... erreur 404","La page n'existe pas ou plus... merci de retourner à l'accueil :)");
    _footer();
     ?>
    </body>
	
</html>