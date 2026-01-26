<?php
$hotels = [
    [
        "nom" => "Retraite Royale",
        "note" => "4,9 (150+)",
        "lieu" => "Canebière Bourse",
        "prix" => "50 €",
        "etoiles" => 4,
        "image" => "chambre.jpeg"
    ],
    [
        "nom" => "Retraite Royale",
        "note" => "4,9 (150+)",
        "lieu" => "Canebière Bourse",
        "prix" => "90 €",
        "etoiles" => 4,
        "image" => "chambre1.jpeg"
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtels à Marseille</title>
    <link rel="stylesheet" href="./hotel.css">
</head>
<body>
    <div class="container">
        <div class="hero">
            <img src="photos.jpeg" alt="Hôtel">
        </div>
        
        <p class="description">
            Tous nos hôtels profitent d'un emplacement idéal à Marseille,
            vous permettant de vivre pleinement l'atmosphère unique de la
            cité phocéenne. Réservez facilement en quelques clics.
        </p>
        
        <h2 class="services-title">Nos services</h2>
        <div class="services">
            <div class="service">
                <img src="restau.jpeg" alt="Restaurant">
                <div>Restaurant</div>
            </div>
            <div class="service">
                <img src="sport.jpeg" alt="Salle de sport">
                <div>Salle de sport</div>
            </div>
            <div class="service">
                <img src="conference.jpeg" alt="Conférence">
                <div>Salle de conférence</div>
            </div>
            <div class="service">
                <img src="hamam.jpeg" alt="Hammam">
                <div>Hammam</div>
            </div>
        </div>
        
        <div class="hotels-container">
            <?php foreach($hotels as $hotel): ?>
            <div class="hotel">
                <img src="<?= $hotel['image'] ?>" alt="<?= $hotel['nom'] ?>">
                <div class="hotel-info">
                    <div class="hotel-header">
                        <h3><?= $hotel['nom'] ?></h3>
                        <span class="note"><?= $hotel['note'] ?></span>
                    </div>
                    <div class="stars">
                        <?php for($i = 0; $i < $hotel['etoiles']; $i++): ?>
                            ⭐
                        <?php endfor; ?>
                    </div>
                    <div class="hotel-footer">
                        <div class="lieu">📍 <?= $hotel['lieu'] ?></div>
                        <div class="price"><?= $hotel['prix'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
        
        <!-- GALERIE DE PHOTOS -->
        <div class="gallery">
            <div class="gallery-item">
                <img src="recpt.jpeg" alt="Réception">
            </div>
            <div class="gallery-item">
                <img src="lobby.jpeg" alt="Lobby">
            </div>
            <div class="gallery-item">
                <img src="bar.jpeg" alt="Bar">
            </div>
            <div class="gallery-item">
                <img src="terrase.jpeg" alt="Terrasse">
            </div>
        </div>
    </div>
</body>
</html>