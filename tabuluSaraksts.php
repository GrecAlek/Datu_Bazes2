<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabuluSaraksts - Videospēļu sacensības</title>
    <link rel="stylesheet" href="styleTabuluSaraksts.css">
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
                <h1>Tabulu Saraksts</h1>
    <?php

    require_once("config.php");
   
    /*

    $sql="select 2+2";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    //print_r($row);
    echo "<br>Summa =" .$row["2+2"];
    */

    
    //1. izveido vaicajumu
    $sql="show tables";
    //2. vaicajuma izpilde
    $result=$conn->query($sql);
    
    //3. rezultata izvade
    //print_r($row);
    //echo "<br>Tabula: ".$row["Tables_in_videospelu_sacensibas"];

    
    $i=1;
    while ($row=$result->fetch_assoc()) {

        echo $i.". ".$row["Tables_in_videospelu_sacensibas"]."<br>";
        $i++;
}
    
    ?>
               
            </section>
        </div>
    </div>

    
</body>

</html>
