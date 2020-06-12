<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Rechercher';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
        _header(false);
        search_component();

        $category=secure_get('cat');
        $category = preg_replace('#-#', ' ', $category);
        $queryCat = mysqli_query($connect,"SELECT * FROM `categories` WHERE `category` = '$category'");
        $resCat = mysqli_fetch_array($queryCat);
        $idCat = $resCat['idcat'];
        $text=secure_get('text');
        if($idCat==1)
            $query = mysqli_query($connect,"SELECT * FROM `ads` 
            INNER JOIN `categories` ON ads.category = categories.category
            WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
            ads.status = 'to_sell' 
            ORDER BY ads.last_refresh DESC ");
        else
            $query = mysqli_query($connect,"SELECT * FROM `ads` 
            INNER JOIN `categories` ON ads.category = categories.category
            WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
            (categories.idcat= $idCat OR categories.parent = $idCat) AND
            ads.status = 'to_sell' 
            ORDER BY ads.last_refresh DESC ");
        while($res = mysqli_fetch_array($query))
        {
            simple_ad($res['idad']);
        }
        
        _footer(); ?>
    </body>
	
</html>