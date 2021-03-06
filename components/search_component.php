<?php
    function search_component() 
    {
        global $connect;
        $text=secure_get('text');
        $category_get=secure_get('cat');
        echo"<section id='search_component'>
            <div id='search'><input placeholder='Rechercher' id='input_search' value='$text' type='text' onKeyDown='enter_search_component(event); updateResults();'/><i class='icon-search'></i></div>
            <div class='an_input'>       
            <select name='category' id='category' class='category' onChange='updateResults();'>";
            $query = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent` IS NULL ORDER BY `category` ASC");
            while($res = mysqli_fetch_array($query))
            {
                $category_cleaned = strtolower(clean_string($res['category']));
                $query2 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent`=$res[idcat] ORDER BY `category` ASC");

                if($category_cleaned!="Toutes-categories")
                {
                    if(mysqli_num_rows($query2))
                    {
                        echo "<optgroup class='a_category' label=\"$res[category]\">";
                        while($res2 = mysqli_fetch_array($query2))
                        {
                            $category_cleaned = strtolower(clean_string($res2['category']));
                            if($category_cleaned == $category_get)
                                echo"<option selected class='a_subcategory' value='$res2[idcat]'>$res2[category]</option>";
                            else
                                echo"<option class='a_subcategory' value='$res2[idcat]'>$res2[category]</option>";
                        }
                        echo "</optgroup>";
                    }
                    else
                    {
                        if($category_cleaned == $category_get)
                            echo"<option selected class='a_category' value='$res[idcat]'><i class='$res[icon]'></i>$res[category]</option>";
                        else
                            echo"<option class='a_category' value='$res[idcat]'><i class='$res[icon]'></i>$res[category]</option>";
                    }
                }
            }
        echo"</select><i class='icon-folder-open-empty'></i></div>
            <div class='an_input'>
                <select  id='filter' onChange='updateResults();'>
                    <option value='last_refresh-DESC'>Les plus récentes</option>
                    <option value='last_refresh-ASC'>Les plus anciennes</option>
                    <option value='price-ASC'>Prix croissant</option>
                    <option value='price-DESC'>Prix décroissant</option>
                </select><i class='icon-menu'></i>
            </div>
            <!--<div id='price_range'>
                <p>
                <label for='amount'>Price range:</label>
                <input type='text' id='amount' readonly style='border:0; color:#f6931f; font-weight:bold;'>
                </p>
                <div id='slider-range'></div>
            </div>-->";
        if(secure_session("connected"))
            echo "<div class='an_input' id='like'><input type='checkbox' onchange='updateResults();' id='like_filter'/><i class='icon-heart'></i></div>";
        
            echo"</section>
        <!--<section id='search_button_section'><div onclick='search_sthg_component();' id='search_button'>Rechercher <span id='numberResults'></span><i class='icon-search'></i></div></section>-->";

        echo "<script type='text/javascript'>
            setTimeout('{updateResults();}', 10);";
            if(secure_session('add_an_ad')==null)
            {
                echo "write_notification('icon-thumbs-up','Ajoute toi aussi des annonces pour enrichir la plateforme !','10000')";
                $_SESSION['add_an_ad']='1';
            }
        echo "</script>";
    }
?>