<?php
    function post_ad()
    {
        echo "<section id='post_ad'>
        <form method='post'>
            <h1><input placeholder='Titre annonce' type='text'/></h1>
            <h2>Photos</h2>
            <input type='file'/>
            <input type='file'/>
            <input type='file'/>

            <h2>Détails de l'annonce</h2>
            <div class='an_input'><input type='number' min='0'/><i class='icon-euro'></i></div>
            <div class='an_input'>
                <select class='visibility'>
                    <option>Tout le monde</option>
                    <option>Utilisateur connecté</option>
                </select>  <i class='icon-eye'></i>
            </div>
            <textarea placeholder='Description annonce'/></textarea>
            
          
            <button type='submit' id='button_submit'>PUBLIER<i class='icon-paper-plane'></i></button>
            </form>
            </section>";
    }
?>