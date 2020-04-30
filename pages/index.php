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
    <?php _header(); ?>
        <section>
            <div class='content_section'>
                <h1 class="section_name">Participer à la course ?</h1>
                <p>Les inscriptions pour participer à la course ne sont pas encore ouvertes... mais n'hésite pas à nous envoyer un petit mail à utrace@assos.utc.fr</p>
            </div>
        </section>
        <section>
            <div class='content_section'>
                <h1 class="section_name">Rejoignez-nous !</h1>
                <p>Viens dès maintenant rejoindre l'association pour nous aider à organiser cet événement de folie !!! Contacte nous par mail ou par Facebook (nos facebook perso ou Raphou Duvolant) ;)<br/>Vrrrooommmmmmmm</p>
            </div>
        </section>
        <section>
            <div class='content_section'>
                <h1 class="section_name">Création</h1>
                <p>L'association a été créée mi septembre 2019 ! Le site mis en place début janvier 2020 !</p>
            </div>
        </section>
    <?php _footer(); ?>
    </body>
	
</html>