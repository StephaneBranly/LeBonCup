<?php
    function post_ad()
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
            $description=SQLProtect(remove_balise(secure_post('description')),1);
            $visibility=SQLProtect(secure_post('visibility'),1);
            $price=SQLProtect(secure_post('price'),0);
            
            if(strlen ($title)>30 || $title=="")
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Le titre doit faire entre 1 et 25 caractères',10000)</script>";
                $redirect=false;
            }
            if(strlen ($description)>3000)
            {
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','La description doit faire moins de 3000 caractères',10000)</script>";
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
                $query = mysqli_query($connect,"INSERT INTO `ads` (seller,title,sub_category,description,visibility,price,publish_date,last_refresh) 
                VALUES ('$user','$title','autres','$description','$visibility',$price,'$date','$date')");
                $id = mysqli_insert_id($connect);

                $extensions = array('png','jpg','jpeg');
                $inputImages = array("f1","f1","f3");

                $dirDestination = "..\\ressources\\images-ad\\";
                $maxSize = 5000000;

                $namef1 = $_FILES['f1']['name'];
                $image1Name = pathinfo($namef1);
                $nameDestination1="";
                if($namef1!="")
                {
                    $extension1 = strtolower($image1Name['extension']);         
                    if(in_array($extension1, $extensions))
                    {
                        $nameDestination1 = secure_session('user')."_".date("YmdHis")."_".$id."_img1.".$extension1;
                        if(filesize($_FILES['f1']['tmp_name']) <= $maxSize)
                        {
                            if(move_uploaded_file($_FILES["f1"]["tmp_name"], $dirDestination.$nameDestination1))
                            {
                                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Fichier déplacé',10000)</script>";   
                            } 
                            else 
                            {
                                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Il y a eu une erreur lors de la publication de la photo 1...',10000)</script>";
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
                if($redirect)
                {
                    $query2 = mysqli_query($connect,"UPDATE `ads` 
                    SET `image1` = '$nameDestination1'
                    WHERE `idad`=$id");
                    $title_cleaned = $title_cleaned=clean_string($title);
                    $_SESSION['notification_icon']='icon-note';
                    $_SESSION['notification_new']=true;
                    $_SESSION['notification_content']="L'annonce a bien été ajoutée !";
                    echo "<script type='text/javascript'>load_ad('autres','$title_cleaned','$id');</script>";
                }
                else
                {
                    $query2 = mysqli_query($connect,"DELETE FROM `ads` WHERE `idad`=$id");
                }
            }
            
           
        }

        echo "<section id='post_ad'>
        <form enctype='multipart/form-data' action='../new_ad' method='post'>
            <h1><input name='title' placeholder='Titre annonce' value='$title' type='text' maxlenght='30'/></h1>
            <h2>Photos</h2>
            <input name='f1' type='file'/>
            <input name='f2' type='file'/>
            <input name='f3' type='file'/>

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
            <textarea name='description' placeholder='Description annonce' maxlenght='3000'/>$description</textarea>
            
          
            <button type='submit' id='button_submit'>PUBLIER<i class='icon-paper-plane'></i></button>
            </form>
            </section>";
        }
    }
?>