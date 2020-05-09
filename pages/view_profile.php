<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $user=secure_get('user');
            $nom_page=$user;
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
        _header(true);
        $user=strtolower(SQLProtect($user,true));
        $query = mysqli_query($connect,"SELECT `iduser` FROM `users` WHERE `iduser`='$user'");
        $res = mysqli_fetch_array($query);
        if (count($res) != 0)
        {
            profile($user);
            $query2 = mysqli_query($connect,"SELECT `idad`,`visibility` FROM `ads` WHERE `seller`='$user'");
            while($res2 = mysqli_fetch_array($query2))
            {
                if($res2['visibility']=='every_one' || ($res2['visibility']=='connected_user' && secure_session('connected')==true))
                    simple_ad($res2['idad']);
            }
        }
        else
        {
            article("Il semblerait que $user n'existe pas...","Vous allez être redirigé dans 5 secondes vers l'accueil");
            echo "<script type='text/javascript'>RedirectionJavascript('accueil',5000);</script>";
        }
            
        _footer(); ?>
    </body>
	
</html>