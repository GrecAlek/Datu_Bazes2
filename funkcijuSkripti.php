<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funkciju Skripti - Videospēļu sacensības</title>
    <link rel="stylesheet" href="styleSkripti.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="rain.js" defer></script>
</head>

<body>

    <header class="header">
        <a href="mainPage.html" class="back-button">Atpakaļ</a>
    </header>

    <div class="container">
        <div class="flexbox-columns">
            <section class="related-panel">
                <h1 id="saraksts" >Funkciju Skripti</h1>
    <?php

    require_once("config.php");
    $sql = "SHOW TABLES";
$result = $conn->query($sql);

$i = 1;
while ($row = $result->fetch_assoc() && $i <= 3) {
    echo $i . '. &nbsp;<a href="#id' . $i . '">Funkcija</a><br>';
    $i++;
    
}

    ?>
    <h3 id="id1">1.Funkcija(Izvada žurijas pilno vārdu pēc id)</h3>
<pre>DROP FUNCTION IF EXISTS pilnais_vards_zurija;
DELIMITER $$
CREATE FUNCTION pilnais_vards_zurija(id INT)
RETURNS TEXT
DETERMINISTIC
BEGIN
DECLARE pilnais_vards TEXT;
SELECT CONCAT(vards, ' ', uzvards) INTO pilnais_vards
FROM zurija
WHERE id_zurija =id;
RETURN pilnais_vards;
END$$
DELIMITER ;

SELECT pilnais_vards_zurija(1) AS pilnais_vards;</pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id2">2.Funkcija(Izvada dalībnieka epastu pēc id)</h3>
<pre>DROP FUNCTION IF EXISTS dalibnieka_epasts;
DELIMITER $$
CREATE FUNCTION dalibnieka_epasts(id INT)
RETURNS TEXT
BEGIN
DECLARE e_pasts TEXT;
SELECT epasts INTO e_pasts
FROM dalibnieki
WHERE id_dalibnieki = id;
RETURN e_pasts;
END$$
DELIMITER ;

SELECT dalibnieka_epasts(1) AS epasts;</pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id3">3.Funkcija(Izvada vietu pēc rezultātu id)</h3>
<pre>DROP FUNCTION IF EXISTS rezultata_vieta;
DELIMITER $$
CREATE FUNCTION rezultata_vieta(id INT)
RETURNS INT
BEGIN
DECLARE result_vieta INT;
SELECT vieta INTO result_vieta
FROM rezultati
WHERE id_rezultati = id;
RETURN result_vieta;
END$$
DELIMITER ;

SELECT rezultata_vieta(5) AS vieta;</pre>
<p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>
    

            </section>
        </div>
    </div>

    
</body>

</html>
