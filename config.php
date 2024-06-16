<?php
echo "<meta charset='utf-8'>";
$dblocation = 'localhost';
$dbuser = 'root';
$dbpasswd = "";
$dbname = "videospelu_sacensibas";

$conn = new mysqli($dblocation, $dbuser, $dbpasswd, $dbname);

if ($conn->connect_error) {
    echo "Nevar savienoties ar DB: " . $conn->connect_error;
 } //else {
   // echo "Savienojums ar DB ir izveidots!";

   //1. mājas lapa, 2. db , 3. datu plūsma no db_servera uz m.l.

    // echo "<br/>Kodējums : ". $conn->character_set_name();
    //$conn->set_charset("utf8");

    $vaicajums="use videospelu_sacensibas";
    $resultats=$conn->query($vaicajums);



    

?>