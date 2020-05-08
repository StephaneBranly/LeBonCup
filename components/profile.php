<?php    
    function profile($user){
        global $connect;
        $edit=secure_get('edit');
        $user=strtolower(SQLProtect($user,true));
        $query = mysqli_query($connect,"SELECT * FROM `users` WHERE `iduser`='$user'");
        $res = mysqli_fetch_array($query);
        if (count($res) != 0)
        {
            if($edit==1 && $user==secure_session('user') && secure_session('connected'))
            {
                $redirect=true;

                $username=$res['username'];
                $phone=$res['phone'];
                $phone_visibility=$res['phone_visibility'];
                $mail=$res['mail'];
                $mail_visibility=$res['mail_visibility'];
                $facebook=$res['facebook'];
                $facebook_visibility=$res['facebook_visibility'];
                $cash=$res['cash'];
                $visa=$res['visa'];
                $payut=$res['payut'];
                $paypal=$res['paypal'];
                $beer=$res['beer'];

                if(isset($_POST['username']))
                {
                    $username=SQLProtect(secure_post('username'),1);
                    $phone=SQLProtect(secure_post('phone'),1);
                    $phone_visibility=SQLProtect(secure_post('visibility_phone'),1);
                    $mail=SQLProtect(secure_post('mail'),1);
                    $mail_visibility=SQLProtect(secure_post('visibility_mail'),1);
                    $facebook=SQLProtect(secure_post('facebook'),1);
                    $facebook_visibility=SQLProtect(secure_post('visibility_facebook'),1);
                    $cash=SQLProtect(secure_post('check_cash'),1);
                    $visa=SQLProtect(secure_post('check_visa'),1);
                    $payut=SQLProtect(secure_post('check_payut'),1);
                    $paypal=SQLProtect(secure_post('check_paypal'),1);
                    $beer=SQLProtect(secure_post('check_beer'),1);
                    if($cash) $cash=1; else $cash=0;
                    if($visa) $visa=1; else $visa=0;
                    if($payut) $payut=1; else $payut=0;
                    if($paypal) $paypal=1; else $paypal=0;
                    if($beer) $beer=1; else $beer=0;


                    /*  CHECK HERE ALL VARIABLES BEFORE UPDATE  */
                    
                    $_SESSION['username']=$username;
                    $query = mysqli_query($connect,"UPDATE `users` 
                    SET `username` = '$username',
                     `phone` = '$phone',
                     `phone_visibility` = '$phone_visibility',
                     `mail` = '$mail',
                     `mail_visibility` = '$mail_visibility',
                     `facebook` = '$facebook',
                     `facebook_visibility` = '$facebook_visibility',
                     `cash` = $cash,
                     `visa` = $visa,
                     `payut` = $payut,
                     `paypal` = $paypal,
                     `beer` = $beer
                     WHERE iduser = '$user'");
                }   
                else
                    $redirect=false;

                if($redirect)
                {
                    echo "<script type='text/javascript'>RedirectionJavascript('/profile/$user',100);</script>";
                    $_SESSION['notification_icon']='icon-floppy';
                    $_SESSION['notification_new']=true;
                    $_SESSION['notification_content']="Modification effectuée";
                }
                echo "<section id='profile'>
                <h1>Profil de $username</h1>
                <form action='../profile/$user-edit' method='post'>
                <h2>Informations compte</h2>
                <table id='informations'>
                    <tr><td class='info_property'><i class='icon-user-pair'></i>Username</td><td class='info_value'><input type='text' name='username' placeholder='username' value='$username'/></td>
                    <tr><td class='info_property'><i class='icon-user-pair'></i>Date création du compte</td><td class='info_value'>05-05-2020 17:25</td>
                    <tr><td class='info_property'><i class='icon-clock'></i>Dernière connexion</td><td class='info_value'>05-05-2020 20:56</td>
                    <tr><td class='info_property'><i class='icon-shop'></i>Nombre d'articles disponibles</td><td class='info_value'>--</td>
                    <tr><td class='info_property'><i class='icon-thumbs-up'></i>Nombre d'articles vendus</td><td class='info_value'>--</td>
                </table>

                <h2>Moyens de contact</h2>";
                $query_visibility = mysqli_query($connect,"SELECT * FROM `visibility` WHERE 1");
                $visibility_options=array();
                while($s=mysqli_fetch_array($query_visibility))
                    array_push($visibility_options,array($s['name'],$s['description']));
                
                
                echo "<div id='contact_phone'>
                <div class='an_input'><input value='$phone' placeholder='0321303030' type='text' name='phone' class='discrete'/><i class='icon-phone'></i></div>
                <div class='an_input'>
                <select name='visibility_phone' class='visibility'>";
                foreach($visibility_options as $option)
                    echo"<option value='$option[0]' name='visibility_phone_$option[0]'>$option[1]</option>";
                echo "</select>   
                <i class='icon-eye'></i>
                </div> 
                </div>";

                echo "<div id='contact_mail'>
                <div class='an_input'><input value='$mail' placeholder='mail@domaine.com' type='text' name='mail' class='discrete'/><i class='icon-mail'></i></div>
                <div class='an_input'>
                <select name='visibility_mail' class='visibility'>";
                foreach($visibility_options as $option)
                    echo"<option value='$option[0]' name='visibility_mail_$option[0]'>$option[1]</option>";
                echo "</select>   
                <i class='icon-eye'></i>
                </div> 
                </div>";

                echo "<div id='contact_facebook'>
                <div class='an_input'><input value='$facebook' placeholder='url_compte_facebook' type='text' name='facebook' class='discrete'/><i class='icon-facebook'></i></div>
                <div class='an_input'>
                <select name='visibility_facebook' class='visibility'>";
                foreach($visibility_options as $option)
                    echo"<option value='$option[0]' name='visibility_facebook_$option[0]'>$option[1]</option>";
                echo "</select>   
                <i class='icon-eye'></i>
                </div> 
                </div>";

                
                if($cash)$cash='checked';else $cash='';
                if($visa)$visa='checked';else $visa='';
                if($payut)$payut='checked';else $payut='';
                if($paypal)$paypal='checked';else $paypal='';
                if($beer)$beer='checked';else $beer='';
                echo "<h2>Préférences de paiement</h2>
                <table id='preferences'>
                <tr><td class='payment'><i class='icon-money'></i>Espèce</td><td class='opinion'><input name='check_cash' $cash type='checkbox'/></td>
                <tr><td class='payment'><i class='icon-cc-visa'></i>Virement</td><td class='opinion'><input name='check_visa' $visa type='checkbox'/></td>
                <tr><td class='payment'><i class='icon-credit-card-alt'></i>PayUT</td><td class='opinion'><input name='check_payut' $payut type='checkbox'/></td>
                <tr><td class='payment'><i class='icon-cc-paypal'></i>Paypal</td><td class='opinion'><input name='check_paypal' $paypal type='checkbox'/></td>
                <tr><td class='payment'><i class='icon-beer'></i>Bière</td><td class='opinion'><input name='check_beer' $beer type='checkbox'/></td>
                </table>
                <button type='submit' id='button_submit'>VALIDER<i class='icon-ok-circled2'></i></button>
                </form>
                </section>";
            }
            else
            {
                echo "<section id='profile'>";
                if($user==secure_session('user'))
                {
                    echo"<div id='modify'><span onclick=\"open_link('../profile/$user-edit');\"><i class='icon-pencil'></i>Editer le profil</span></div>";
                }
                echo"<h1>Profil de $res[username]</h1>
                <h2>Informations compte</h2>
                <table id='informations'>
                    <tr><td class='info_property'><i class='icon-user-pair'></i>ID utilisateur</td><td class='info_value'>$res[iduser]</td>
                    <tr><td class='info_property'><i class='icon-user-pair'></i>Date création du compte</td><td class='info_value'>$res[creation_account]</td>
                    <tr><td class='info_property'><i class='icon-clock'></i>Dernière connexion</td><td class='info_value'>$res[last_connexion]</td>
                    <tr><td class='info_property'><i class='icon-shop'></i>Nombre d'articles disponibles</td><td class='info_value'>??</td>
                    <tr><td class='info_property'><i class='icon-thumbs-up'></i>Nombre d'articles vendus</td><td class='info_value'>??</td>
                </table>

                <h2>Moyens de contact</h2>";

                $contact = array('phone','mail','facebook');

                foreach ($contact as $c)
                {
                    $affiche=false;
                    if($res[$c]!="")
                    {
                        $champ_visibility=$c."_visibility";
                        if(($res[$champ_visibility]=='connected_user' && secure_session('connected')==true) 
                        || ($res[$champ_visibility]=='only_me' && (secure_session('connected')==true && secure_session('user')==$res['iduser']))
                        || ($res[$champ_visibility]=='every_one'))
                             echo"<div id='contact_$c' onclick=\"change_content('contact_$c','$res[$c]');\"><i class='icon-$c'></i>voir le $c</div>";     
                        else
                            echo "<div class='private'><i class='icon-user-secret'></i>$c non visible</div>";

                    }
                    else
                        echo "<div class='private'><i class='icon-cancel-circled'></i>$c non renseigné</div>";
                } 
                
                echo "<!--<div id='contact_mail' onclick=\"change_content('contact_mail','$res[mail]');\"><i class='icon-mail'></i>voir l'email</div>
                <div id='contact_facebook' onclick=\"open_link('www.facebook.com');\"><i class='icon-facebook'></i>voir le profil Facebook</div>
                -->";
                if($res['cash'])$cash='ok';else $cash='cancel';
                if($res['visa'])$visa='ok';else $visa='cancel';
                if($res['payut'])$payut='ok';else $payut='cancel';
                if($res['paypal'])$paypal='ok';else $paypal='cancel';
                if($res['beer'])$beer='ok';else $beer='cancel';
                echo "<h2>Préférences de paiement</h2>
                <table id='preferences'>
                <tr><td class='payment'><i class='icon-money'></i>Espèce</td><td class='opinion'><i class='icon-$cash-circled2'></i></td>
                <tr><td class='payment'><i class='icon-cc-visa'></i>Virement</td><td class='opinion'><i class='icon-$visa-circled2'></i></td>
                <tr><td class='payment'><i class='icon-credit-card-alt'></i>PayUT</td><td class='opinion'><i class='icon-$payut-circled2'></i></td>
                <tr><td class='payment'><i class='icon-cc-paypal'></i>Paypal</td><td class='opinion'><i class='icon-$paypal-circled2'></i></td>
                <tr><td class='payment'><i class='icon-beer'></i>Bière</td><td class='opinion'><i class='icon-$beer-circled2'></i></td>
                </table>
                </section>";
            }
        }
    } 
?>