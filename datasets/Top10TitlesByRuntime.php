<?php

require_once("../db.php"); //Otetaan db.php käyttöön tässä tiedostossa. 
//Lue genre get-parametri muutttujaan
$type = $_GET["title_type"];
$conn = createDbConnection(); //Lähetetään kutsu db.php-tiedostossa olevalle createDbConnection- functiolle, 
//joka avaa yhteyden tietokantaan

//Muodostetaan SQL-lause muuttujaan

$sql = "SELECT primary_title, runtime_minutes,genre, title_type 
FROM `titles` INNER JOIN title_genres
ON titles.title_id = title_genres.title_id
WHERE title_type LIKE '%" . $type . "%'
GROUP BY `primary_title`
ORDER BY `runtime_minutes` DESC
LIMIT 10;";

//Tarkistukset yms
$prepare = $conn->prepare($sql);
//Aja kysely kantaan
$prepare->execute();
//Tallennetaan vastaus muuttujaan
$rows = $prepare->fetchAll();
//Tulosta
$html = "<h1>" . $type . "</h1>";
//Avataan ul elementti
$html .= "<ul>";
//Loopataan rivit
foreach ($rows as $row) {
    //Tulostetaan otsikko ja kesto minuutteina, 
    $html .= "<li>" . $row["primary_title"] . "<br>Kesto minuutteina: " .  $row["runtime_minutes"] . "<p>" . "</li>";
}
//suljetaan ul elementti
$html .= "</ul>";
//Tulostetaan vastaus 
echo $html;
