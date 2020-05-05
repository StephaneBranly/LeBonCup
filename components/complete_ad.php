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
        <div class='left' >
            <div class='details'>
                    <span class='date_post'>30/04/2020 22:43</span>
                    <span class='views viewed'>56<i class='icon-eye'></i></span>
                    <span class='likes'>3<i class='icon-heart'></i></span>
                </div>
            <p>Description annonce qui cette fois-ci ne sera pas tronquée !</p>
        </div>
        <div class='center'> 
            <h1>Contacter <span id='user' onclick=\"view_profile('branlyst')\">branlyst</h1>
            <div id='contact_tel' onclick=\"change_content('contact_tel','0358956480');\"><i class='icon-phone'></i>voir le numéro</div>
            <div id='contact_mail' onclick=\"change_content('contact_mail','test@mail.com');\"><i class='icon-at'></i>voir l'email</div>
            <div id='contact_facebook' onclick=\"open_link('www.facebook.com');\"><i class='icon-facebook'></i>voir le profil Facebook</div>
            <h1>Préférence de paiement</h1>
            <table id='preferences'>
            <tr><td class='paiement'><i class='icon-money'></i>Espèce</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-cc-visa'></i>Virement</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-credit-card-alt'></i>PayUT</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-cc-paypal'></i>Paypal</td><td class='opinion'><i class='icon-cancel-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-beer'></i>Bière</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            </table>
        </div>
        </section>
        ";
    }
?>