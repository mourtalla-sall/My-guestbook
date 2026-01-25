<?php

session_start();
require_once 'db.php';
$index = '../index.php';


if (isset($_POST['submit'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($login) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {

            $check = $pdo->prepare("SELECT id FROM user WHERE login = ?");
            $check->execute([$login]);

            if ($check->rowCount() === 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare(
                    "INSERT INTO user (login, passworld) VALUES (?, ?)"
                );

                if ($insert->execute([$login, $hashed_password])) {
                    $message = "<span style='color:green'>Inscription réussie !</span>";
                } else {
                    $message = "Erreur lors de l'inscription.";
                }
            } else {
                $message = "Ce login est déjà utilisé.";
            }
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
 <?php
    include('./navigation.php')
    ?>
<header>
    <h1>Inscription</h1>
</header>

<main>
    <form method="post">


        <label>Login</label>
        <input type="text" name="login" required>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <label>Confirmer le mot de passe</label>
        <input type="password" name="confirm_password" required>

        <input type="submit" name="submit" value="S'inscrire">
        <p class="account">
        Déjà un compte ?
    <a href="connexion.php">Se connecter</a>
</p>



    </form>
    

</main>


</body>
</html>
