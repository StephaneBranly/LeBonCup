<?php    
    function profile(){
        if(isset($_GET['user']))
        { 
           $user=$_GET['user'];
        }

        echo "<section id='profile'>
            <h1>Profil de $user</h1>

            <h2>Informations compte</h2>
            <table id='informations'>
                <tr><td class='info_property'><i class='icon-user-pair'></i>Date ajout du compte</td><td class='info_value'>05-05-2020 17:25</td>
                <tr><td class='info_property'><i class='icon-clock'></i>Dernière connexion</td><td class='info_value'>05-05-2020 20:56</td>
                <tr><td class='info_property'><i class='icon-shop'></i>Nombre d'articles disponibles</td><td class='info_value'>20</td>
                <tr><td class='info_property'><i class='icon-thumbs-up'></i>Nombre d'articles vendus</td><td class='info_value'>36</td>
            </table>

            <h2>Moyens de contact</h2>
            <div id='contact_tel' onclick=\"change_content('contact_tel','0358956480');\"><i class='icon-phone'></i>voir le numéro</div>
            <div id='contact_mail' onclick=\"change_content('contact_mail','test@mail.com');\"><i class='icon-at'></i>voir l'email</div>
            <div id='contact_facebook' onclick=\"open_link('www.facebook.com');\"><i class='icon-facebook'></i>voir le profil Facebook</div>
            <div class='private'><i class='icon-user-secret'></i>profil Facebook</div>
            
            <h2>Préférences de paiement</h2>
            <table id='preferences'>
            <tr><td class='paiement'><i class='icon-money'></i>Espèce</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-cc-visa'></i>Virement</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-credit-card-alt'></i>PayUT</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-cc-paypal'></i>Paypal</td><td class='opinion'><i class='icon-cancel-circled2'></i></td>
            <tr><td class='paiement'><i class='icon-beer'></i>Bière</td><td class='opinion'><i class='icon-ok-circled2'></i></td>
            </table>
            </section>";
    } 
?>