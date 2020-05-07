
<?php include_once("../lib/start_session.php");?>

<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Login user';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body onLoad="RedirectionJavascript('accueil',10);">
    <?php
     _header(true);
     article('Redirection','Vous allez être redirigé vers l\'accueil...');
     _footer(); 
    
     ?>
    <?php
        if(isset($_GET['user']))
        {
            $last_user=secure_session('user');
            $_SESSION['user'] = secure_get('user');
            $user=$_SESSION['user'];
            if($user=="")
            {
                $_SESSION['connected']=false;
                $_SESSION['notification_icon']='icon-comment';
                $_SESSION['notification_new']=true;
                $_SESSION['notification_content']="A bientôt $last_user";
            }
            else
            {
                $_SESSION['connected']=true;
                $_SESSION['notification_icon']='icon-cup';
                $_SESSION['notification_new']=true;
                $_SESSION['notification_content']="Bonjour $user";
            }
        }
    ?>
    </body>
	
</html>