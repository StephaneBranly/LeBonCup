<?php
    include_once('../../lib/start_session.php');
    include('../../components/simple_ad.php');
    $filter=SQLProtect(secure_get('filter'),1);
    $idcat=SQLProtect(secure_get('idcat'),0);
    $text=SQLProtect(secure_get('text'),1);
    $like_filter=SQLProtect(secure_get('like_filter'),1);
    list($filter_column, $filter_order) = explode('-', $filter);
    $filter_order=strtoupper($filter_order);

    $user = secure_session('user');
    
    if($idcat==1)
    {
        if($like_filter=="true" && secure_session('connected'))
            $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
            INNER JOIN `categories` ON ads.category = categories.category_cleaned
            INNER JOIN `users_ad-views-likes` ON `users_ad-views-likes`.idad = ads.idad 
            WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
            ads.status = 'to_sell' AND `users_ad-views-likes`.liked = 1 AND `users_ad-views-likes`.iduser = '$user'
            ORDER BY ads.$filter_column $filter_order");
        else
        {
            if(secure_session('connected'))
                $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
                INNER JOIN `categories` ON ads.category = categories.category_cleaned
                WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
                ads.status = 'to_sell'
                ORDER BY ads.$filter_column $filter_order");
            else
                $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
                INNER JOIN `categories` ON ads.category = categories.category_cleaned
                WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
                ads.status = 'to_sell' AND
                ads.visibility = 'every_one'
                ORDER BY ads.$filter_column $filter_order");
        }
    }
    else
    {
        if($like_filter=="true" && secure_session('connected'))
            $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
            INNER JOIN `categories` ON ads.category = categories.category_cleaned
            INNER JOIN `users_ad-views-likes` ON `users_ad-views-likes`.idad = ads.idad 
            WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
            (categories.idcat= $idcat OR categories.parent = $idcat) AND
            ads.status = 'to_sell'  AND `users_ad-views-likes`.liked = 1 AND `users_ad-views-likes`.iduser = '$user'
            ORDER BY ads.$filter_column $filter_order");
        else
        {
            if(secure_session('connected'))
                $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
                INNER JOIN `categories` ON ads.category = categories.category_cleaned
                WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
                (categories.idcat = $idcat OR categories.parent = $idcat) AND
                ads.status = 'to_sell' 
                ORDER BY ads.$filter_column $filter_order");
            else
                $query = mysqli_query($connect,"SELECT ads.idad FROM `ads` 
                INNER JOIN `categories` ON ads.category = categories.category_cleaned
                WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
                (categories.idcat = $idcat OR categories.parent = $idcat) AND
                ads.status = 'to_sell'  AND
                ads.visibility = 'every_one'
                ORDER BY ads.$filter_column $filter_order");
        }  
            
    }
    
    $number_results=mysqli_num_rows($query);
    if($number_results)
    {
        if($number_results==1)
            echo "<div id='number_results'><i class='icon-grocery-store'></i>Nous avons trouvé $number_results résultat</div>";
        else
            echo "<div id='number_results'><i class='icon-grocery-store'></i>Nous avons trouvé $number_results résultats</div>";
    }
    else
        echo "<div id='number_results'><i class='icon-grocery-store'>Il n'y a pas de résultats...</i></div>";

    while($res = mysqli_fetch_array($query))
        simple_ad($res['idad']);
?>