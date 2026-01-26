<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if (!isset($_SESSION['id'])) {
    // header('Location: login.php');
    // exit;
}

$sql = $pdo->prepare("
    SELECT 
        u.login AS nom_user,
        m.message AS nom_message,
        m.date
    FROM message m
    JOIN user u ON m.id_user = u.id
    ORDER BY m.date DESC
");
$sql->execute();
$articles = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Avis</title>
    <link rel="stylesheet" href="messageRead.css">
</head>
<body>

<?php include('./navigation.php'); ?>

<section>
    <?php if (empty($articles)): ?>
        <p>Aucun message pour le moment.</p>
    <?php endif; ?>

    <?php foreach ($articles as $value): ?>
        <article>
            <h4>
                <span class="user-info">
                    Posté par <?= htmlspecialchars($value['nom_user']) ?>
                </span>
                <span class="date-info">
                    <?= htmlspecialchars($value['date']) ?>
                </span>
            </h4>

            <p><?= nl2br(htmlspecialchars($value['nom_message'])) ?></p>
        </article>
    <?php endforeach; ?>
</section>
<?php include('./pagination.php'); ?>

<a class="addMessage" href="addMessage.php">Ajouter un message</a>

</body>
</html>
