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

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* HEADER */
        header {
            background-color: #000;
            padding: 15px 30px;
        }

        header a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        /* CONTENU */
        .container {
            width: 90%;
            margin: auto;
            padding: 30px 0;
        }

        h1, h2 {
            color: #222;
        }

        p {
            color: #555;
            max-width: 800px;
        }

        /* SERVICES */
        .services {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 40px;
        }

        .service {
            background: white;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* HOTELS */
        .hotel {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .hotel h3 {
            margin: 0;
        }

        .note {
            color: #27ae60;
            font-weight: bold;
        }

        .prix {
            font-size: 22px;
            font-weight: bold;
            color: #e67e22;
        }

        /* FOOTER */
        footer {
            background: #000;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<!-- MENU -->
<header>
    <a href="#">Livre d’or</a>
    <a href="#">Inscription</a>
    <a href="#">Connexion</a>
    <a href="#">Mon profil</a>
</header>

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

<footer>
    © 2026 – Hôtel Marseille
</footer>

</body>
</html>