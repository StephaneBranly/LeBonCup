<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
    <head>
        <?php
            $nom_page='ADMIN';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
            $content = secure_get('content');
            $message="<div style=\"margin: 0px;
            padding: 0px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            background-color: rgb(230, 230, 230);\" >
            <div style=\"background-color: rgb(250, 250, 250);
            width: 90%;
            display: inline-block;
            margin-bottom: 50px;
            margin-top: 50px;
            box-shadow: 5px 0px 10px rgb(221, 221, 221);
            border-radius: 5px;\">
            <h1 style=\"color: rgb(255, 98, 0);
            border-bottom: 1px solid rgb(221, 221, 221);
            width: 90%;
            padding-bottom: 5px;
            display: inline-block;\">LeBonCup</h1>
            <p>".$content."
            <p><br/><p><i>Merci de ne pas répondre à ce mail</i> | <a href='https://assos.utc.fr/leboncup'>LeBonCup</a> | <a href='https://assos.utc.fr/leboncup/unsubscribe/[iduser]/news/[code]'>Se désabonner de la mailing list News</a></p></div></div>";
            echo $message;
        ?>
    </body>
</html>