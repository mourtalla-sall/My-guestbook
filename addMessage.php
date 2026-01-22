<?php
session_start();
require_once 'db.php';

$erreur = "";
$success = "";

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['id'] ?? null;
    $message = $_POST['message'] ?? '';
    $date = $_POST['date'] ?? '';

    if (!empty($message) && !empty($id_user) && !empty($date)) {
        $insert_data = $pdo->prepare(
            'INSERT INTO message (message, date, id_user) VALUES (?, ?, ?)'
        );

        if ($insert_data->execute([$message, $date, $id_user])) {
            $success = "Message enregistré avec succès";
        } else {
            $erreur = "Erreur lors de l'ajout du message";
        }
    } else {
        $erreur = "Tous les champs sont requis";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Message</title>
   <link rel="stylesheet" href="styles.css">

</head>
<body>
      <?php
    include('navbar.php')
    ?>
    <header>
    <h1>Ajouter un Message</h1>

    <?php if (!empty($erreur)) : ?>
        <p class="error"><?= $erreur ?></p>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>
</header>

    <main>
        <form method="post" action="">
       
        <label for="login">Messages</label><br>
        <textarea name="message" rows="4" ></textarea><br><br>

        <label for="confirm_password">Date</label><br>
        <input type="date" name="date" required><br><br>

        <input type="submit" name="submit" value="Envoyer">
         <button><a href="index.php">Annuler</a></button>
    </form>

    </main>
</body>
</html>