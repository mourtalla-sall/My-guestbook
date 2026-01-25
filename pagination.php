<?php

require_once 'db.php';

/* ===== CONFIG ===== */
$messagesParPage = 3;

/* ===== PAGE ACTUELLE ===== */
$pageActuelle = isset($_GET['page']) && $_GET['page'] > 0
    ? (int) $_GET['page']
    : 1;

/* ===== TOTAL MESSAGES ===== */
$totalMessages = $pdo->query("SELECT COUNT(*) FROM message")->fetchColumn();

/* ===== TOTAL PAGES ===== */
$totalPages = ceil($totalMessages / $messagesParPage);

if ($pageActuelle < 1) $pageActuelle = 1;
if ($pageActuelle > $totalPages) $pageActuelle = $totalPages;

/* ===== OFFSET ===== */
$offset = ($pageActuelle - 1) * $messagesParPage;

/* ===== REQUÊTE PAGINÉE AVEC JOIN ===== */
$sql = $pdo->prepare("
    SELECT 
        user.login AS nom_user,
        message.message AS nom_message,
        message.date
    FROM message
    JOIN user ON message.id_user = user.id
    ORDER BY message.date DESC
    LIMIT :limit OFFSET :offset
");

$sql->bindValue(':limit', $messagesParPage, PDO::PARAM_INT);
$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
$sql->execute();

/* ✅ VARIABLE UNIQUE */
$messages = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

 <?php

require_once 'db.php';

/* ===== CONFIG ===== */
$messagesParPage = 3;

/* ===== PAGE ACTUELLE ===== */
$pageActuelle = isset($_GET['page']) && $_GET['page'] > 0
    ? (int) $_GET['page']
    : 1;

/* ===== TOTAL MESSAGES ===== */
$totalMessages = $pdo->query("SELECT COUNT(*) FROM message")->fetchColumn();

/* ===== TOTAL PAGES ===== */
$totalPages = ceil($totalMessages / $messagesParPage);

if ($pageActuelle < 1) $pageActuelle = 1;
if ($pageActuelle > $totalPages) $pageActuelle = $totalPages;

/* ===== OFFSET ===== */
$offset = ($pageActuelle - 1) * $messagesParPage;

/* ===== REQUÊTE PAGINÉE AVEC JOIN ===== */
$sql = $pdo->prepare("
    SELECT 
        user.login AS nom_user,
        message.message AS nom_message,
        message.date
    FROM message
    JOIN user ON message.id_user = user.id
    ORDER BY message.date DESC
    LIMIT :limit OFFSET :offset
");

$sql->bindValue(':limit', $messagesParPage, PDO::PARAM_INT);
$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
$sql->execute();

/* ✅ RÉCUPÉRATION DES MESSAGES */
$messages = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Pagination.css">
</head>
<body>
    <nav class="pagination">
        <?php if ($pageActuelle > 1): ?>
            <a href="?page=<?= $pageActuelle - 1 ?>" class="btn-nav">← Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $pageActuelle): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pageActuelle < $totalPages): ?>
            <a href="?page=<?= $pageActuelle + 1 ?>" class="btn-nav">Suivant →</a>
        <?php endif; ?>
    </nav>

</body>
</html>
