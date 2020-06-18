<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Accueil';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);

     $query = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `users` WHERE 1=1");
     $res_count = mysqli_fetch_array($query);
     $nbr_users=$res_count[0];


     $query = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `ads` WHERE ads.status = 'to_sell'");
     $res_count = mysqli_fetch_array($query);
     $nbr_ads_to_sell=$res_count[0];

     $query = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `ads` WHERE ads.status = 'sold'");
     $res_count = mysqli_fetch_array($query);
     $nbr_ads_sold=$res_count[0];

     $query = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `users_ad-views-likes` WHERE `liked`=1");
     $res_count = mysqli_fetch_array($query);
     $nbr_ads_likes=$res_count[0];

     $query = mysqli_query($connect, 
     "SELECT SUM(`views`) FROM `ads` WHERE 1=1");
     $res_count = mysqli_fetch_array($query);
     $nbr_ads_views=$res_count[0];

     $query = mysqli_query($connect, 
     "SELECT SUM(`price`) FROM `ads` WHERE ads.status = 'sold'");
     $res_count = mysqli_fetch_array($query);
     $sum_sold=$res_count[0];

    echo "<section>
        $nbr_users comptes créés !<br/>
        $nbr_ads_to_sell annonces disponibles !<br/>
        $nbr_ads_sold annonces vendues !<br/>
        $nbr_ads_views annonces vues !<br/>
        $nbr_ads_likes annonces likées !<br/>
        $sum_sold € dépensés !<br/>
    </section>";
    article("Bonjour","Ceci est le message de bienvenue");
    article("Nouveau message","L'association a été reprise ce semestre, le concept va totalement être changé mais en gardant la partie historique de pourquoi cette association a été créée quelques semestre plus tôt.");
    _footer(); ?>
    </body>
	
</html>