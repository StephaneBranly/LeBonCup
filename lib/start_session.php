<?php
    session_start();
    if (!isset($_SESSION['user'])) 
    {
        $_SESSION['user'] = "";
    }
    include("secure_get_post_session.php");
    include("sql_connect.php");
?>
