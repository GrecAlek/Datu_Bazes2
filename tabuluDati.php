<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabuluDati - Videospēļu sacensības</title>
    <link rel="stylesheet" href="styleTabuluDati.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="rain.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var backButton = document.querySelector('.back-button');
            backButton.addEventListener('click', function(event) {
                event.preventDefault(); 
if (window.location.pathname.includes('mainPage.html')) {
                    window.location.href = 'mainPage.html';
                } else {
                    history.back();
                }
            });
        });
    </script>
</head>

<body>

    <header class="header">
        <a href="mainPage.html" class="back-button">Atpakaļ</a>
    </header>

    <div class="container">
        <div class="flexbox-columns">
            <section class="related-panel">
                <h1>Dati, Pievienošana, Dzēšana</h1>
    <?php

    require_once("config.php");
   
    // Pievienošana
    if (!empty($_POST["pievienot"])) {
        $tabula = $_POST["tabula"];
        $kolonnuSkaits = $_POST["kolonnuSkaits"];
        $sql = 'INSERT INTO ' . $tabula . ' VALUES (NULL';

        for ($i = 2; $i <= $kolonnuSkaits; $i++) {
            $sql .= ',"' . $_POST["lauks$i"] . '"';
        }
        $sql .= ')';
        $result = $conn->query($sql);

       // echo "<br>SQL: " . $sql;
      //  echo '<br>Tabula: ' . $tabula;
        echo '<br>Dati pievienoti tabulā ' . $tabula;
    }

    // Dzēšana
    if (!empty($_POST["dzest"])) {
        $tabula = $_POST["tabula"];
        $idlauks = $_POST["idlauks"];
        $rnumurs = $_POST["rindasNumurs"];
        $sql = "DELETE FROM " . $tabula . ' WHERE ' . $idlauks . '=' . $rnumurs;

        $conn->query($sql);
        echo "<br>Dati dzēsti no tabulas " . $tabula;
    }

    // Tabulu parādīšana
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if (empty($_POST["submit"])) { // Nav izvēlēta tabula
        echo "<div>Izvēlieties Tabulu: </div>";
        echo '<form method="post">';
        echo '<select name="tabula" required>';
        echo '<option value="" hidden></option>';

        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["Tables_in_videospelu_sacensibas"] . '">' . $row["Tables_in_videospelu_sacensibas"] . '</option>';
        }
        echo '</select>';
        echo '&nbsp;&nbsp;<input type="submit" name="submit" value="Izvēlēties">';
        echo '</form>';

    } else {
        $tabula = $_POST["tabula"];
        echo '<h2>Tabula: ' . $tabula . '</h2>';

        $sql = "SELECT * FROM " . $tabula;
        $result = $conn->query($sql);

        // 1. rinda lauku nosaukumi
        $nosaukumi = $result->fetch_fields();
        echo '<table class="table table-bordered">';
        echo '<tr>';
        foreach ($nosaukumi as $lauks) { // virsraksti
            echo '<th>' . $lauks->name . '</th>';
        }
        echo '<th></th>';
        echo '</tr>';

        // Pārējās rindas dati
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';

            // Cikls veido kolonnas
            foreach ($row as $vertiba) {
                echo '<td>' .$vertiba. '</td>';
            }
            $lauksid = $nosaukumi[0]->name; // tabulas 1. lauka nosaukums
            echo '<td>
                <form method="post">
                <input type="hidden" name="rindasNumurs" value="' . $row[$lauksid] . '">
                <input type="hidden" name="tabula" value="' . $tabula . '">
                <input type="hidden" name="idlauks" value="' . $lauksid . '">
                <input type="submit" name="dzest" value="Dzēst">
                </form>
            </td>';
            echo '</tr>';
        }

        echo '<tr><td></td>'; // Rinda datu ievadei
        echo '<form method="post">';
        for ($i = 2; $i <= $result->field_count; $i++) {
            echo '<td><input type="text" name="lauks' . $i . '"></td>';
        }

        echo '<td>
            <input type="hidden" name="kolonnuSkaits" value="' . $result->field_count . '">
            <input type="hidden" name="tabula" value="' . $tabula . '">
            <input type="submit" name="pievienot" value="Pievienot">
        </td>';
        echo '</form>';
        echo '</tr>';
        echo '</table>';
    }
    ?>

            </section>
        </div>
    </div>

</body>

</html>
