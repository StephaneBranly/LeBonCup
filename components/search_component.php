<?php
    function search_component() 
    {
        global $connect;
        echo"<section id='search_component'>
            <div id='search'><input placeholder='Rechercher' id='input_search' type='text' onkeypress='enter_search_component(event); updateNumberResults();'/></div>
            <div class='an_input'>
            <select name='category' id='category' class='category' onChange='updateNumberResults();'>";
            $query = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent` IS NULL ORDER BY `category` ASC");
            while($res = mysqli_fetch_array($query))
            {
                $category_cleaned = clean_string($res['category']);
                echo"<option class='a_category' value='$res[idcat]'><i class='$res[icon]'></i>$res[category]</option>";
                $query2 = mysqli_query($connect,"SELECT * FROM `categories` WHERE `parent`=$res[idcat] ORDER BY `category` ASC");
                while($res2 = mysqli_fetch_array($query2))
                {
                    $category_cleaned = clean_string($res2['category']);
                    echo"<option class='a_subcategory' value='$res2[idcat]'>$res2[category]</option>";
                }
            }
        echo"</select><i class='icon-menu'></i></div>
            <div class='an_input'>
                <select  id='filter' onChange='updateNumberResults();'>
                    <option value='new'>Les plus récentes</option>
                    <option value='old'>Les plus anciennes</option>
                    <option value='asc'>Prix croissant</option>
                    <option value='des'>Prix décroissant</option>
                </select>
            </div>
            <!--<div id='price_range'>
                <p>
                <label for='amount'>Price range:</label>
                <input type='text' id='amount' readonly style='border:0; color:#f6931f; font-weight:bold;'>
                </p>
                <div id='slider-range'></div>
            </div>-->
        </section>
        <section id='search_button_section'><div onclick='search_sthg_component();' id='search_button'>Rechercher <span id='numberResults'></span><i class='icon-search'></i></div></section>";
    }
?>