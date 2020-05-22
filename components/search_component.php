<?php
    function search_component() 
    {
        global $connect;
        echo"<section id='search_component'>
            <div id='search'><input placeholder='Rechercher' id='input_search' type='text' onkeypress='enter_search_component(event);' /></div>
            <div id='category' onclick='show_categories(this);'><i class='icon-menu'></i><span id='label_category'>Toutes catégories</span><i class='icon-down-open'></i></div>
            <table id='categories' style='display:none'>
                <tr><td>";
                $query = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent` IS NULL ORDER BY `category` ASC");
                while($res = mysqli_fetch_array($query))
                {
                    echo"<span class='a_category' onclick=\"change_category('$res[category]');\"><i class='$res[icon]'></i>$res[category]</span>";
                    $query2 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent`=$res[idcat] ORDER BY `category` ASC");
                    while($res2 = mysqli_fetch_array($query2))
                    {
                        echo"<span class='a_subcategory' onclick=\"change_category('$res2[category]');\">$res2[category]</span>";
                    }
                }
                echo"</td></tr>
            </table>
            <!--<div id='price_range'>
                <p>
                <label for='amount'>Price range:</label>
                <input type='text' id='amount' readonly style='border:0; color:#f6931f; font-weight:bold;'>
                </p>
                <div id='slider-range'></div>
            </div>-->
        </section>
        <section id='search_button_section'><div onclick='search_sthg_component();' id='search_button'>Rechercher <i class='icon-search'></i></div></section>";
    }
?>