<?php
    include_once('../../lib/start_session.php');
    include('../../components/simple_ad.php');
    $filter=secure_get('filter');
    list($filter_column, $filter_order) = split('[-]', $filter);
    $filter_order=strtoupper($filter_order);
    $number_results=include('count_results.php');
    
    if($number_results)
    {
        if($number_results==1)
            echo "<div id='number_results'><i class='icon-grocery-store'></i>Nous avons trouvé $number_results résultat</div>";
        else
            echo "<div id='number_results'><i class='icon-grocery-store'></i>Nous avons trouvé $number_results résultats</div>";
    }
    else
        echo "<div id='number_results'><i class='icon-grocery-store'>Il n'y a pas de résultats...</i></div>";
    if($idcat==1)
        $query = mysqli_query($connect,"SELECT * FROM `ads` 
        INNER JOIN `categories` ON ads.category = categories.category
        WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
        ads.status = 'to_sell' 
        ORDER BY ads.$filter_column $filter_order");
    else
        $query = mysqli_query($connect,"SELECT * FROM `ads` 
        INNER JOIN `categories` ON ads.category = categories.category
        WHERE (ads.description LIKE '%$text%' OR ads.title LIKE '%$text%') AND 
        (categories.idcat= $idcat OR categories.parent = $idcat) AND
        ads.status = 'to_sell' 
        ORDER BY ads.$filter_column $filter_order");
    while($res = mysqli_fetch_array($query))
        simple_ad($res['idad']);
?>