<?php
    function simple_ad($id) 
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

            if($res['price'])
                $price=$res['price']."€";
            else
                $price="gratuit";

            $query4 = mysqli_query($connect, "SELECT COUNT(*) FROM `users_ad-views-likes` WHERE `idad`= $id AND `liked`=1");
            $res_likes = mysqli_fetch_array($query4);
            $likes=$res_likes[0];
            $liked=0;
            if(secure_session('connected')==true)
            {
                $id_user=secure_session('user');
                $query3 = mysqli_query($connect, "SELECT * FROM `users_ad-views-likes` WHERE `idad`= $id AND `iduser`='$id_user'");
                $res_views_likes = mysqli_fetch_array($query3);
                if (count($res_views_likes) != 0)
                {
                    $_SESSION[$id_session]=true;
                    $liked=$res_views_likes['liked'];
                }
            }
            $title_cleaned=clean_string($res['title']);
            $description=clean_string($res['description']);
            $show_title=show_clean_string($res['title']);
            $show_descripton=show_clean_string($res['description']);
            $show_descripton=remove_balise($show_descripton);
            $show_descripton=substr($show_descripton,0,100)."...";
            echo "<section class='simple_ad' onclick=\"load_ad('$res[category]','$title_cleaned','$res[idad]');\">
            <table>
                <tr>
                    <td class='left' style=\"background-image: url('../ressources/images-ad/$img');\">
                        <span class='nb_photos'>$nbr_images<i class='icon-camera'></i></span>
                    </td>
                    <td class='center'>
                        <h1><span class='price'><i class='icon-tag'></i>$price</span>$show_title</h1>
                        <p>$show_descripton</p>
                        <div class='details'>
                            <span class='seller'>posté par $res[username]</span>
                            <span class='date_post'>$res[publish_date]</span>";
                            if(secure_session($id_session)==null)
                                echo "<span class='views'>$res[views]<i class='icon-eye'></i></span>";
                            else
                                echo "<span class='views viewed'>$res[views]<i class='icon-eye'></i></span>";
                            if($liked==0)
                                echo "<span class='likes'>$likes<i class='icon-heart'></i></span>";
                            else
                                echo "<span class='likes liked'>$likes<i class='icon-heart'></i></span>";
                        echo"</div>
                    </td>
                </tr>
            </table>
            </section>
            ";
        }
        
    }
?>