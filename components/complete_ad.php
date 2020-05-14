<?php
    function complete_ad($id) 
    {
        global $connect;
        $id=strtolower(SQLProtect($id,false));
        $query = mysqli_query($connect,"SELECT * FROM `ads` INNER JOIN `users` WHERE users.iduser = ads.seller AND `idad`=$id");
        $res = mysqli_fetch_array($query);

        $nbr_images=0;
        if($res['image1'])
            $nbr_images++;
        if($res['image2'])
            $nbr_images++;
        if($res['image3'])
            $nbr_images++;
        if($nbr_images)
            $img=$res['image1'];
        else
            $img="nan.png";
        
        if((($res['visibility']=='connected_user' && secure_session('connected')==true) || ($res['visibility']=='every_one')) && $res['status']=='to_sell')
        {
            $id_session="ad".$id;
            if(secure_session('connected')==true)
                $id_session=$id_session.secure_session('user');
            
            $views=$res['views'];
            
            $query4 = mysqli_query($connect, "SELECT COUNT(*) FROM `users_ad-views-likes` WHERE `idad`= $id AND `liked`=1");
            $res_likes = mysqli_fetch_array($query4);
            $likes=$res_likes[0];
            $liked=0;
            if(secure_session('connected')==true)
            {
                $id_user=secure_session('user');
                $query3 = mysqli_query($connect, "SELECT * FROM `users_ad-views-likes` WHERE `idad`= $id AND `iduser`='$id_user'");
                $res_views_likes = mysqli_fetch_array($query3);
                if (count($res_views_likes) == 0)
                    $query4 = mysqli_query($connect, "INSERT INTO `users_ad-views-likes` (idad,iduser) VALUES ('$id','$id_user')");
                else
                {
                    $_SESSION[$id_session]=true;
                    $liked=$res_views_likes['liked'];
                }
            }
            if(secure_session($id_session)==null)
            {
                $views=$views+1;
                $query2 = mysqli_query($connect,"UPDATE `ads` 
                        SET `views` = $views
                        WHERE `idad`=$id");
                $_SESSION[$id_session]=true;
            }

            if($res['price'])
                $price=$res['price']."€";
            else
                $price="gratuit";
            $title = show_clean_string($res['title']);
            $description = show_clean_string($res['description']);
            echo "<section id='complete_ad'>
            <h1><span class='price'><i class='icon-tag'></i>$price</span>$title</h1>
            <div id='photo' style=\"background-image: url('../ressources/images-ad/$img');\">
                <span id='enlarge' onclick='enlarge_photo();'><i class='icon-resize-full'></i></span>
            </div>
            <div id='viewer_enlarge' style='display:none;'>
                <span id='back' onclick='back_photo();'><i class='icon-resize-small'></i></span>
            </div>
            <div id='photos'>
                <div onclick=\"change_photo('../ressources/images-ad/$img');\" class='miniature_photo' style=\"background-image: url('../ressources/images-ad/$img');\"></div>";
                if($res['image2'])
                    echo"<div onclick=\"change_photo('../ressources/images-ad/$res[image2]')\" class='miniature_photo' style=\"background-image: url('../ressources/images-ad/$res[image2]');\"></div>";
                if($res['image3'])
                    echo"<div onclick=\"change_photo('../ressources/images-ad/$res[image3]')\" class='miniature_photo' style=\"background-image: url('../ressources/images-ad/$res[image3]');\"></div>";
            echo "</div>
            <div class='left' >
                <div class='details'>
                        <span class='date_post'>$res[publish_date]</span>
                        <span id='viewed'>$views<i class='icon-eye'></i></span>";
                        if($liked==0)
                            echo "<span id='likes' onclick=\"LikeAd($id);\"><el>$likes</el><i class='icon-heart'></i></span>";
                        else
                            echo "<span id='likes' onclick=\"LikeAd($id);\"><el  class='liked'>$likes</el><i class='icon-heart liked'></i></span>";
                    echo "</div>
                <p>$description</p>
            </div>
            <div class='center'> 
                <h1>Contacter <span id='user' onclick=\"view_profile('$res[iduser]')\">$res[username]</span></h1>";
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
                             echo"<div id='contact_$c' onclick=\"change_content('contact_$c','$res[$c]');  copy_to_clipboard('contact_$c','Le contact');\"><i class='icon-$c'></i>voir le $c</div>";     
                        else
                            echo "<div class='private'><i class='icon-user-secret'></i>$c non visible</div>";

                    }
                    else
                        echo "<div class='private'><i class='icon-cancel-circled'></i>$c non renseigné</div>";
                } 
                
                echo "<h1>Préférence de paiement</h1>";
                if($res['cash'])$cash='ok';else $cash='cancel';
                if($res['visa'])$visa='ok';else $visa='cancel';
                if($res['payut'])$payut='ok';else $payut='cancel';
                if($res['paypal'])$paypal='ok';else $paypal='cancel';
                if($res['beer'])$beer='ok';else $beer='cancel';
                echo "<table id='preferences'>
                <tr><td class='payment'><i class='icon-money'></i>Espèce</td><td class='opinion'><i class='icon-$cash-circled2'></i></td>
                <tr><td class='payment'><i class='icon-cc-visa'></i>Virement</td><td class='opinion'><i class='icon-$visa-circled2'></i></td>
                <tr><td class='payment'><i class='icon-credit-card-alt'></i>PayUT</td><td class='opinion'><i class='icon-$payut-circled2'></i></td>
                <tr><td class='payment'><i class='icon-cc-paypal'></i>Paypal</td><td class='opinion'><i class='icon-$paypal-circled2'></i></td>
                <tr><td class='payment'><i class='icon-beer'></i>Bière</td><td class='opinion'><i class='icon-$beer-circled2'></i></td>
                </table>
            </div>
            </section>
            ";
        }
    }
?>