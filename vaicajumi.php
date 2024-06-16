<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaicājumi - Videospēļu sacensības</title>
    <link rel="stylesheet" href="styleVaicajumi.css">
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

                <h1>Vaicājumi</h1>

                <ol id="saraksts">
                    <li><a href="#id1">Vaicājums</a></li>
                    <li><a href="#id2">Vaicājums</a></li>
                    <li><a href="#id3">Vaicājums</a></li>
                    <li><a href="#id4">Vaicājums</a></li>
                    <li><a href="#id5">Vaicājums</a></li>
                    <li><a href="#id6">Vaicājums</a></li>
                    <li><a href="#id7">Vaicājums</a></li>
                    <li><a href="#id8">Vaicājums</a></li>
                    <li><a href="#id9">Vaicājums</a></li>
                    <li><a href="#id10">Vaicājums</a></li>
                </ol>

    
                <h3 id="id1">1. Vaicājums (Izvada dalībniekus, kuri nav pilngadīgi)</h3>
                <pre>

select vards, uzvards, dzimsanasGads
from dalibnieki
where year(current_date()) - dzimsanasGads < 18;
                </pre>

                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>



                <h3 id="id2">2. Vaicājums (Izvada dalībniekus ar vienādiem vārdiem)</h3>
                <pre>

select vards, uzvards
from dalibnieki
where vards in (
select vards
from dalibnieki
group by vards
having count(*) > 1);
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu
                    
                </a></p>

                <h3 id="id3">3. Vaicājums (Izvada datus no sacensību tabulas par vadītājiem un žūrijas epastiem, kas satur @inbox.lv) </h3>
                <pre>

select vards, uzvards, epasts 
from zurija
join sacensibas on zurija.id_zurija = sacensibas.id_zurija
where epasts like '%@inbox.lv%'
union
select vards, uzvards, epasts 
from vaditajs
join sacensibas on vaditajs.id_vaditajs = sacensibas.id_vaditajs
where epasts like '%@inbox.lv%';
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id4">4. Vaicājums (Izvada dalībniekus, kas ieguvuši divas vietas, bet nevienu uzslavu)</h3>
                <pre>

select d.id_dalibnieki, d.vards, d.uzvards, count(r.id_rezultati) as vietuSkaits,
group_concat(r.vieta order by r.vieta) as visasVietas
from dalibnieki d
join rezultati r on d.id_dalibnieki = r.id_dalibnieki
group by d.id_dalibnieki, d.vards, d.uzvards
having vietuSkaits >= 2 and count(r.uzslavas) = 0;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id5">5. Vaicājums (Izvada visus dalībniekus, kuri saņēmuši vietu divas vai vairāk reizes)</h3>
                <pre>

select d.vards, d.uzvards, r.id_dalibnieki, group_concat(r.vieta) as visasVietas
from dalibnieki d
join rezultati r on d.id_dalibnieki = r.id_dalibnieki
where r.vieta != 0
group by r.id_dalibnieki
having count(distinct r.vieta) >= 2;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id6">6. Vaicājums (Izvada uzvarētāju pēc kopējā punktu skaita)</h3>
                <pre>

select d.id_dalibnieki, d.vards,d.uzvards,sum(r.punkti) as punkti
from rezultati r
join dalibnieki d on r.id_dalibnieki =d.id_dalibnieki
group by d.id_dalibnieki, d.vards, d.uzvards
order by punkti desc
limit 1;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id7">7. Vaicājums (Izvada pirmās vietas ieguvējus,kas dzimuši 2005. gadā)</h3>
                <pre>

select dalibnieki.vards, dalibnieki.uzvards, dalibnieki.dzimsanasGads
from rezultati
join dalibnieki on rezultati.id_dalibnieki=dalibnieki.id_dalibnieki
join sacensibas on rezultati.id_sacensibas =sacensibas.id_sacensibas
where rezultati.vieta=1 and dalibnieki.dzimsanasGads=2005;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id8">8. Vaicājums (Izvada dalibnieku kam ir uzslava un vissmazāk punktu)</h3>
                <pre>

select dalibnieki.id_dalibnieki, dalibnieki.vards,
dalibnieki.uzvards, rezultati.punkti, rezultati.uzslavas
from rezultati
join dalibnieki on rezultati.id_dalibnieki = dalibnieki.id_dalibnieki
where rezultati.uzslavas !=''
order by rezultati.punkti asc
limit 1;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id9">9. Vaicājums (Izvada dalibniekus, kuri nav guvuši uzslavu un ir jaunāki par 23 gadiem)</h3>
                <pre>

select id_dalibnieki, vards, uzvards, dzimsanasGads
from dalibnieki
where dzimsanasgads>year(current_date())-23 and id_dalibnieki 
not in(select id_dalibnieki from rezultati where uzslavas !='');
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <h3 id="id10">10. Vaicājums (Izvada visus dalībniekus, kas ieguvuši vietu spēlē NBA 2k23)</h3>
                <pre>

select d.vards, d.uzvards, r.vieta, sp.nosaukums as spelesNosaukums
from dalibnieki d
join rezultati r on d.id_dalibnieki = r.id_dalibnieki
join sacensibas s on r.id_sacensibas = s.id_sacensibas
join speles sp on s.id_speles = sp.id_speles
where sp.nosaukums ='NBA 2k23'
order by sp.nosaukums, r.vieta;
                </pre>
                <p><a class="saraksts" href="#saraksts">Uz vaicājumu sarakstu</a></p>

                <hr class="custom-hr">

                <form method="post">
    <textarea name="vaicajums" rows="10" cols="80"></textarea>
    <br><br>
    <input type="submit" name="submit" value="Vaicājuma rezultāts">
    <br><br>
</form>



                <?php
                require_once("config.php");

                if(!empty($_POST["submit"])){

                $sql =$_POST["vaicajums"];
                echo "Vaicājums:<br><b><pre>".$sql."</pre></b><br><br>";
                $result = $conn->query($sql);

        // 1. rinda lauku nosaukumi
        $nosaukumi = $result->fetch_fields();
        echo '<table class="table table-bordered">';
        echo '<tr>';
        foreach ($nosaukumi as $lauks) { // virsraksti
            echo '<th>'.$lauks->name.'</th>';
        }
        
        echo '</tr>';

        // Pārējās rindas dati
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';

            // Cikls veido kolonnas
            foreach ($row as $vertiba) {
                echo '<td>' .$vertiba. '</td>';
            }
            echo '</tr>';
        }//while iekaava
        echo'</table>';
    }// if iekava
    ?>

            </section>
        </div>
    </div>

</body>

</html>
