<?php
session_start();
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

$stmt = $pdo->prepare('SELECT login FROM user WHERE id = ?');
$stmt->execute([$id_user]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <p><a href="connexion">connexion</a></p>

    <?php if(!empty($message_status)) echo "<p><strong>$message_status</strong></p>"; ?>

    <hr>

    <div>
        <p><strong>Nom d'utilisateur</strong></p>
        
        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'login'): ?>
            <form method="post" action="profil.php">
                <input type="text" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required>
                <input type="submit" name="update_login" value="Enregistrer">
                <a href="profil.php">Annuler</a>
            </form>
        <?php else: ?>
            <span><?php echo htmlspecialchars($user['login']); ?></span>
            <a href="profil.php?edit=login"><button>Modifier</button></a>
        <?php endif; ?>
    </div>

    <hr>

    <div>
        <p><strong>Mot de passe</strong></p>

        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'password'): ?>
            <form method="post" action="profil.php">
                <input type="password" name="password" placeholder="Nouveau mot de passe" required>
                <input type="submit" name="update_password" value="Enregistrer">
                <a href="profil.php">Annuler</a>
            </form>
        <?php else: ?>
            <span>********</span>
            <a href="profil.php?edit=password"><button>Modifier</button></a>
        <?php endif; ?>
    </div>

    <hr>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>