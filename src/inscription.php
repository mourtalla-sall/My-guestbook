<?php
session_start();
require_once 'db.php';  // Vérifie si le fichier existe

if (isset($_POST['submit'])) {
    $login = trim(htmlspecialchars($_POST['login'])); // éviter le piratage et les injections
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($login) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            $check = $pdo->prepare('SELECT id FROM user WHERE login = ?'); // On  prépare les données
            $check->execute([$login]);

            if ($check->rowCount() == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // On hash le mot de passe

                $insert = $pdo->prepare('INSERT INTO user (login, passworld) VALUES (?, ?)');
                
                if ($insert->execute([$login, $hashed_password])) {
                    echo "Inscription réussie ! <a href='connexion.php'>Connectez-vous ici</a>";
                } else {
                    echo "Erreur lors de l'inscription.";
                }
            } else {
                echo "Ce login est déjà pris.";
            }
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="post" action="">
        <label for="login">Login :</label><br>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label for="confirm_password">Confirmer le mot de passe :</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <input type="submit" name="submit" value="S'inscrire">
    </form>
    <p>Déjà un compte ? <a href="connexion.php">Se connecter</a></p> 
    <!-- Redirection -->
</body>
</html>