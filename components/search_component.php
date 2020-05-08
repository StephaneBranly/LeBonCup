<?php
    function search_component() 
    {
        echo"<section id='search_component'>
            <div id='search'><input placeholder='Rechercher' id='input_search' type='text' onkeypress='enter_search_component(event);' /></div>
            <div id='category' onclick='show_categories(this);'><i class='icon-menu'></i><span id='label_category'>Toutes catégories</span><i class='icon-down-open'></i></div>
            <table id='categories' style='display:none'>
                <tr>
                <td>
                    <span class='a_category' onclick=\"change_category('Toutes catégories');\"><i class='icon-menu'></i>Toutes catégories</span>
                    <span class='a_category' onclick=\"change_category('Logement');\"><i class='icon-lodging'></i>Logement</span>
                    <span class='a_subcategory' onclick=\"change_category('Location');\">Location</span>
                    <span class='a_subcategory' onclick=\"change_category('Colocation');\">Colocation</span>
                    <span class='a_subcategory' onclick=\"change_category('Chambre chez l\'habitant');\">Chambre chez l'habitant</span>
                    <span class='a_subcategory' onclick=\"change_category('Mobilier');\">Mobilier</span>
                    <span class='a_subcategory' onclick=\"change_category('Décoration');\">Décoration</span>
                    <span class='a_subcategory' onclick=\"change_category('Vaisselle');\">Vaisselle</span>
                </td>
                <td>
                    <span class='a_category' onclick=\"change_category('Vetements');\" ><i class='icon-t-shirt'></i>Vêtements</span>
                    <span class='a_subcategory' onclick=\"change_category('Hauts');\">Hauts</span>
                    <span class='a_subcategory' onclick=\"change_category('Bas');\">Bas</span>
                    <span class='a_subcategory' onclick=\"change_category('Chaussures');\">Chaussures</span>
                    <span class='a_subcategory' onclick=\"change_category('Accessoires');\">Accessoires</span>
                    <span class='a_category' onclick=\"change_category('Transport');\" ><i class='icon-bicycle'></i>Transport</span>
                    <span class='a_subcategory' onclick=\"change_category('Voiture');\" >Voiture</span>
                    <span class='a_subcategory'onclick=\"change_category('Vélo');\" >Vélo</span>
                    <span class='a_subcategory' onclick=\"change_category('Skate');\">Skate</span>
                </td>
                <td>
                    <span class='a_category' onclick=\"change_category('Objets perdus');\" ><i class='icon-search'></i>Objets perdus</span>
                    <span class='a_category' onclick=\"change_category('Etudes');\" ><i class='icon-graduation-cap'></i>Etudes</span>
                    <span class='a_subcategory' onclick=\"change_category('Cours particuliers');\" >Cours particuliers</span>
                    <span class='a_subcategory' onclick=\"change_category('Polycopiés');\">Polycopiés</span>
                    <span class='a_subcategory' onclick=\"change_category('Annales');\" >Annales</span>
                    <span class='a_subcategory' onclick=\"change_category('Fournitures');\" >Fournitures</span>
                </td>
                </td>
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