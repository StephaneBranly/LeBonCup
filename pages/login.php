
<?php include_once("../lib/start_session.php");?>

<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='Login user';
            $description_page="Page de connexion du site de LeBonCup";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);
     article('Redirection','Vous allez être redirigé...');
     _footer(); 
    
     ?>
    <?php
        if(isset($_GET['user']))
        {
            $last_user=secure_session('user');
            $last_username=secure_session('username');
            $_SESSION['user'] = secure_get('user');
            $user=$_SESSION['user'];
            if($user=="")
            {
                session_destroy();
                $_SESSION['connected']=false;
                $_SESSION['notification_icon']='icon-comment';
                $_SESSION['notification_new']=true;
                $_SESSION['notification_content']="A bientôt $last_username";                
                echo "<script type='text/javascript'>RedirectionJavascript('accueil',100);</script>";
            }
            else
            {
                $_SESSION['connected']=true;
                $user=strtolower(SQLProtect($user,true));
                $query = mysqli_query($connect,"SELECT `iduser`,`username` FROM `users` WHERE `iduser`='$user'");
                $res = mysqli_fetch_array($query);
                $date = date('Y-m-d H:i:s');
                if (count($res) == 0)
                {
                    $_SESSION['notification_icon']='icon-cup';
                    $_SESSION['notification_new']=true;
                    $_SESSION['username']=$user;
                    $_SESSION['notification_content']="Bienvenue $user ! Ton compte a été créé !";
                    $query = mysqli_query($connect,"INSERT INTO `users` (iduser,username,creation_account,last_connexion,mail) VALUES ('$user','$user','$date','$date','$user@etu.utc.fr')");
                    echo "<script type='text/javascript'>RedirectionJavascript('profile/$user-edit',1000);</script>";
                }
                else
                {
                    $_SESSION['username']=$res['username'];
                    $_SESSION['notification_icon']='icon-cup';
                    $_SESSION['notification_new']=true;
                    $_SESSION['notification_content']="Bonjour $res[username]";
                    $query = mysqli_query($connect,"UPDATE `users` SET `last_connexion` = '$date' WHERE iduser = '$user'");
                    echo "<script type='text/javascript'>RedirectionJavascript('accueil',1000);</script>";
                }
                
            }
        }
    ?>
    </body>
	
</html>