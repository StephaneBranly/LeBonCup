<?php
    function research_component() 
    {
        echo"<section id='research_component'>
        <table>
            <tr><td>Partie une</td>
            <td></td>
            <td>
            <form>
            <div id='research'><input placeholder='Rechercher' id='input_research' type='text'/><i class='icon-search'></i></div>
                <select>
                <option>Logement</option>
                <option>Vaisselle</option>
                <option>Vêtements</option>
                </select>
                <button type='submit'>Rechercher</button>
            </form>
            </td></tr>
        </table>
        </section>";
    }
?>