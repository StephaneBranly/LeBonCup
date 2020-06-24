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


     $description = "<b>$nbr_users</b> comptes créés !<br/>
     <b>$nbr_ads_to_sell</b> annonces disponibles !<br/>
     <b>$nbr_ads_sold</b> achats conclus !<br/>
     <b>$nbr_ads_views</b> annonces vues !<br/>
     <b>$nbr_ads_likes</b> annonces en favories !<br/>
     <b>$sum_sold €</b> dépensés !";
    

    article("LeBonCup en quelques chiffres",$description);
    article("Reprise de LeBonCup","Reprise de l'association ce semestre. <br/>A partir de ce site, vous pourrez vendre, acheter, échanger, donner ! <br/><br/>N'hésitez pas à participer à la vie du site en ajoutant du contenu. <br/>Si jamais vous avez des suggestions, vous pouvez les faire <a class='link' href='../suggestion'>ici</a> !");
    _footer(); ?>
    </body>
	
</html>