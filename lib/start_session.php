<?php
    session_start();
    header('Access-Control-Allow-Origin: *');  

    if (!isset($_SESSION['user'])) 
    {
        $_SESSION['user'] = "";
    }
    include("secure_get_post_session.php");
    include("sql_connect.php");
    include("functions.php");

    $local = true;
    if($local)
        echo "<base href='http://localhost/LeBonCup/pages/'; />";
    else 
        echo "<base href='https://assos.utc.fr/leboncup/pages/'; />";
?>
