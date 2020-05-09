<?php
    include('../../lib/start_session.php');
    $id=secure_get('id');
    echo "herre<br/>";
    $id=strtolower(SQLProtect($id,true));
    echo $id."<br>";
    echo $_SESSION['connected']."<br>";
    echo secure_session('user')."<br>";
    if($id!=null && secure_session('connected')==true)
    {
        echo "herre";

        $id_user=secure_session('user');
        $query3 = mysqli_query($connect, "SELECT * FROM `users_ad-views-likes` WHERE `idad`= $id AND `iduser`='$id_user'");
        $res_views_likes = mysqli_fetch_array($query3);
        if (count($res_views_likes) != 0)
        { 
            echo "herre";
            if($res_views_likes['liked']==0)
                $query2 = mysqli_query($connect,"UPDATE `users_ad-views-likes` SET `liked` = 1 WHERE `idad`= $id AND `iduser`='$id_user'");
            else
                $query2 = mysqli_query($connect,"UPDATE `users_ad-views-likes` SET `liked` = 0 WHERE `idad`= $id AND `iduser`='$id_user'");            
        } 
    }
?>