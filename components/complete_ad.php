<?php
    function complete_ad() 
    {
        echo "<section id='complete_ad'>
        <h1><span class='price'><i class='icon-tag'></i>70€</span>Title annonce</h1>
        <div id='photo' style=\"background-image: url('http://planetepetitsloups.com/images/produits/voitures-a-pedales-tracteur-remorque-pelle-excavatrice.jpg');\">
            <span id='enlarge' onclick='enlarge_photo();'><i class='icon-resize-full'></i></span>
        </div>
        <div id='viewer_enlarge' style='display:none;'>
            <span id='back' onclick='back_photo();'><i class='icon-resize-small'></i></span>
        </div>
        <div id='photos'>
            <div onclick=\"change_photo('http://planetepetitsloups.com/images/produits/voitures-a-pedales-tracteur-remorque-pelle-excavatrice.jpg');\" class='miniature_photo' style=\"background-image: url('http://planetepetitsloups.com/images/produits/voitures-a-pedales-tracteur-remorque-pelle-excavatrice.jpg');\"></div>
            <div onclick=\"change_photo('https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Lippincott_doriangray.jpg/1200px-Lippincott_doriangray.jpg')\" class='miniature_photo' style=\"background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Lippincott_doriangray.jpg/1200px-Lippincott_doriangray.jpg');\"></div>
            <div onclick=\"change_photo('https://i.ytimg.com/vi/Q0fNom3C1vY/maxresdefault.jpg');\" class='miniature_photo' style=\"background-image: url('https://i.ytimg.com/vi/Q0fNom3C1vY/maxresdefault.jpg');\"></div>
        </div>
        <table>
            <tr>
                <td class='left' >
                <div class='details'>
                        <a href='user/branlyst' target='_brank'><span class='seller'>posté par branlyst</span></a>
                        <span class='date_post'>30/04/2020 22:43</span>
                        <span class='views viewed'>56<i class='icon-eye'></i></span>
                        <span class='likes'>3<i class='icon-heart'></i></span></div>
                    </div>
                <p>Description annonce tronquée à la fin</p>
                
                </td>
                <td class='center'> 
                    
                </td>
            </tr>
        </table>
        </section>
        ";
    }
?>