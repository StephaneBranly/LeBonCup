<?php
    function send_mail_ad_added($idad)
    {
        global $connect;
        $annonces = "";
        $query2 = mysqli_query($connect,"SELECT * FROM `ads` INNER JOIN `users` WHERE users.iduser = ads.seller AND `idad`=$idad");
        $res = mysqli_fetch_array($query2);
        
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
        if($res['price'])
            $price=round($res['price'],2)."€";
        else
            $price="gratuit";
        $title_cleaned=clean_string($res['title']);
        $description=clean_string($res['description']);
        $show_title=show_clean_string($res['title']);
        $show_descripton=show_clean_string($res['description']);
        $show_descripton=remove_balise($show_descripton);
        if(strlen($show_descripton)>97)
            $show_descripton=substr($show_descripton,0,97)."<b>...</b>";
        
        $link = "https://assos.utc.fr/leboncup/ad/$res[category]/$title_cleaned-$res[idad]";
        $link_profile = "https://assos.utc.fr/leboncup/profile/$res[iduser]";
        $annonce = "<a href='$link' target='_blank'>
        <div class='simple_ad' >
        <table>
            <tr>
                <td class='left'>
                    <img src='https://assos.utc.fr/leboncup/ressources/images-ad/$img' alt='image annonce'/>
                    <span class='nb_photos'>$nbr_images photo.s</span>
                </td>
                <td class='center' >
                    <h1> <span class='price'>$price</span>$show_title</h1>
                    <p>$show_descripton</p>
                    <div class='details'>
                        <span class='seller'>postée par $res[username]</span>
                        <span class='date_post'>$res[last_refresh]</span>
                        <span class='views'>0 vues</span>
                        <span class='likes'>0 favs</span>
                    </div>
                </td>
            </tr>
        </table>
        </div></a>";
        
        $message = "
        <style type=\"text/css\">
        @media all {
            .simple_ad {
            background-color: rgb(250, 250, 250);
            width: 90%;
            display: inline-block;
            margin: 0px;
            margin-bottom: 15px;
            box-shadow: 5px 0px 10px rgb(221, 221, 221);
            padding: 10px;
            border-radius: 5px;
            }
            .simple_ad:hover {
            cursor: pointer;
            }
            .simple_ad table,
            .simple_ad tbody,
            .simple_ad tr {
            width: 100%;
            }
            .simple_ad table .center,
            .simple_ad table .left {
            height: 100px;
            }
            .simple_ad table .left {
            width: 15%;
            text-align: right;
            vertical-align: bottom;
            }
            .simple_ad table .left img{
            width: 100%;
            height: 100px;
            object-fit: contain;
            }
            .simple_ad table .left .nb_photos {
            color: white;
            border-radius: 5px;
            padding: 4px;
            background-color: rgba(0, 0, 0, 0.5);
            }
            .simple_ad table .center {
            width: 85%;
            border-left: 1px solid rgb(221, 221, 221);
            color: rgb(0, 0, 0);
            overflow: hidden;
            text-overflow: ellipsis;
            padding-left: 3px;
            }
            .simple_ad .center h1 {
            color: rgb(255, 98, 0);
            border-bottom: 1px solid rgb(221, 221, 221);
            width: 90%;
            padding-bottom: 5px;
            display: inline-block;
            margin: 0px;
            text-align: left;
            }
            .simple_ad .center h1 .price {
            margin-right: 10px;
            padding-right: 10px;
            border-right: 1px solid rgb(221, 221, 221);
            color: rgb(35, 35, 189);
            }
            .simple_ad table .center .details {
            text-align: right;
            text-decoration: none;
            }
            .simple_ad table .center .details span {
            color: rgb(95, 95, 95);
            border-left: 1px solid rgb(136, 136, 136);
            margin-left: 5px;
            padding-left: 5px;
            font-size: 0.9em;
            text-decoration: none;
            }
            /*.simple_ad table .center .details .seller:hover {
            color: rgb(129, 129, 129);
            cursor: pointer;
        }*/
            .simple_ad table .center .details .liked {
            color: rgb(233, 21, 21);
            fill: rgb(233, 21, 21);
            }
            .simple_ad table .center .details .viewed {
            color: rgb(35, 35, 189);
            }
        }
        @media all and (max-device-width: 480px) {
            .simple_ad {
            width: 97%;
            padding: 0px;
            border: 0px solid rgba(0, 0, 0, 0);
            }
            .simple_ad table .center,
            .simple_ad table .left {
            height: 100px;
            }
            .simple_ad table .center {
            width: 60%;
            font-size: 30px;
            vertical-align: top;
            padding-top: 10px;
            }
            .simple_ad table .center .details {
            font-size: 15px;
            }
            .simple_ad table .center p,
            .simple_ad table .center .details .seller,
            .simple_ad table .center .details .date_post {
            display: none;
            }
            .simple_ad .center h1 .price {
            display: block;
            border-right: 0px solid rgba(221, 221, 221, 0);
            }
            .simple_ad .center h1 {
            border: 0px solid rgba(0, 0, 0, 0);
            font-size: 15px;
            }
            .simple_ad table .left {
            width: 37%;
            }
            .simple_ad table .left img{
            height: 200px;
            }
        }
        </style>
        <div style=\"margin: 0px;
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
        <p>Bonjour $res[username] ! Ta nouvelle annonce a bien été ajoutée !</p>
        <p>Tu peux partager ton annonce (<a href='$link' target='_blank'>$link</a>) ou bien ton profil si tu as plusieurs annonces ! (<a href='$link_profile' target='_blank'>$link_profile</a></p>
        <p>N'oublie pas de mettre à jour le statut de l'annonce quand tu veux la faire remonter ou la déclarer comme vendue/supprimée.</p>
        <div>
        $annonce
        </div>
        <br/>
        <a href='https://assos.utc.fr/leboncup/new_ad' style=\"
        color: rgb(255, 255, 255);
        display: inline-block;
        border: 1px solid rgba(201, 80, 5, 0);
        padding: 10px;
        text-decoration: none;
        border-radius: 5px;
        background-image: linear-gradient(
            45deg,
            rgb(255, 113, 25),
            rgb(255, 98, 0)
        );
        transition: all 0.1s;
        margin: 10px;\">Déposer une nouvelle annonce</a>
        <br/><br/>
        <p>A très vite sur LeBonCup, Stéphane BRANLY, président !</p>
        <p>Merci de ne pas répondre à ce mail | <a href='https://assos.utc.fr/leboncup'>LeBonCup</a></p></div></div>";

        $headers = "From: leboncup@assos.utc.fr \r\n";
        $headers .= "Reply-To: stephane.branly@etu.utc.fr \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        mail($res['mail'],"LeBonCup - Ta nouvelle annonce",$message,$headers);
    
    }


    function post_anad()
    {
        if(secure_session('connected'))
        {
            global $connect;
            $redirect=true;
            $title="";
            $description="";
            $visibility="every_one";
            $price=0;


        if(!empty($_POST))
        {
            $title=SQLProtect(remove_balise(secure_post('title')),1);
            $title = preg_replace('#/#', '|', $title);
            $description=nl2br(SQLProtect(remove_balise(secure_post('description')),1));
            $visibility=SQLProtect(secure_post('visibility'),1);
            $category=strtolower(SQLProtect(secure_post('category'),1));
            $price=SQLProtectPrice(secure_post('price'),0);
            
            if(strlen ($title)>30 || $title=="")
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Le titre doit faire entre 1 et 25 caractères',10000)</script>";
                $redirect=false;
            }
            if(strlen($description)>3000 || $description=="")
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','La description doit faire entre 1 et 3000 caractères',10000)</script>";
                $redirect=false;
            }
            if(strlen($visibility)>30)
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Il y a une erreur sur la visibilité',10000)</script>";
                $redirect=false;
            }
            if($price<0)
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Le prix doit être positif',10000)</script>";
                $redirect=false;
            }
            if($redirect)
            {
                $date = date('Y-m-d H:i:s');
                $user=secure_session('user');
                $query = mysqli_query($connect,"INSERT INTO `ads` (seller,title,category,description,visibility,price,publish_date,last_refresh) 
                VALUES ('$user','$title','$category','$description','$visibility',$price,'$date','$date')");
                $id = mysqli_insert_id($connect);

                $extensions = array('png','jpg','jpeg');
                $inputImages = array("f1","f1","f3");

                $dirDestination = "../ressources/images-ad/";
                $dirDestinationCopy = "/leboncup/ressources/images-ad/";
                $maxSize = 50000000;

                $namefiles = array('f1','f2','f3');
                
                $nameDestination1="";
                $nameDestination2="";
                $nameDestination3="";
                foreach($namefiles as $name)
                {
                    $input_extern = 'input_extern_'.$name;
                    $input_extern_value = secure_post($input_extern);
                    if($input_extern_value != "")
                    {
                        if(preg_match('/^(.*\.(?!(jpg|jpeg|png)$))?[^.]*$/',$input_extern_value,$result))
                        {
                            $nametmp = secure_session('user')."_".date("YmdHis")."_".$id."_img".$name.".jpeg";
                            $newfile = $dirDestination.$nametmp;
                            if (copy($input_extern_value, $newfile)){
                                if($nameDestination1=="")
                                {
                                    $nameDestination1=$nametmp;
                                }
                                else
                                {
                                    if($nameDestination2=="")
                                    {
                                        $nameDestination2=$nametmp;
                                    }
                                    else
                                    {
                                        $nameDestination3=$nametmp;
                                    }
                                }
                            }else{
                                echo "Copy failed.";
                                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Problème d'importation de la photo externe...',10000)</script>";
                                $redirect=false;   
                            }
                        }
                        else
                        {
                            echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Un document semble ne pas être une photo...',10000)</script>";
                            $redirect=false;
                        }  
                    }
                    
                    $namef1 = $_FILES[$name]['name'];
                    $image1Name = pathinfo($namef1);
                    if($namef1!="")
                    {
                        $extension1 = strtolower($image1Name['extension']);         
                        if(in_array($extension1, $extensions))
                        {
                            $nametmp = secure_session('user')."_".date("YmdHis")."_".$id."_img".$name.".".$extension1;
                            if(filesize($_FILES[$name]['tmp_name']) <= $maxSize)
                            {
                                if(move_uploaded_file($_FILES[$name]["tmp_name"], $dirDestination.$nametmp))
                                {
                                    resize_img($dirDestination.$nametmp,$dirDestination.$nametmp, 900);
                                    echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Fichier déplacé',10000)</script>";
                                    if($nameDestination1=="")
                                    {
                                        $nameDestination1=$nametmp;
                                    }
                                    else
                                    {
                                        if($nameDestination2=="")
                                        {
                                            $nameDestination2=$nametmp;
                                        }
                                        else
                                        {
                                            $nameDestination3=$nametmp;
                                        }
                                    }
                                } 
                                else 
                                {
                                    echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Il y a eu une erreur lors de la publication de la photo...',10000)</script>";
                                    $redirect=false;
                                }
                            }
                            else
                            {
                                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','La photo est trop volumineuse...',10000)</script>";
                                $redirect=false;
                            }
                        }
                        else
                        {
                            echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Les images doivent avoir une extension .png, .jpg ou .jpeg',10000)</script>";
                            $redirect=false;
                        }
                    }
                }
                if($redirect)
                {
                    $query2 = mysqli_query($connect,"UPDATE `ads` 
                    SET `image1` = '$nameDestination1', `image2` = '$nameDestination2', `image3` = '$nameDestination3'
                    WHERE `idad`=$id");
                    $title_cleaned = $title_cleaned=clean_string($title);
            
                    send_mail_ad_added($id);

                    $_SESSION['notification_icon']='icon-note';
                    $_SESSION['notification_new']=true;
                    $_SESSION['notification_content']="L'annonce a bien été ajoutée !";
                    echo "<script type='text/javascript'>load_ad('$category','$title_cleaned','$id');</script>";
                }
                else
                {
                    $query2 = mysqli_query($connect,"DELETE FROM `ads` WHERE `idad`=$id");
                }
            }
            
           
        }

        echo "<section id='import_anad'><span id='flex'>
            <input onchange='handleImport();' placeholder='Importer avec un lien annonce Vinted' onkeypress='handleInputImport(event);' id='input_import' type='text'/>
            <div id='icon_import'><span onclick='import_ad()'><i class='icon-plus' ></i></span></div>   
        </span></section>";

        echo "<section id='import_beta_message'>L'importation est en version bêta, merci de signaler si vous rencontrez des problèmes ! 
        </section>";
            
        echo "<section id='post_anad'>
        
        <form enctype='multipart/form-data' action='../new_ad' method='post'>
            <h1><input name='title' id='ad_title' placeholder='Titre annonce' value='$title' type='text' maxlenght='30'/></h1>
            <h2>Photos</h2>
            
            <input id='input_extern_f1' name='input_extern_f1' type='text' style=\"display: none;\"/>
            <input id='input_extern_f2' name='input_extern_f2' type='text' style=\"display: none;\"/>
            <input id='input_extern_f3' name='input_extern_f3' type='text' style=\"display: none;\"/>

            <div id='images_form'>
                <input id='input_f1' accept='.png,.jpg,.jpeg' name='f1' onchange=\"updateImage('f1');\" type='file'/><div id='image_f1' class='preview_image add' onclick=\"adImage('f1')\"><img id='image_f1_img' /><i class=' icon-plus'></i></div>
                <input id='input_f2' accept='.png,.jpg,.jpeg' name='f2' onchange=\"updateImage('f2');\" type='file'/><div id='image_f2' class='preview_image add' onclick=\"adImage('f2')\"><img id='image_f2_img' /><i class=' icon-plus'></i></div>
                <input id='input_f3' accept='.png,.jpg,.jpeg' name='f3' onchange=\"updateImage('f3');\" type='file'/><div id='image_f3' class='preview_image add' onclick=\"adImage('f3')\"><img id='image_f3_img' /><i class=' icon-plus'></i></div>
            </div>
        
            <h2>Détails de l'annonce</h2>

            <div class='an_input'><input type='number' id='ad_price' min='0.00' step='0.01' name='price' value='$price'/><i class='icon-euro'></i></div>

            <div class='an_input'>
                <select name='visibility' class='visibility'>";
                    if($visibility=='connected_user')
                        echo"
                    <option name='every_one' value='every_one'>Tout le monde</option>
                    <option name='connected_user' value='connected_user' selected>Utilisateur connecté</option>";
                    else 
                    echo "
                    <option name='every_one' value='every_one' selected>Tout le monde</option>
                    <option name='connected_user'value='connected_user'>Utilisateur connecté</option>";
                echo"</select>  <i class='icon-eye'></i>
            </div>
            <div class='an_input'>
                <select name='category' class='category'>";
                $query = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent` IS NULL ORDER BY `category` ASC");
                while($res = mysqli_fetch_array($query))
                {
                    $category_cleaned = clean_string($res['category']);
                    $query2 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent`=$res[idcat] ORDER BY `category` ASC");

                    if($category_cleaned!="Toutes-categories")
                    {
                        if(mysqli_num_rows($query2))
                        {
                            echo "<optgroup class='a_category' label=\"$res[category]\">";
                            while($res2 = mysqli_fetch_array($query2))
                            {
                                $category_cleaned = clean_string($res2['category']);
                                echo"<option class='a_subcategory' value='$category_cleaned'>$res2[category]</option>";
                            }
                            echo "</optgroup>";
                        }
                        else
                        echo"<option class='a_category' value='$category_cleaned'><i class='$res[icon]'></i>$res[category]</option>";
                    }
                }
            echo"</select><i class='icon-menu'></i>
            </div>
            <textarea id='ad_description' name='description' placeholder='Description annonce' maxlenght='3000'/>$description</textarea>
            
          
            <button type='submit' id='button_submit'>PUBLIER<i class='icon-paper-plane'></i></button>
           </form>
            </section>";
        }
    }
?>