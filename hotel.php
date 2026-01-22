<?php
$hotels = [
    [
        "nom" => "Retraite Royale",
        "note" => "4,9 (150+)",
        "lieu" => "Canebière Bourse",
        "prix" => "50 €"
    ],
    [
        "nom" => "Retraite Royale",
        "note" => "4,9 (150+)",
        "lieu" => "Canebière Bourse",
        "prix" => "90 €"
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtels à Marseille</title>
    <link rel="stylesheet" href="./src/hotel.css">
   
</head>

<body>


<!-- CONTENU -->
<div class="container">


    <p>
        Tous nos hôtels profitent d’un emplacement idéal à Marseille,
        vous permettant de vivre pleinement l’atmosphère unique de la cité phocéenne.
        Grâce à notre site web clair et intuitif, votre réservation se fait en toute simplicité
        et en quelques clics.
    </p>

    <h2>Nos services</h2>

    <div class="services">
        <div class="service">Restaurant</div>
        <div class="service">Salle de sport</div>
        <div class="service">Salle de conférence</div>
        <div class="service">Hammam</div>
    </div>

    <h2>Nos hôtels</h2>

    <?php foreach ($hotels as $hotel): ?>
        <div class="hotel">
            <div>
                <h3><?= $hotel["nom"]; ?></h3>
                <p class="note"><?= $hotel["note"]; ?></p>
                <p><?= $hotel["lieu"]; ?></p>
            </div>

            <div class="prix">
                <?= $hotel["prix"]; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>



</body>
</html>