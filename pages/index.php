<!DOCTYPE html>
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Accueil';
            $description_page='Accueil du site, vous trouverez ici les informations les plus importantes sur l\'assiociation UT\'Race !';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header();
    article("Bonjour","Ceci est le message de bienvenue");
    article("Nouveau message","L'association a été reprise ce semestre, le concept va totalement être changé mais en gardant la partie historique de pourquoi cette association a été créée quelques semestre plus tôt.");
    _footer(); ?>
    </body>
	
</html>