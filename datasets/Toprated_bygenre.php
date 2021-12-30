<?php
    // Muodosta tietokantayhteys
    require_once("../db.php"); //ota db.php tiedosto käyttöön tässä tiedostossa

    //Lue genre get-parametri muuttujaan
    $genre = $_GET["genre"];
    //Kutsutaan db.php tiedostossa olevaa CreateDbConnection()-functiota, joka avaa tietokantayhteyden
    $conn = createDbConnection(); 

    //Muodostetaan SQL-lause, jossa haetaan genren mukaan yli 50 000 
    // ääntä saanutta ohjelmaa ja joiden keskiarvo on yli 8.
    $sql = "SELECT primary_title, genre, title_type, num_votes,average_rating
    FROM `titles` 
    INNER JOIN title_genres
    ON titles.title_id = title_genres.title_id
    INNER JOIN title_ratings ON title_genres.title_id = title_ratings.title_id
    WHERE genre LIKE '%" . $genre . "%'
    AND num_votes > 50000
    AND average_rating > 8
    GROUP BY `primary_title`
    ORDER BY `average_rating` DESC
    LIMIT 10;";


    //Tarkistukset yms
    $prepare = $conn->prepare($sql);
    //Aja kysely kantaan
    $prepare->execute();
    //Tallennetaan vastaus muuttujaan
    $rows = $prepare->fetchAll();
    //Tulosta otsikko
    $html = "<h1>" . $genre ."</h1>";
    //avaa ul elementti
    $html .= "<ul>";
    //Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $rows) {
        //Tulosta jokaiselle riville li-elementti
        $html .="<li>" . $rows["primary_title"] ." <br><b>Votes:</b> " . $rows["num_votes"] . "<br><b>Score:</b> " . $rows["average_rating"] . "<p>" .  "</li>";
    }
    //Suljetaan ul elementti
    $html .= "</ul>";
    //Tulostetaan 
    echo $html;
