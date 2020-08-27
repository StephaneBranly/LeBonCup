<?php
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
            $price=SQLProtect(secure_post('price'),0);
            
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
                $maxSize = 50000000;

                $namefiles = array('f1','f2','f3');
                
                $nameDestination1="";
                $nameDestination2="";
                $nameDestination3="";
                foreach($namefiles as $name)
                {
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

        echo "<section id='post_anad'>
        <form enctype='multipart/form-data' action='../new_ad' method='post'>
            <h1><input name='title' placeholder='Titre annonce' value='$title' type='text' maxlenght='30'/></h1>
            <h2>Photos</h2>
            <input name='f1' type='file'/>
            <input name='f2' type='file'/>
            <input name='f3' type='file'/>

            <!--
            <div id='image_f1' class='preview_image'><input id='input_f1' name='f1' onchange=\"updateImage('f1');\" type='file'/></div>
            <div id='image_f2' class='preview_image'><input id='input_f2' name='f2' onchange=\"updateImage('f2');\" type='file'/></div>
            <div id='image_f3' class='preview_image'><input id='input_f3' name='f3' onchange=\"updateImage('f3');\" type='file'/></div>
            -->
        
            <h2>Détails de l'annonce</h2>
            <div class='an_input'><input type='number' min='0' name='price' value='$price'/><i class='icon-euro'></i></div>
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
            <textarea name='description' placeholder='Description annonce' maxlenght='3000'/>$description</textarea>
            
          
            <button type='submit' id='button_submit'>PUBLIER<i class='icon-paper-plane'></i></button>
            </form>
            </section>";
        }
    }
?>