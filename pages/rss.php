<?php
    header("Content-type: text/xml");
    include_once("../lib/start_session.php");
    $query = mysqli_query($connect,"SELECT * FROM `ads` 
                INNER JOIN `categories` ON ads.category = categories.category_cleaned
                INNER JOIN `users` ON users.iduser = ads.seller
                WHERE ads.status = 'to_sell' AND ads.visibility = 'every_one'
                ORDER BY ads.last_refresh DESC");
 
 
    echo "<?xml version='1.0' encoding='UTF-8'?>
    <rss version='2.0'>
    <channel>
    <title>LeBonCup - Dernières annonces | RSS</title>
    <link>https://assos.utc.fr/leboncup</link>
    <description>Ajoutez quelques dernieres annonces sur votre site Web assos / UTC et devenez partenaire avec LeBonCup!</description>
    <language>en-en</language>";
 
    $myUrl = "https://assos.utc.fr/leboncup";
    while($res = mysqli_fetch_array($query))
    {
        $link = $myUrl."/ad/".$res['category_cleaned']."/".clean_string($res['title'])."-".$res['idad'];
        $imageUrl = $myUrl."/ressources/images-ad/".$res['image1'];
        echo "<item>
            <title>$res[title]</title>
            <id>$res[idad]</id>
            <seller>$res[username]</seller>
            <category>$res[category]</category>
            <price>$res[price]€></price>
            <last_refresh>$res[last_refresh]</last_refresh>
            <image>$imageUrl</image>
            <link>$link</link>
        </item>";   
    }
       
 echo "</channel></rss>";
?>