<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procedūru Skripti - Videospēļu sacensības</title>
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
                <h1 id="saraksts" >Procedūru Skripti</h1>
    <?php

    require_once("config.php");
    $sql = "SHOW TABLES";
$result = $conn->query($sql);

$i = 1;
while ($row = $result->fetch_assoc() && $i <= 3) {
    echo $i . '. &nbsp;<a href="#id' . $i . '">Procedūra</a><br>';
    $i++;
    
}

    ?>
    <h3 id="id1">1.Procedūra(Izvada cik ierakstu konkrētajā tabulā)</h3>
<pre>drop procedure if exists tabulas_dati;
DELIMITER $$
CREATE PROCEDURE tabulas_dati(tabula text)
BEGIN
set @vaicajums= concat("select count(*) from " ,tabula);
PREPARE komanda1 FROM @vaicajums;
EXECUTE komanda1;
END
$$ DELIMITER ; 

call tabulas_dati("dalibnieki"); </pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id2">2.Procedūra(Izvada tabulas nosaukumu un datus no tabulas)</h3>
<pre>drop procedure if exists tabulas_dati;
DELIMITER $$
CREATE PROCEDURE tabulas_dati(tabula text)
BEGIN
set @vaicajums= concat("select * from ",tabula);
PREPARE komanda1 FROM @vaicajums;
EXECUTE komanda1;
END
$$ DELIMITER ; 

call tabulas_dati("dalibnieki");</pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id3">3.Procedūra(Izvada datus pēc id)</h3>
<pre>DROP PROCEDURE IF EXISTS tabulas_dati_pec_id;
DELIMITER $$
CREATE PROCEDURE tabulas_dati_pec_id(tabula TEXT, id INT)
BEGIN
SET @vaicajums = CONCAT('SELECT COUNT(*) INTO @skaits FROM ', tabula, ' WHERE id_', tabula, ' = ', id);
PREPARE komanda1 FROM @vaicajums;
EXECUTE komanda1;
IF @skaits = 1 THEN
SET @vaicajums = CONCAT('SELECT * FROM ', tabula, ' WHERE id_', tabula, ' = ', id);
PREPARE komanda2 FROM @vaicajums;
EXECUTE komanda2;
ELSE
SELECT 'tads ieraksts neekssiste!';
END IF;
END$$
DELIMITER ;

call tabulas_dati_pec_id("speles",5);</pre>
<p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>
    

            </section>
        </div>
    </div>

    
</body>

</html>
