<?php
    include_once('../../lib/start_session.php');
    $text=SQLProtect(secure_get('text'),1);
    $idcat=SQLProtect(secure_get('idcat'),0);
    
    if($idcat==1)
    $query = mysqli_query($connect, 
    "SELECT COUNT(*) FROM `ads` 
    WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
    ads.status = 'to_sell' ");
    else
    $query = mysqli_query($connect, 
    "SELECT COUNT(*) FROM `ads` 
    INNER JOIN `categories` ON ads.category = categories.category
    WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
    (categories.idcat= $idcat OR categories.parent = $idcat) AND
    ads.status = 'to_sell' ");
    $res_count = mysqli_fetch_array($query);
    $count=$res_count[0];
    return $count;
?>