<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../components/components_include.php");
            $id=secure_get('id');
            $id=strtolower(SQLProtect($id,true));
            $query = mysqli_query($connect,"SELECT * FROM `ads` WHERE `idad`=$id");
            $res = mysqli_fetch_array($query);
            if (count($res) != 0) 
            {
                $title=$res['title'];
                $show_descripton = remove_balise($res['description']);
                if($res['price'])
                    $price=round($res['price'],2)."€";
                else
                    $price="gratuit";

                $nbr_images=0;
                if($res['image1'])
                    $nbr_images++;
                if($res['image2'])
                    $nbr_images++;
                if($res['image3'])
                    $nbr_images++;
                if($nbr_images)
                    $img=$res['image1'];
                else
                    $img="nan_".$res['category'].".png";
                echo "<meta property='og:image'  content='https://assos.utc.fr/leboncup/ressources/images-ad/$img'/>";
             }
              else 
              {
                  $title = "Annonce";
                  $show_descripton = "Description annonce";
                  $price="";
              }
            if(strlen($show_descripton)>197)
                $show_descripton=substr($show_descripton,0,197)."...";
            include_once("../lib/google_analytics.php");
            $nom_page="$title ($price)";
            $description_page=$show_descripton;
            include_once("../lib/meta.php");
              ?>
        <meta charset="UTF-8">
	</head>
	<body>
    <?php
        $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

        _header(true);
        
        if (count($res) != 0)
        {
            if($res['visibility']=='every_one' || ($res['visibility']=='connected_user' && secure_session('connected')==true))
                complete_ad($id);
            else
            {
                article("Vous devez être connecté pour voir l'annonce","Vous allez être redirigé dans 5 secondes vers l'accueil");
                echo "<script type='text/javascript'>RedirectionJavascript('accueil',5000);</script>";
            }
        }
        else
        {
            article("Il semblerait que l'annonce n'existe pas...","Vous allez être redirigé dans 5 secondes vers l'accueil");
            echo "<script type='text/javascript'>RedirectionJavascript('accueil',5000);</script>";
        }
        _footer(); ?>
    </body>
	
</html>