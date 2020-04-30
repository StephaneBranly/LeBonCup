<?php
    function research_component() 
    {
        echo"<section id='research_component'>
            <div id='research'><input placeholder='Rechercher' id='input_research' type='text'/></div>
            <div id='category'><i class='icon-menu'></i><span id='label_category'>Toutes catégories</span><i class='icon-down-open'></i></div>
            <div id='price_range'>
                <p>
                <label for='amount'>Price range:</label>
                <input type='text' id='amount' readonly style='border:0; color:#f6931f; font-weight:bold;'>
                </p>
                <div id='slider-range'></div>
            </div>
        </section>
        <section id='research_button_section'><div id='research_button'>Rechercher <i class='icon-search'></i></div></section>";
    }
?>