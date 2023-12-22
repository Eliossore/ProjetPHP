<?php
session_start(); // Démarrez la session au début de chaque fichier PHP
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<?php

$link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

// ... (code existant pour l'affichage de l'en-tête)

echo "<h2>Mon Panier</h2>";
$_SESSION['PrixFinal'] = 0;

if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
    foreach ($_SESSION['panier'] as $titreCD => $quantite) {
        // Récupérez les détails du CD à partir de la base de données en utilisant le titre
        $query = "SELECT * FROM CD WHERE titre = '" . mysqli_real_escape_string($link, $titreCD) . "'";
        $resultats = mysqli_query($link, $query);

        if ($resultats) {
            $cdDetails = mysqli_fetch_assoc($resultats);

            if ($cdDetails) {
                echo "<div class='Carte'>";
                echo "<img src='" . $cdDetails['pochette'] . "' alt='Pochette du CD'>";
                echo "<div class='texte'>";
                echo "<h2>Le Titre : " . $cdDetails['titre'] . "</h2>";
                echo "<p>Auteur : " . $cdDetails['auteur'] . "</p>";
                echo "<p>Prix : " . $cdDetails['prix'] . "</p>";
                echo "<p>Quantité : " . $quantite . "</p>"; // Affichage de la quantité
                echo "</div> </div>";
                $_SESSION['PrixFinal'] = $quantite * $cdDetails['prix'] + $_SESSION['PrixFinal'];
            } else {
                echo "Détails du CD non trouvés pour le titre : " . $titreCD;
            }
        } else {
            echo "Erreur lors de la récupération des détails du CD";
        }
    }
    echo "<form action='Payment.php' method='post'>";
    echo "<p>Prix Final : " . $_SESSION['PrixFinal'] . "</p>";
    echo "<input type='submit' value='Payer'>";
    echo "</form>";
} else {
    echo "Le panier est vide";
}

?>
