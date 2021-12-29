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
{
    require_once("db.php"); //ota db.php tiedosto käyttöön tässä tiedostossa
    $conn = createDbConnection(); //Kutsutaan db.php tiedostossa olevaa CreateDbConnection()-functiota, joka avaa tietokantayhteyden
    //Muodosta SQL-lause
    $sql = "SELECT DISTINCT genre FROM `title_genres`;";

    //Tarkistukset yms
    //Aja kysely kantaan


    $prepare = $conn->prepare($sql);
    $prepare->execute();
    //Tallennetaan vastaus muuttujaan
    $rows = $prepare->fetchAll();
    //Tulosta otsikko
    $html = "<select name='genre'>";
    //Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $rows) {
        //Tulosta jokaiselle riville li-elementti
        $html .="<option>" . $rows["genre"] . "</option>";
    }
    $html .= "</select>";
    return $html;
    //Avataan tietokantayhteys
    //Muodostetaan sql-lause
    //Ajetaan sql lause kantaan
    //Avataan select-elementti
    //Loopataan läpi vastauksena saadut rivit
    //Luodaan jokaiselle riville option-elementti
    //Suljetaan select-elementti
    //Palautetaan luoto html kutsujalle
}
/* 
    //Otetaan yhteys tietokantaan
    require_once("db.php");
    $conn = createDbConnection();
    //Muodostetaan SQL-lause
    $sql = "SELECT DISTINCT genre FROM `title_genres`;";
    //Ajetaan SQL lause kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    //Tallennetaan vastaus muuttujaan
    $rows = $prepare->fetchAll();
    //Avataan select elementti
    $html = '<select name="genre">';
    //Loopataan läpi vastaukset
    foreach ($rows as $row) {
        //Luodaan jokaiselle riville option-element

        $html .= "<option>" . $row["genre"] . "</option>";
    }
    //Suljetaan select elementti
    $html .= "</select>";
    //Palautetaan luotu html kutsujalle
    return $html;
}


 */