<?php
    include('../../lib/start_session.php');
    header('Access-Control-Allow-Origin: *');  

    $url = secure_get('url');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'LeBoncup, asso étudiante (https://assos.utc.fr/leboncup/)');
    $result = curl_exec ($ch);
    curl_close($ch);

    $data = var_dump(json_decode($result));
    echo $result;
?>