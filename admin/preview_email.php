<?php include_once("../lib/start_session.php");?>
<?php include_once("../lib/document_base.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $nom_page='ADMIN';
            $description_page='description';
            include_once("../lib/meta.php");
        ?>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
            $content = secure_get('content');
            $type_mail = secure_get('t');
            if($type_mail == 'news')
            {
                $message="<div style=\"margin: 0px;
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
                <p>".$content."
                <p><br/><p><i>Merci de ne pas répondre à ce mail</i> | <a href='https://assos.utc.fr/leboncup'>LeBonCup</a> | <a href='https://assos.utc.fr/leboncup/unsubscribe/[iduser]/news/[code]'>Se désabonner de la mailing list News</a></p></div></div>";
                echo $message;
            }
           else if($type_mail == 'ads')
           {
                $annonces = "";
                $query2 = mysqli_query($connect,"SELECT * FROM `ads` INNER JOIN `users` WHERE users.iduser = ads.seller AND `visibility`='every_one' AND `status`='to_sell' ORDER BY `last_refresh` DESC LIMIT 10");
                while($res = mysqli_fetch_array($query2))
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
                        $price=round($res['price'],2)."€";
                    else
                        $price="gratuit";
                    $query4 = mysqli_query($connect, "SELECT COUNT(*) FROM `users_ad-views-likes` WHERE `idad`= $res[idad] AND `liked`=1");
                    $res_likes = mysqli_fetch_array($query4);
                    $likes=$res_likes[0];
                    $title_cleaned=clean_string($res['title']);
                    $description=clean_string($res['description']);
                    $show_title=show_clean_string($res['title']);
                    $show_descripton=show_clean_string($res['description']);
                    $show_descripton=remove_balise($show_descripton);
                    if(strlen($show_descripton)>97)
                        $show_descripton=substr($show_descripton,0,97)."<b>...</b>";
                    $annonce = "<a href='https://assos.utc.fr/leboncup/ad/$res[category]/$title_cleaned-$res[idad]' target='_blank'><section class='simple_ad' 
                    style=\"
                        background-color: rgb(250, 250, 250);
                        width: 90%;
                        display: inline-block;
                        margin: 0px;
                        margin-bottom: 15px;
                        box-shadow: 5px 0px 10px rgb(221, 221, 221);
                        padding: 10px;
                        border-radius: 5px;\">
                    <table style=\"width=100%; margin-bottom: 35px\">
                        <tr style=\"width=100%;\">
                            <td class='left' 
                            style=\"height: 100px; 
                            width: 15%;
                            text-align: right;
                            vertical-align: bottom;\">
                                <img src='https://assos.utc.fr/leboncup/ressources/images-ad/$img' alt='image annonce' style=\"width: 100%;
                                height: 100px;
                                object-fit: contain;\"/>
                                <span class='nb_photos' style=\"color: white;
                                border-radius: 5px;
                                padding: 4px;
                                background-color: rgba(0, 0, 0, 0.5);\">$nbr_images photo.s</span>
                            </td>
                            <td class='center' style=\"height: 100px; 
                            width: 85%;
                            border-left: 1px solid rgb(221, 221, 221);
                            color: rgb(0, 0, 0);
                            overflow: hidden;
                            text-overflow: ellipsis;
                            padding-left: 3px;\">
                                <h1 style=\"
                                color: rgb(255, 98, 0);
                                border-bottom: 1px solid rgb(221, 221, 221);
                                width: 90%;
                                padding-bottom: 5px;
                                display: inline-block;
                                margin: 0px;
                                text-align: left;\"> <span class='price' style=\"
                                margin-right: 10px;
                                padding-right: 10px;
                                border-right: 1px solid rgb(221, 221, 221);
                                color: rgb(35, 35, 189);\"><i class='icon-tag'></i>$price</span>$show_title</h1>
                                <p>$show_descripton</p>
                                <div class='details' style=\"text-align: right;
                                text-decoration: none;\">
                                    <span class='seller' style=\"color: rgb(95, 95, 95);
                                    border-left: 1px solid rgb(136, 136, 136);
                                    margin-left: 5px;
                                    padding-left: 5px;
                                    font-size: 0.9em;
                                    text-decoration: none;\">postée par $res[username]</span>
                                    <span class='date_post' style=\"color: rgb(95, 95, 95);
                                    border-left: 1px solid rgb(136, 136, 136);
                                    margin-left: 5px;
                                    padding-left: 5px;
                                    font-size: 0.9em;
                                    text-decoration: none;\">$res[last_refresh]</span>
                                    <span class='views' style=\"color: rgb(95, 95, 95);
                                    border-left: 1px solid rgb(136, 136, 136);
                                    margin-left: 5px;
                                    padding-left: 5px;
                                    font-size: 0.9em;
                                    text-decoration: none;\">$res[views] vue.s</span>
                                    <span class='likes' style=\"color: rgb(95, 95, 95);
                                    border-left: 1px solid rgb(136, 136, 136);
                                    margin-left: 5px;
                                    padding-left: 5px;
                                    font-size: 0.9em;
                                    text-decoration: none;\">$likes favs</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </section></a>";
                    $annonces .= $annonce;   
                }
                $message = "<div style=\"margin: 0px;
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
                <p>Bonjour [username] ! Voici les dernières annonces postées sur <a href='https://assos.utc.fr/leboncup'>LeBonCup</a> !</p>
                <p>Toi aussi, contribue et poste des annonces !</p>
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
                margin: 10px;\">Déposer une annonce</a>
                <section>
                $annonces
                </section>
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
                margin: 10px;\">Déposer une annonce</a>
                <p><br/><p>Merci de ne pas répondre à ce mail | <a href='https://assos.utc.fr/leboncup'>LeBonCup</a> | <a href='https://assos.utc.fr/leboncup/unsubscribe/[iduser]/ads/[code]'>Se désabonner de la mailing list Ads</a></p></div></div>";
                echo $message;
            }
        ?>
    </body>
</html>