
<?php include_once("../lib/start_session.php");?>
<?php
 if(isset($_GET['user']))
 {
    $_SESSION['user'] = $_GET['user'];
    $user=$_SESSION['user'];
    if($user=="")
    {
        $_SESSION['connected']=false;
    }
    else
    {
        $_SESSION['connected']=true;
    }
 }
?>
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
	<body>
    <?php
     _header(true);
     _footer(); ?>
    </body>
	
</html>