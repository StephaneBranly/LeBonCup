<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php"); ?>
<!DOCTYPE html>
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
     $_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];

     
    
     $description_mentions_legales = "
     <h3>Propriétaire</h3>
     Club LeBonCup<br/>
     Adresse :<br/>
        UTC, Maison des étudiants,<br/>
        Rue Roger Coutolenc<br/>
        60200 Compiègne, France<br/>
        leboncup@assos.utc.fr<br/>
    <h3>Définitions</h3>
        <ul>
            <li>Utilisateur : Internaute se connectant, utilisant le site susnommé.</li>   
            <li>Informations personnelles : « les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).</li>
        </ul>
    <h3>Conditions générales d'utilisation</h3> 
        L'utilisation du site assos.utc.fr/leboncup implique l'acceptation pleine et entière des conditions générales d'utilisation ci-après décrites. Ces conditions d'utilisation sont susceptibles 
        d'être modifiées ou complétées à tout moment, les utilisateurs du site assos.utc.fr/leboncup sont donc invités à les consulter de manière régulière. <br/>
        Ce site est normalement accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par le club Le, qui s'efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l'intervention.<br/>
        Le site assos.utc.fr/leboncup est mis à jour régulièrement par le club LeBonCup. De la même façon, les mentions légales peuvent être modifiées à tout moment : elles s'imposent néanmoins à l'utilisateur qui est invité à s'y référer le plus souvent possible afin d'en prendre connaissance.<br/>
    <h3>Données personnelles</h3>

        En France, les données personnelles sont notamment protégées par la loi n° 78-87 du 6 janvier 1978 modifiée, la loi n° 2004-801 du 6 août 2004, l'article L. 226-13 du Code pénal et la Directive Européenne du 24 octobre 1995.<br/>
        
        A l'occasion de l'utilisation du site assos.utc.fr/leboncup, peuvent êtres recueillies : l'URL des liens par l'intermédiaire desquels l'utilisateur a accédé au site assos.utc.fr/leboncup, le fournisseur d'accès de l'utilisateur, l'adresse de protocole Internet (IP) de l'utilisateur. En tout état de cause, le club LeBonCup ne collecte des informations personnelles relatives à l'utilisateur que pour le besoin de certains services proposés par le site assos.utc.fr/leboncup. L'utilisateur fournit ces informations en toute connaissance de cause, notamment lorsqu'il procède par lui-même à leur saisie.<br/>
        
        Il est alors précisé à l'utilisateur du site assos.utc.fr/leboncup l'obligation ou non de fournir ces informations. Conformément aux dispositions des articles 38 et suivants de la loi 78-17 du 6 janvier 1978 modifée relative à l'informatique, aux fichiers et aux libertés, tout utilisateur dispose d'un droit d'accès, de rectification et d'opposition aux données personnelles le concernant, en effectuant sa demande écrite et signée, accompagnée d'une copie du titre d'identité avec signature du titulaire de la pièce, en précisant l'adresse à laquelle la réponse doit être envoyée.<br/>
     <h3>Licence</h3>
     MIT License<br/><br/>

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