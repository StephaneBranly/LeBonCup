<?php
    function last_ads()
    {
        global $connect;

        if(secure_session('connected'))
            $query = mysqli_query($connect,"SELECT * FROM `ads` WHERE ads.status = 'to_sell' 
            ORDER BY ads.last_refresh DESC LIMIT 5");
        else
            $query = mysqli_query($connect,"SELECT * FROM `ads` WHERE ads.status = 'to_sell' AND  ads.visibility = 'every_one'
            ORDER BY ads.last_refresh DESC LIMIT 5");
        while($res = mysqli_fetch_array($query))
        {
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
                $price=$res['price']."€";
            else
                $price="gratuit";
            $title_cleaned=clean_string($res['title']);
            echo "<section title='$res[title]' onclick=\"load_ad('$res[category]','$title_cleaned','$res[idad]');\" 
            class='last_ad'><div class='img' style=\"background-image: url('../ressources/images-ad/$img');\"></div>
            <span class='ad_price'><i class='icon-tag'></i>$price</span></section>";
        }
        echo "<section class='view_all' onclick=\"RedirectionJavascript('search/toutes-categories/');\"><div></div><span class='text'><i class='icon-doc'></i>Tout voir</span></section>";
    }
?>