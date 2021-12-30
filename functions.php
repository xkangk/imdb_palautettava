<?php
//Functio joka luo Title_type-pudostusvalikon

function createTitle_typeDropDown()
{
    //Otetaan yhteys tietokantaan
    require_once("db.php");
    $conn = createDbConnection();
    //Muodostetaan SQL-lause
    $sql = "SELECT DISTINCT title_type FROM titles;";
    //Ajetaan SQL lause kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    //Tallennetaan vastaus muuttujaan
    $rows = $prepare->fetchAll();
    //Avataan select elementti
    $html = '<select name="title_type">';
    //Loopataan läpi vastaukset
    foreach ($rows as $row) {
        //Luodaan jokaiselle riville option-element

        $html .= "<option>" . $row["title_type"] . "</option>";
    }
    //Suljetaan select elementti
    $html .= "</select>";
    //Palautetaan luotu html kutsujalle
    return $html;
}

//Functio joka luo Genre pudotusvalikon
function createGenreDropDown()
{ //ota db.php tiedosto käyttöön tässä tiedostossa
    require_once("db.php");
    //Kutsutaan db.php tiedostossa olevaa CreateDbConnection()-functiota, joka avaa tietokantayhteyden
    $conn = createDbConnection();
    //Muodosta SQL-lause
    $sql = "SELECT DISTINCT genre FROM `title_genres`;";



    //Tarkistukset yms

    $prepare = $conn->prepare($sql);
    //Aja kysely kantaan
    $prepare->execute();
    //Tallennetaan vastaus muuttujaan
    $rows = $prepare->fetchAll();
    //Tulosta otsikko
    $html = "<select name='genre'>";
    //Looppaa tietokannasta saadut rivit läpi
    foreach ($rows as $rows) {
        //Tulosta jokaiselle riville li-elementti
        $html .= "<option>" . $rows["genre"] . "</option>";
    }
    //Suljetaan select-elementti
    $html .= "</select>";
    //Palautetaan luoto html kutsujalle
    return $html;
}
