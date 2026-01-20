<?php
session_start();
require_once 'db.php'; // On vérifie si le fichier existe

if (isset($_POST['submit'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {
        
        $stmt = $pdo->prepare('SELECT * FROM user WHERE login = ?'); // Récupération de l'utilisateur
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mdp
        if ($user && password_verify($password, $user['passworld'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            
            echo "Connexion réussie ! Bonjour " . $_SESSION['login'];
            echo "<br><a href='#'>Accéder au Livre d'Or</a>";
        } else {
            echo "Login ou mot de passe incorrect.";
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
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="post" action="">
        <label for="login">Login :</label><br>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" name="submit" value="Se connecter">
    </form>
    <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
</body>
</html>