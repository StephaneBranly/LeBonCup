
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
        <script type="text/javascript">
        function RedirectionJavascript(page){
            url= "../"+page; 
            setTimeout("{document.location.href=url;}", 10);

        }</script>
	</head>
    <?php include_once("../components/components_include.php");?>
	<body onLoad="RedirectionJavascript('accueil')">
    <?php
     _header(true);
     article('Redirection','Vous allez être redirigé vers l\'accueil...');
     _footer(); ?>
    </body>
	
</html>