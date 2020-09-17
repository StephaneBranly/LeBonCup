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
            $validation=SQLProtect(secure_post('validation'),1);
            if($validation)
            {
                $iduser = SQLProtect(secure_post('iduser'),1);

                $subject = "LeBonCup - ".secure_post('title');

                $headers = "From: leboncup@assos.utc.fr \r\n";
                $headers .= "Reply-To: stephane.branly@etu.utc.fr \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                $message=secure_post('content');
                $message=$message."<br/><br/><br/><i>Merci de ne pas répondre à ce mail</i> | <a href='https://assos.utc.fr/leboncup'>LeBonCup</a> | <a href=https://assos.utc.fr/leboncup/unsubscribe/[iduser]/news/[code]'>Se désabonner de la mailing list News</a>";

                if($iduser=="tout_le_monde")
                {
                    $query = mysqli_query($connect,"SELECT * FROM `users` ORDER BY `iduser` ASC");
                    while($res = mysqli_fetch_array($query))
                        if($res['mail']!='' && $res['mail_news'])
                        {
                            $message_copy=$message;
                            $message_copy=str_replace("[username]",$res['username'], $message_copy);
                            $message_copy=str_replace("[iduser]",$res['iduser'], $message_copy);
                            $message_copy=str_replace("[code]",$res['mail_news'], $message_copy);
                            mail($res['mail'], $subject, $message_copy, $headers);
                        }
                    echo "<script type='text/javascript'>write_notification('icon-paper-plane','Mail envoyé à tout le monde','5000');</script>";  
                }
                else
                {
                    $query = mysqli_query($connect,"SELECT * FROM `users` WHERE `iduser`='$iduser'");
                    $res = mysqli_fetch_array($query);
                    if($res['mail']!='' && $res['mail_news'])
                    {
                        $message_copy=$message;
                        $message_copy=str_replace("[username]",$res['username'], $message_copy);
                        $message_copy=str_replace("[iduser]",$res['iduser'], $message_copy);
                        $message_copy=str_replace("[code]",$res['mail_news'], $message_copy);
                        mail($res['mail'], $subject, $message_copy, $headers);
                        echo "<script type='text/javascript'>write_notification('icon-paper-plane','Mail envoyé à $res[mail]','5000');</script>";
                    }
                }
            }
            else
                echo "<script type='text/javascript'>write_notification('icon-exclamation','Il faut valider avant d envoyer un mail','5000');</script>";
        }
        echo"<section id='admin'>
        <h1>Envoie de mail</h1>
        <form action='../admin/send_email' method='post'>
            <select name='iduser'>
                <option value='tout_le_monde' selected>Tout le monde</option>";
                $query = mysqli_query($connect,"SELECT * FROM `users` ORDER BY `iduser` ASC");
                while($res = mysqli_fetch_array($query))
                    echo "<option value='$res[iduser]'>$res[iduser] ($res[mail])</option>";
            echo"</select>
            <h2>Titre</h2><input type='text' name='title' maxlenght='190'/><br/>
            <h2>Contenu</h2><textarea type='text' name='content' maxlenght='1000'/></textarea><br/>
            Validation : <input name='validation' type='checkbox'/>
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
