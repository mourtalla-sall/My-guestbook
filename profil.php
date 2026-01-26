<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'db.php';

// Vérification connexion
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}

$id_user = $_SESSION['id'];
$message_status = "";

// Nouveau login
if (isset($_POST['update_login'])) {
    $new_login = htmlspecialchars($_POST['login']);
    
    if (!empty($new_login)) {
        $stmt = $pdo->prepare('UPDATE user SET login = ? WHERE id = ?');
        if ($stmt->execute([$new_login, $id_user])) {
            $_SESSION['login'] = $new_login;
            $message_status = "Login mis à jour !";
        }
    }
}

// Nouveau mot de passe
if (isset($_POST['update_password'])) {
    $new_password = $_POST['password'];
    
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('UPDATE user SET password = ? WHERE id = ?');
        if ($stmt->execute([$hashed_password, $id_user])) {
            $message_status = "Mot de passe mis à jour !";
        }
    }
}

// Récupérer le login de l'utilisateur
$stmt = $pdo->prepare('SELECT login FROM user WHERE id = ?');
$stmt->execute([$id_user]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    $user['login'] = ""; // Eviter les erreurs si user non trouvé
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
     <?php
    include('./navigation.php')
    ?>
    <h1>Paramètres du compte</h1>

  
    <?php if(!empty($message_status)) echo "<p class='success'>$message_status</p>"; ?>


       <main>
        <form class="form-profil">
             <p><strong>Nom d'utilisateur</strong></p>

        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'login'): ?>
                <input type="text" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required>
                <input type="submit" name="update_login" value="Enregistrer">
                <a href="profil.php">Annuler</a>
        <?php else: ?>
            <span><?php echo htmlspecialchars($user['login']); ?></span>
            </button><a href="profil.php?edit=login">Modifier</a></button>
        <?php endif; ?>
             <p><strong>Mot de passe</strong></p>

        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'password'): ?>
                <input type="password" name="password" placeholder="Nouveau mot de passe" required>
                <input type="submit" name="update_password" value="Enregistrer">
                <a href="profil.php">Annuler</a>
        <?php else: ?>
            <span>********</span>
            <button><a href="profil.php?edit=password">Modifier</a></button>
        <?php endif; ?>

    <hr>

    <p><a class="btn-lien" href="deconnexion.php">Se déconnecter</a></p>
        </form>
       </main>
</body>
</html>
