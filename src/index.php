<?php

session_start();
require_once 'db.php';
 $id_user = $_SESSION['id'];


$sql = $pdo->prepare("SELECT user.login as nom_user, message.message as nom_message, date
    FROM message
    JOIN user
    ON message.id_user = user.id");
$sql->execute();
$data = $sql->fetchAll(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
foreach ($data as $key => $value) {
    $nomUser = $value['nom_user'];
    $message = $value['nom_message']; 
    $date = $value['date'];
    
    echo "<article>";
    echo "<h2>Posté par $nomUser le $date </h2>";
    echo "<p>$message</p>";
    echo "</article>";
}
?>
</body>
</html>