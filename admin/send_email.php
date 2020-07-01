<?php
    
?> 

<?php include_once("../lib/start_session.php");?>
<!DOCTYPE html>
<base href="http://localhost/LeBonCup/pages/"; />
<!--<base href="https://assos.utc.fr/leboncup/pages/"; />-->
<html>
	<link href="../ressources/design/body.css" rel="stylesheet" media="all" type="text/css">
	<link href="../admin/admin.css" rel="stylesheet" media="all" type="text/css">
	<link rel="icon" href="../ressources/images/favicon.ico" type="image/x-icon"/>
    <head>
        <?php
            include_once("../lib/google_analytics.php");
            $nom_page='ADMIN';
            $description_page='';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
	</head>
    <?php include_once("../components/components_include.php");?>
	<body>
    <?php
     _header(true);
    if(is_admin())
     {

        if(!empty($_POST))
        {
            $mail = SQLProtect(secure_post('mail'),1);
            
            $to = $mail;

            $subject = "LeBonCup - Rejoins-nous pour vendre, acheter, échanger et donner !";

            $headers = "From: leboncup@assos.utc.fr \r\n";
            $headers .= "Reply-To: stephane.branly@etu.utc.fr \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            $message = "<h1>LeBonCup</h1>
                        <h2>Le concept</h2>
                        <p>Je pense que tu ne connais pas encore LeBonCup mais ne t'inquiète pas, il sera bientôt dans tes favoris. Il s'agit d'une association utcéenne qui facilite les ventes, achats, échanges, dons de biens et services grâce à son site ! Une plateforme dédiée entièrement à cela et en cours d'élaboration !</p>
                        <h2>Rejoins-nous !</h2>
                        <p>Je t'envoie un message car je pense que tu peux contribuer au site qui est pour l'instant en version bêta !</p>
                        <p>Tu peux poster une annonce ou regarder celles déjà existantes ! Il y a plusieurs catégories disponibles comme le covoiturage, les objets perdus, les polys, les studios, les vêtements, etc !
                        <p>Rejoins-nous rapidement sur <a href='https://assos.utc.fr/leboncup'>le site LeBonCup</a></p>
                        <br/><p>Remonte tes suggestions sur le lien <a href='https://assos.utc.fr/leboncup/suggestion'>suggestion</a></p>
                        <br/><br/>Merci de ne pas répondre à ce mail";
            
            mail($to, $subject, $message, $headers);

            echo "<script type='text/javascript'>write_notification('icon-paper-plane','Mail envoyé à $mail','5000');</script>";
        }
        echo"<section id='admin'>
        <h1>Envoie de mail</h1>
        <form action='../admin/send_email' method='post'>
            <input type='text' name='mail' maxlenght='100'/>
            <button type='submit'>Envoyer mail<i class='icon-paper-plane'></i></button>    
        </form>
        <a href='../admin/home'>Retour</a>
        </section>";
    }
     else 
     article("Accès interdit","Il semblerait que vous n'avez pas le droit d'accèder à cette page... merci de retourner à l'accueil :)");
    _footer(); 
    ?>
    </body>
	
</html>
