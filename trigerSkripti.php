<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigeru Skripti - Videospēļu sacensības</title>
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
                <h1 id="saraksts" >Trigeru Skripti</h1>
    <?php

    require_once("config.php");
    $sql = "SHOW TABLES";
$result = $conn->query($sql);

$i = 1;
while ($row = $result->fetch_assoc() && $i <= 3) {
    echo $i . '. &nbsp;<a href="#id' . $i . '">Trigeris</a><br>';
    $i++;
    
}

    ?>
    <h3 id="id1">1.Trigeris(Pārbaudīt vai sākums ir pirms beigam)</h3>
<pre>DROP TRIGGER IF EXISTS datumaParbaude;
DELIMITER $$
CREATE TRIGGER datumaParbaude BEFORE INSERT ON sacensibas
FOR EACH ROW
BEGIN
if new.sakums>=new.beigas then set new.sakums="";end if;
END
$$ DELIMITER ;
insert into sacensibas values(null,1,7,8,'2024-01-13 12:00:00','2024-01-13 11:00:00','HALO');

select * from sacensibas where id_sacensibas=last_insert_id();</pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id2">2.Trigeris(Pievienno automātiski +371 Tālruņa Numuram)</h3>
<pre>DROP TRIGGER IF EXISTS talrunaNr;
DELIMITER $$
CREATE TRIGGER talrunaNr before INSERT ON zurija
FOR EACH ROW
BEGIN
if(length(new.talrunaNr))=0 then set new.talrunaNR="Kļūda!";
elseif(length(new.talrunaNr))=8 then set
new.talrunaNr=concat("+371 ",new.talrunaNr);
elseif (length(new.talrunaNr)< 8) then set new.talrunaNr="Numura nav!";
end if;
END 
$$ DELIMITER ;

insert into zurija values(null,"Sandris7","Kalmārs7","sndzels7@venta.lv","23234455");

select * from zurija where id_zurija=last_insert_id();</pre>
    <p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>

    <h3 id="id3">3.Trigeris(Pievieno uzslavu rezultātim pēc vietas, ja nav ievadīts)</h3>
<pre>DROP TRIGGER IF EXISTS uzslava;
DELIMITER $$
CREATE TRIGGER uzslava BEFORE INSERT ON rezultati
FOR EACH ROW
BEGIN
if new.uzslavas is null then
CASE new.vieta
WHEN 1 THEN SET new.uzslavas='Čempions!';
WHEN 2 THEN SET new.uzslavas='Malacis!';
WHEN 3 THEN SET new.uzslavas='Labi!';
ELSE SET NEW.uzslavas = 'Galvenais ir piedalīties!';
END CASE;
END IF;
END
$$ DELIMITER ;

insert into rezultati values(null,2,17,null,null,8);
insert into rezultati values(null,3,19,1,null,4);
insert into rezultati values(null,4,12,2,null,2);
insert into rezultati values(null,2,7,3,null,1);

select * from rezultati where id_rezultati=last_insert_id();</pre>
<p><a href="#saraksts"> Atpakaļ uz Sarakstu</a></p>
    

            </section>
        </div>
    </div>

    
</body>

</html>
