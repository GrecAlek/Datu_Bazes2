<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabulu Struktūra - Videospēļu sacensības</title>
    <link rel="stylesheet" href="styleTabuluStruktura.css">
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
                <h1>Tabulu Struktūra</h1>
    <?php

    require_once("config.php");
    $sql="show tables";
    $result=$conn->query($sql);

    if(empty($_POST["submit"])) {
        echo "<div>Izvēlieties Tabulu: </div>";
    echo '<form method="post">';
    echo '<select name="tabulas"required>';

    echo '<option value=""hidden></option>';

    while ($row=$result->fetch_assoc()) {
    echo '<option value="'.$row["Tables_in_videospelu_sacensibas"].'">"'.$row["Tables_in_videospelu_sacensibas"].'"</option>';
    }
    echo '</select>';
    echo '&nbsp;&nbsp;<input type="submit" name="submit" value="Izvēlēties">';
    echo '</form>';

}
else{
    $tabula=$_POST["tabulas"];
    //echo "<br>Tabula= ".$tabula;
    $sql="show create table ".$tabula;
    //echo "<br>sql= ".$sql;
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    echo '<pre>'.$row["Create Table"].'</pre>';

}  


    ?>
               
            </section>
        </div>
    </div>

    
</body>

</html>
