<?php
session_start();
require_once 'db.php';


$sql = $pdo->prepare("
    SELECT user.login as nom_user, 
    message.message as nom_message, 
    DATE_FORMAT(message.date, '%d.%m.%Y') as date_fr
    FROM message
    JOIN user ON message.id_user = user.id
    ORDER BY message.date DESC
");

$sql->execute();
$data = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>guestbook</title>
</head>

<body>
    <h1>Les messages</h1>
    <p><a href="message.php">Ajouter un message</a> <a href="profil.php">Mon profil</a></p>

    <?php
    foreach ($data as $value) {
        // Sécurité : htmlspecialchars empêche l'exécution de scripts malveillants (faille XSS)
        $nomUser = htmlspecialchars($value['nom_user']);
        $message = nl2br(htmlspecialchars($value['nom_message']));
        $date = $value['date_fr'];
        echo "<h2>Posté par $nomUser le $date </h2>";
        echo "<p>$message</p>";
        echo "</article>";
    }
    ?>
</body>

</html>