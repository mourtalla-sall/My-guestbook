<?php
if(!isset($_SESSION)){
    
    session_start();
}require_once 'db.php';


if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();

}

$erreur = "";
$success = "";

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
   <link rel="stylesheet" href="styles.css">

</head>
<body>
     <?php
    include('./navigation.php')
    ?>
<header class="inscription-header">
    <h1>Ajouter un Message</h1>
</header>



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


        <input type="submit" name="submit" value="Envoyer">
        <button class="addMessage"><a href="index.php">Annuler</a></button>
    </form>

    </main>
</body>
</html>