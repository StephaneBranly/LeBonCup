<?php
    include('../../lib/start_session.php');
    $id=secure_get('id');
    $id=strtolower(SQLProtect($id,true));
    if($id!=null && secure_session('connected')==true)
    {
        $id_user=secure_session('user');
        $query3 = mysqli_query($connect, "SELECT * FROM `users_ad-views-likes` WHERE `idad`= $id AND `iduser`='$id_user'");
        $res_views_likes = mysqli_fetch_array($query3);
        if (count($res_views_likes) != 0)
        { 
            if($res_views_likes['liked']==0)
            {
                $query2 = mysqli_query($connect,"UPDATE `users_ad-views-likes` SET `liked` = 1 WHERE `idad`= $id AND `iduser`='$id_user'");
                $liked='liked';
            }
            else
            {
                $query2 = mysqli_query($connect,"UPDATE `users_ad-views-likes` SET `liked` = 0 WHERE `idad`= $id AND `iduser`='$id_user'");  
                $liked='';          
            }
            $query4 = mysqli_query($connect, "SELECT COUNT(*) FROM `users_ad-views-likes` WHERE `idad`= $id AND `liked`=1");
            $res_likes = mysqli_fetch_array($query4);
            $likes=$res_likes[0];
            echo "<el class='$liked'>$likes</el><i class='icon-heart $liked'></i>";
        }
        else echo "0";
    }
    else echo "0";
?>