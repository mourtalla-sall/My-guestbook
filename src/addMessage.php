<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['id'])) {
    die("Vous devez être connecté pour poster un message.");
}

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['id'];
    $message = $_POST['message'];
    $date = $_POST['date'];


    if (!empty($message) && !empty($id_user) && !empty($date)) {
            $insert_data = $pdo-> prepare('INSERT INTO message (message, date, id_user) VALUES (?, ?, ?) ');
            if ( $insert_data->execute([$message, $date, $id_user])) {
                echo "Message enregistrer avec succés";
            }else{
                echo"erreur lors de l'ajout du message";
            }

       
        }
    }else{
        echo"tous les champs sont requit";
}




?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Message</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <h1>Ajouter un Message</h1>
    <form method="post" action="">
       
        <label for="login">Messages</label><br>
        <textarea name="message" rows="4" ></textarea><br><br>

        <label for="confirm_password">Date</label><br>
        <input type="date" name="date" required><br><br>

        <input type="submit" name="submit" value="Envoyer">
    </form>

</body>

</html>