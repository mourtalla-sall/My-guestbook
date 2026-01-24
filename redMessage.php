<?php
if(!isset($_SESSION)){
    
    session_start();
}
require_once 'db.php';

if (!isset($_SESSION['id'])) {
    // Redirection si non connecté (optionnel)
    // header('Location: login.php');
    // exit;
}

$id_user = $_SESSION['id'];

$sql = $pdo->prepare("
    SELECT user.login AS nom_user, message.message AS nom_message, message.date
    FROM message
    JOIN user ON message.id_user = user.id
");
$sql->execute();
$data = $sql->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Avis</title>
</head>
<body>
     
     <?php
foreach ($data as $key => $value) {
    $nomUser = $value['nom_user'];
    $message = $value['nom_message']; 
    $date = $value['date'];
    
    echo "<article>";
    echo "<h4>Posté par $nomUser le $date </h4>";
    echo "<p>$message</p>";
    echo "</article>";
}


?>

    <button><a href="addMessage.php">addMessage</a></button>
</body>
</html>