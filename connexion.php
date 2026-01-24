<?php
if(!isset($_SESSION)){
    
    session_start();
}require_once 'db.php';


if (isset($_POST['submit'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['passworld'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $message = "<span style='color:green'>Connexion réussie !</span>";
        } else {
            $message = "Login ou mot de passe incorrect.";
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
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 <?php
    include('navbar.php')
    ?>
<header class="inscription-header">
    <h1>Connexion</h1>
</header>

<main>
    <form method="post" >

        

        <label>Login</label>
        <input type="text" name="login" required>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <input type="submit" name="submit" value="Se connecter">
    <p class="account">
    Pas de compte ?
    <a href="inscription.php">S'inscrire</a>
    </p>


    </form>
</main>


  


</body>
</html>
