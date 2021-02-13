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
            $img="nan_".$res['category'].".png";
        
        if(((($res['visibility']=='connected_user' && secure_session('connected')==true) || ($res['visibility']=='every_one'))) || (secure_session('connected') && secure_session('user')==$res['seller']))
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
                if ($res_views_likes && count($res_views_likes) == 0)
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
                $price=round($res['price'],2)."€";
            else
                $price="gratuit";
            $title = show_clean_string($res['title']);
            $description = show_clean_string($res['description']);
            $category_link=clean_string($res['category']);
            $title_link=clean_string($res['title']);
            if(secure_session('connected') && secure_session('user')==$res['seller'])
            {
                if($res['status']=='to_sell')
                {
                    
                    echo"<form id='update_ad' method='post' action='../ad/$category_link/$title_link-$id'>
                    <select name='status'>
                        <option value='to_sell'>A vendre - Refresh</option>
                        <option value='sold'>Vendue</option>
                        <option value='deleted'>Supprimée</option>
                    </select>
                    <button type='submit'>Mettre à jour<i class='icon-params'></i></button>
                    </form>";
                    if(!empty($_POST))
                    {
                        $status=secure_post('status');
                        $date = date('Y-m-d H:i:s');
                        $query6 = mysqli_query($connect,"UPDATE `ads` 
                            SET `last_refresh` = '$date', `status` = '$status' 
                            WHERE `idad`=$id");
                        echo "<script type='text/javascript'>write_notification('icon-params','L\'annonce a correctement été mise à jour',10000)</script>";
                    }
                }
            }
            if(secure_session('connected') && (secure_session('user')==$res['seller'] || is_admin()))
                if($res['status']=='to_sell')
                    echo"<a id='link_edit' href='../ad/$category_link/$title_link-$id-edit'>Editer le contenu<i class='icon-pencil'></i></a>";

            if(is_admin() && $res['status']=='to_sell')
            {
                echo "<form id='update_cat' method='post' action='../components/services/change_category.php?idad=$id'><select name='category' class='category'>";
                $query3 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent` IS NULL ORDER BY `category` ASC");
                while($res3 = mysqli_fetch_array($query3))
                {
                    $category_cleaned = clean_string($res3['category']);
                    $query2 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent`=$res3[idcat] ORDER BY `category` ASC");

                    if($category_cleaned!="Toutes-categories")
                    {
                        if(mysqli_num_rows($query2))
                        {
                            echo "<optgroup class='a_category' label=\"$res3[category]\">";
                            while($res2 = mysqli_fetch_array($query2))
                            {
                                $category_cleaned = clean_string($res2['category']);
                                echo"<option class='a_subcategory' value='$category_cleaned'>$res2[category]</option>";
                            }
                            echo "</optgroup>";
                        }
                        else
                        echo"<option class='a_category' value='$category_cleaned'><i class='$res3[icon]'></i>$res3[category]</option>";
                    }
                }
                echo"</select>
                <button type='submit'>MAJ catégorie<i class='icon-edit'></i></button></form>";
            }
            if($res['status']=='sold')
                echo"<section id='status_ad'>
                   <i class='icon-cancel-circled2'></i> Annonce déclarée comme vendue.</section>";
                else if($res['status']!='to_sell') echo"<section id='status_ad'>
                <i class='icon-cancel-circled2'></i> Annonce déclarée comme non disponible.</section>";
            echo "<section id='complete_ad'>";
            echo"<h1><span class='price'><i class='icon-tag'></i>$price</span>$title</h1>
            
            <img id='photo' onclick='enlarge_photo();' src='../ressources/images-ad/$img' alt='Image annonce'></img>
            
            <img id='viewer_enlarge' onclick='back_photo();' style='display:none;'>
            <div id='photos'>
                <img onclick=\"change_photo('../ressources/images-ad/$img');\" class='miniature_photo' src='../ressources/images-ad/$img' alt='image 1'/>";
                if($res['image2'])
                    echo"<img onclick=\"change_photo('../ressources/images-ad/$res[image2]')\" class='miniature_photo' src='../ressources/images-ad/$res[image2]' alt='image 2'/>";
                if($res['image3'])
                    echo"<img onclick=\"change_photo('../ressources/images-ad/$res[image3]')\" class='miniature_photo' src='../ressources/images-ad/$res[image3]' alt='image 3'/>";
            echo "</div>
            <div class='left' >
                <div class='details'>
                        <span class='date_post'>$res[last_refresh]</span>
                        <span id='viewed'>$views<i class='icon-eye'></i></span>";
                        if($liked==0)
                            echo "<span id='likes' onclick=\"LikeAd($id);\"><el>$likes</el><i class='icon-heart'></i></span>";
                        else
                            echo "<span id='likes' onclick=\"LikeAd($id);\"><el  class='liked'>$likes</el><i class='icon-heart liked'></i></span>";
                        $share_link = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; 
                        echo "<a href='http://www.facebook.com/sharer.php?u=$share_link&t=$share_link' target='_blank'><span id='share_facebook'><el>Partager</el><i class='icon-facebook'></i></span></a>";
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
                /*if(secure_session('connected'))
                    echo "<div id='contact_pm' onclick=\"start_conversation('$res[iduser]','$res[iduser]')\"><i class='icon-comment-alt'></i>Envoyer un message privé</div>";
                else
                    echo "<div class='private'><i class='icon-cancel-circled'></i>Connectez vous pour envoyer un message privé</div>";*/
                echo "<h1>Préférences de paiement</h1>";
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