<?php
    function suggestion()
    {
        global $connect;
        $redirect=true;
        $title="";
        $content="";

        if(!empty($_POST))
        {
            $title=SQLProtect(remove_balise(secure_post('title')),1);
            $content=nl2br(SQLProtect(remove_balise(secure_post('content')),1));
            
            if(strlen ($title)>30 || $title=="")
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Le titre doit faire entre 1 et 25 caractères',10000)</script>";
                $redirect=false;
            }
            if(strlen($content)>3000 || $content=="")
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','La description doit faire entre 1 et 3000 caractères',10000)</script>";
                $redirect=false;
            }
            if($redirect)
            {
                $date = date('Y-m-d H:i:s');
                $user='';
                if(secure_session('connected'))
                    $user=secure_session('user');
                $query = mysqli_query($connect,"INSERT INTO `suggestions` (iduser,title,content,date) 
                VALUES ('$user','$title','$content','$date')");

                $_SESSION['notification_icon']='icon-note';
                $_SESSION['notification_new']=true;
                $_SESSION['notification_content']="Merci pour votre suggestion !";
                echo "<script type='text/javascript'>RedirectionJavascript('accueil',100);</script>";
            }
        }

        echo "<section id='suggestion'>
        <form action='../suggestion' method='post'>
            <h1>Faire une suggestion</h1><br/>
            <div class='an_input'><input type='text' name='title' maxlenght='30' value='$title' placeholder='Titre'/></div>
            <textarea name='content' placeholder='Décrivez votre suggestion ici' maxlenght='3000'/>$content</textarea>
            <button type='submit' id='button_submit'>ENVOYER<i class='icon-paper-plane'></i></button>
        </form>
        </section>";
    }
?>