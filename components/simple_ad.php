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
            if($res['price'])
                $price=$res['price']."€";
            else
                $price="gratuit";
            echo "<section class='simple_ad' onclick=\"load_ad('jouets','tracteur-pour-enfant','$res[idad]');\">
            <table>
                <tr>
                    <td class='left' style=\"background-image: url('../ressources/images-ad/$res[image1]');\">
                        <span class='nb_photos'>$nbr_images<i class='icon-camera'></i></span>
                    </td>
                    <td class='center'>
                        <h1><span class='price'><i class='icon-tag'></i>$price</span>$res[title]</h1>
                        <p>$res[description]</p>
                        <div class='details'>
                            <span class='seller'>posté par $res[username]</span>
                            <span class='date_post'>$res[publish_date]</span>
                            <span class='views viewed'>$res[views]<i class='icon-eye'></i></span>
                            <span class='likes'>3<i class='icon-heart'></i></span></div>
                        </div>
                    </td>
                </tr>
            </table>
            </section>
            ";
        }
        
    }
?>