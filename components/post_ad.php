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
            $title=SQLProtect(secure_post('title'),1);
            $description=SQLProtect(secure_post('description'),1);
            $visibility=SQLProtect(secure_post('visibility'),1);
            $price=SQLProtect(secure_post('price'),0);
            
            $date = date('Y-m-d H:i:s');
            $user=secure_session('user');
            $query = mysqli_query($connect,"INSERT INTO `ads` (seller,title,sub_category,description,visibility,price,publish_date,last_refresh) 
            VALUES ('$user','$title','autres','$description','$visibility',$price,'$date','$date')");
            echo "INSERT INTO `ads` (seller,title,sub_category,description,visibility,price,publish_date,last_refresh) 
            VALUES ('$user','$title','autres','$description','$visibility',$price,'$date','$date')";           
            $id = mysqli_insert_id($connect);

            $extensions = array('png','jpg','jpeg');
            $repertoireDestination = "..\\ressources\\images-ad\\";

            $namef1 = $_FILES['f1']['name'];
            $image1Name = pathinfo($namef1);
            $nomDestination1="";
            if($namef1!="")
            {
                $extension1 = strtolower($image1Name['extension']);
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','$namef1',10000)</script>";           
                if(in_array($extension1, $extensions))
                {
                    
                    $nomDestination1 = secure_session('user')."_".date("YmdHis")."_".$id."_img1.".$extension1;
                    move_uploaded_file($_FILES["f1"]["tmp_name"], $repertoireDestination.$nomDestination1); 
                    /*{
                        echo "Le fichier temporaire ".$_FILES["f1"]["tmp_name"].
                                " a été déplacé vers ".$repertoireDestination.$nomDestination;
                    } else 
                    {
                        echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                                "Le déplacement du fichier temporaire a échoué".
                                " vérifiez l'existence du répertoire ".$repertoireDestination;
                    }*/
                }
                else
                {
                    echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Les images doivent avoir une extension .png, .jpg ou .jpeg',10000)</script>";
                    $redirect=0;
                }
            }
            $namef2 = $_FILES['f2']['name'];
            $image2Name = pathinfo($namef2);
            $nomDestination2="";
            if($namef2!="")
            {
                $extension2 = strtolower($image2Name['extension']);
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','$namef2',10000)</script>";           
                if(in_array($extension2, $extensions))
                {
                    $nomDestination2 = secure_session('user')."_".date("YmdHis")."_".$id."_img2.".$extension2;
                    move_uploaded_file($_FILES["f2"]["tmp_name"], $repertoireDestination.$nomDestination2); 
                }
                else
                {
                    echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Les images doivent avoir une extension .png, .jpg ou .jpeg',10000)</script>";
                    $redirect=0;
                }
            }
            $namef3 = $_FILES['f3']['name'];
            $image3Name = pathinfo($namef3);
            $nomDestination3="";
            if($namef3!="")
            {
                $extension3 = strtolower($image3Name['extension']);
                echo "<script type='text/javascript'>write_notification('icon-cancel-circled','$namef3',10000)</script>";           
                if(in_array($extension3, $extensions))
                {
                    $nomDestination3 = secure_session('user')."_".date("YmdHis")."_".$id."_img3.".$extension3;
                    move_uploaded_file($_FILES["f3"]["tmp_name"], $repertoireDestination.$nomDestination3); 
                }
                else
                {
                    echo "<script type='text/javascript'>write_notification('icon-cancel-circled','Les images doivent avoir une extension .png, .jpg ou .jpeg',10000)</script>";
                    $redirect=0;
                }
            }

            $query2 = mysqli_query($connect,"UPDATE `ads` 
                        SET `image1` = '$nomDestination1',
                        `image2` = '$nomDestination2',
                        `image3` = '$nomDestination3'
                        WHERE `idad`=$id");
        }

        echo "<section id='post_ad'>
        <form enctype='multipart/form-data' action='../new_ad' method='post'>
            <h1><input name='title' placeholder='Titre annonce' value='$title' type='text'/></h1>
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
            <textarea name='description' placeholder='Description annonce'/>$description</textarea>
            
          
            <button type='submit' id='button_submit'>PUBLIER<i class='icon-paper-plane'></i></button>
            </form>
            </section>";
        }
    }
?>