<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Mentions légales';
            $description_page="Section mentions légales du site de l'association LeBonCup";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);

     
    
     $description_mentions_legales = "Le site http://assos.utc.fr/leboncup/ et l'ensemble des éléments qui le constituent (notamment les dessins, modèles, photos, illustrations, images, chartes graphiques, textes, logos, marques…) sont la propriété exclusive de LeBonCup.<br/><br/>
     En conséquence, il vous est interdit d'utiliser, de représenter ou de reproduire intégralement ou partiellement, par quelque procédé que ce soit, de distribuer, de publier, de transmettre, de modifier ou de vendre tout ou partie du contenu du site ou de créer des oeuvres derivées à partir de celui-ci.<br/><br/>
     La marque de LeBonCup et les logos liés à LeBonCup , deposés ou non, affichés sur le site http://assos.utc.fr/leboncup/ demeureront la propriété exclusive de LeBonCup.<br/><br/>
     Toute reproduction, distribution, transmission, modification ou utilisation de ces éléments sans accord expresse et préalable de LeBonCup, pour quelque motif que ce soit, est interdite.<br/><br/>
     LeBonCup décline toute responsabilité en cas d’utilisation ou d’exploitation illégale des éléments (notamment dessins, photos, modèles, illustrations, images, chartes graphiques, textes, logos, marques et autres signes distinctifs) contenus sur le site.<br/>";
    article("Mentions légales",$description_mentions_legales);
    _footer(); ?>
    </body>
	
</html>