<?php
// Démarrage de la session avant tout
if (!isset($_SESSION)) {
    session_start();
}

// Inclusion des fichiers nécessaires
require_once './navigation.php'; // correction du nom du fichier
require_once 'db.php';

// Initialisation du message
$message = "";

// Traitement du formulaire de connexion
if (isset($_POST['submit'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {
        // Vérification du login dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM user WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['passworld'])) {
            // Connexion réussie
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $message = "<span style='color:green'>Connexion réussie !</span>";
        } else {
            // Login ou mot de passe incorrect
            $message = "<span style='color:red'>Login ou mot de passe incorrect.</span>";
        }
    } else {
        $message = "<span style='color:red'>Veuillez remplir tous les champs.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <h1>Connexion</h1>


<main>
    <?php
    // Affichage du message si présent
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>

    <form method="post">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" name="submit" value="Se connecter">

        <p class="account">
            Pas de compte ? <a href="inscription.php">S'inscrire</a>
        </p>
    </form>
</main>

</body>
</html>
