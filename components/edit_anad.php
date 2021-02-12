<?php
    function edit_anad($id)
    {
        global $connect;
        $query = mysqli_query($connect,"SELECT * FROM `ads` WHERE `idad`=$id");
        $res = mysqli_fetch_array($query);
        if(secure_session('connected') && (secure_session('user')==$res['seller'] || is_admin()))
        {
            global $connect;
            $redirect=true;
            $title=$res['title'];
            $description=$res['description'];
            $visibility=$res['visibility'];
            $price=$res['price'];
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
                $query = mysqli_query($connect,"UPDATE `ads` SET `title`='$title' , `category`='$category' , `description`='$description', `visibility`='$visibility', `price`='$price', `last_refresh`='$date'
                WHERE `idad`=$id"); 

                $title_cleaned = $title_cleaned=clean_string($title);
                
                $_SESSION['notification_icon']='icon-note';
                $_SESSION['notification_new']=true;
                $_SESSION['notification_content']="L'annonce a bien été mise à jour !";
                echo "<script type='text/javascript'>load_ad('$category','$title_cleaned','$id');</script>";

            }
        }


        if($res['status']=='sold')
        echo"<section id='status_ad'>
            <i class='icon-cancel-circled2'></i> Annonce déclarée comme vendue.</section>";
        else if($res['status']!='to_sell') echo"<section id='status_ad'>
        <i class='icon-cancel-circled2'></i> Annonce déclarée comme non disponible.</section>";

        echo "<section id='edit_anad'>
        
        <form enctype='multipart/form-data' action='' method='post'>
            <h1><input name='title' id='ad_title' placeholder='Titre annonce' value='$title' type='text' maxlenght='30'/></h1>
            <h2>Photos</h2>

            <div id='images_form'>
                <div class='preview_image add' onclick=\"write_notification('icon-cancel-circled','Les images ne peuvent pas être modifiées',10000)\"><img src='../ressources/images-ad/$img' alt='image 1'/></div>";
                if($res['image2'])
                    echo"<div class='preview_image add' onclick=\"write_notification('icon-cancel-circled','Les images ne peuvent pas être modifiées',10000)\"><img src='../ressources/images-ad/$res[image2]' alt='image 2'/></div>";
                if($res['image3'])
                    echo"<div class='preview_image add' onclick=\"write_notification('icon-cancel-circled','Les images ne peuvent pas être modifiées',10000)\"><img src='../ressources/images-ad/$res[image3]' alt='image 3'/></div>";
            echo "</div>

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
            
          
            <button type='submit' id='button_submit'>Mettre à jour<i class='icon-pencil'></i></button>
           </form>
            </section>";
        }
    }
?>