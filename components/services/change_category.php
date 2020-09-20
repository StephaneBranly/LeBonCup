<script type="text/javascript" src="./simple_ad.js"></script>
<?php
    include_once('../../lib/start_session.php');
    if(is_admin()){
        $idad=SQLProtect(secure_get('idad'),0);
        $category=strtolower(SQLProtect(secure_post('category'),1));
        $query2 = mysqli_query($connect,"UPDATE `ads` 
        SET `category` = '$category'
        WHERE `idad`=$idad");

        $_SESSION['notification_icon']='icon-edit';
        $_SESSION['notification_new']=true;
        $_SESSION['notification_content']="L'annonce a bien été mise à jour !";
        echo "<script type='text/javascript'>
            setTimeout(document.location.href = '../../ad/$category/title-$idad', 5000);
        </script>";
    }
    else
        echo "Error";
?>