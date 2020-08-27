

<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link href="../admin/admin.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='ADMIN';
            $description_page='';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);
    if(is_admin())
     {

        echo"<section id='admin'>
        <h1>Stats :</h1>";
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

    /*$query = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `messages` WHERE 1=1");
     $res_count = mysqli_fetch_array($query);*/
    //$nbr_messages=$res_count[0];

    $query_users_day = mysqli_query($connect, 
    "SELECT COUNT(*) FROM `users` WHERE `last_connexion` >= DATE_SUB(NOW(), INTERVAL 1 DAY)
    ");
    $res_count_query_users_day = mysqli_fetch_array($query_users_day);
    $nbr_users_query_users_day=$res_count_query_users_day[0];

    $query_users_week = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `users` WHERE `last_connexion` >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
     ");
     $res_count_query_users_week = mysqli_fetch_array($query_users_week);
     $nbr_users_query_users_week=$res_count_query_users_week[0];

     $query_users_month = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `users` WHERE `last_connexion` >= DATE_SUB(NOW(), INTERVAL 1 MONTH) 
     ");
     $res_count_query_users_month = mysqli_fetch_array($query_users_month);
     $nbr_users_query_users_month=$res_count_query_users_month[0];


     $query_ads_day = mysqli_query($connect, 
     "SELECT COUNT(*) FROM `ads` WHERE `last_refresh` >= DATE_SUB(NOW(), INTERVAL 1 DAY)
     ");
     $res_count_query_ads_day = mysqli_fetch_array($query_ads_day);
     $nbr_ads_query_ads_day=$res_count_query_ads_day[0];
 
     $query_ads_week = mysqli_query($connect, 
      "SELECT COUNT(*) FROM `ads` WHERE `last_refresh` >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
      ");
      $res_count_query_ads_week = mysqli_fetch_array($query_ads_week);
      $nbr_ads_query_ads_week=$res_count_query_ads_week[0];
 
      $query_ads_month = mysqli_query($connect, 
      "SELECT COUNT(*) FROM `ads` WHERE `last_refresh` >= DATE_SUB(NOW(), INTERVAL 1 MONTH) 
      ");
      $res_count_query_ads_month = mysqli_fetch_array($query_ads_month);
      $nbr_ads_query_ads_month=$res_count_query_ads_month[0];

     $description = "<b>$nbr_users</b> comptes créés !<br/>
     <br/>Derniers connectés (1 jour)    : <b>$nbr_users_query_users_day</b>
     <br/>Derniers connectés (1 semaine) : <b>$nbr_users_query_users_week</b>
     <br/>Derniers connectés (1 mois)    : <b>$nbr_users_query_users_month</b><br/><br/>
     <b>$nbr_ads_to_sell</b> annonces disponibles !<br/>
     <br/>Derniers annonces (1 jour)    : <b>$nbr_ads_query_ads_day</b>
     <br/>Derniers annonces (1 semaine) : <b>$nbr_ads_query_ads_week</b>
     <br/>Derniers annonces (1 mois)    : <b>$nbr_ads_query_ads_month</b><br/><br/>

     <b>$nbr_ads_sold</b> achats conclus !<br/>
     <b>$nbr_ads_views</b> annonces vues !<br/>
     <b>$nbr_ads_likes</b> annonces en favories !<br/>
     <b>$sum_sold €</b> dépensés !<br/>";
   
     echo "<p>$description</p>";
        echo"<a href='../admin/home'>Retour</a>
        </section>";
    }
     else 
     article("Accès interdit","Il semblerait que vous n'avez pas le droit d'accèder à cette page... merci de retourner à l'accueil :)");
    _footer(); 
    ?>
    </body>
	
</html>