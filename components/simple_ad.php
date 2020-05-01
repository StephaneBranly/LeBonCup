<?php
    function simple_ad() 
    {
        echo "<a href='annonce-numero' target='_blank'><section class='simple_ad'>
        <table>
            <tr>
                <td class='left' style=\"background-image: url('http://planetepetitsloups.com/images/produits/voitures-a-pedales-tracteur-remorque-pelle-excavatrice.jpg');\">
                    <span class='nb_photos'>2<i class='icon-camera'></i></span>
                </td>
                <td class='center'>
                    <h1><span class='price'><i class='icon-tag'></i>70€</span>Title annonce</h1>
                    <p>Description annonce tronquée à la fin</p>
                    <div class='details'>
                        <a href='user/branlyst' target='_brank'><span class='seller'>posté par branlyst</span></a>
                        <span class='date_post'>30/04/2020 22:43</span>
                        <span class='views viewed'>56<i class='icon-eye'></i></span>
                        <span class='likes'>3<i class='icon-heart'></i></span></div>
                    </div>
                </td>
            </tr>
        </table>
        </section></a>
        ";
    }
?>