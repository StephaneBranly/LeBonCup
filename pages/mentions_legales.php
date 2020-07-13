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
            $nom_page='Mentions légales';
            $description_page="Section mentions légales du site de l'association LeBonCup";
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);

     
    
     $description_mentions_legales = "MIT License<br/><br/>

     Copyright (c) 2020 Stephane_Branly<br/><br/>
     
     Permission is hereby granted, free of charge, to any person obtaining a copy
     of this software and associated documentation files (the 'Software'), to deal
     in the Software without restriction, including without limitation the rights
     to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     copies of the Software, and to permit persons to whom the Software is
     furnished to do so, subject to the following conditions:<br/><br/>
     
     The above copyright notice and this permission notice shall be included in all
     copies or substantial portions of the Software.<br/><br/>
     
     THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
     SOFTWARE.<br/><br/>
     
     LeBonCup décline toutes responsabilités du contenu des annonces postées par les utilisateurs. Nous restons néanmoins disponibles pour le modérer.";
    article("Mentions légales",$description_mentions_legales);
    _footer(); ?>
    </body>
	
</html>