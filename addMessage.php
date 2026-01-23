<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();

}

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['id'];
    $message = htmlspecialchars($_POST['message']);

    if (!empty($message)) {
        $insert_data = $pdo->prepare('INSERT INTO message (message, date, id_user) VALUES (?, NOW(), ?) ');
        
        if ($insert_data->execute([$message, $id_user])) {
            echo "Message enregistré avec succès !";
        } else {
            echo "Erreur lors de l'ajout du message.";
        }
    } else {
        echo "Le message ne peut pas être vide.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Message</title>
</head>

<body>
    <h1>Ajouter un Message</h1>
    <form method="post" action="">

        <label for="login">Messages</label><br>
        <textarea name="message" rows="4"></textarea><br><br>


        <input type="submit" name="submit" value="Envoyer">
    </form>

</body>

</html>