<?php

session_start();
require_once 'db.php';
$id_user = $_SESSION['id'];


$sql = $pdo->prepare("SELECT user.login as nom_user, message.message as nom_message, date
    FROM message
    JOIN user
    ON message.id_user = user.id");
$sql->execute();
$articles = $sql->fetchAll(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Avis</title>
    <link rel="stylesheet" href="messageRead.css">
</head>
<body>

<section>
    <?php foreach ($articles as $key => $value): ?>

        <article>
            <h4>
                <span class="user-info">
                    Posté <?= htmlspecialchars($value['nom_user']) ?>
                </span>
                <span class="date-info">
                    <?= htmlspecialchars($value['date']) ?>
                </span>
            </h4>

            <p><?= nl2br(htmlspecialchars($value['nom_message'])) ?></p>
        </article>

    <?php endforeach; ?>
</section>




  
   
<?php  include('./pagination.php');  
?>
<button class="addMessage"><a href="addMessage.php">addMessage</a></button>

</body>
</html>


 