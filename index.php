<?php 
require_once("functions.php");
    //Hakukriteerit
    $html = "<h2>Kriteerit</h2>";
    $html .="<form action='GET'>";

        //Title_typepudotusvalikko
    $html .='Valitse, minkä kategorian 10 pisintä otsikkoa haluat nähdä <p>' . createTitle_typeDropDown();
            //Alue-Pudotusvalikko
            $html .='<p>Valitse, minkä genren  top äänestetyt otsikot haluat nähdä </p>' .createGenreDropDown() . '<p>';


    //Looppaa läpi tiedstot datasets-hakemistosta
    $path = "datasets";
    if($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            $html .= '<div><input type="submit" value="' 
            . basename($file, ".php") .
             '" formaction="' . $path . "/" 
             . $file . '"> </div>';
        }
        closedir($handle);
    }
    $html .="</form>";

    //Luo painike, joka lähettää lomakkeen käsiteltävänä olevalle tieodstolle. 

    echo $html;