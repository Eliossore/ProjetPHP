<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

// Connexion à la base de données
$db = new PDO(
    'mysql:host=lakartxela;dbname=fsprocq_bd;charset=utf8',
    'fsprocq_bd',
    'fsprocq_bd'
);

// ... (code existant pour l'affichage de l'en-tête)

echo "<h2>Mon Panier</h2>";
$_SESSION['PrixFinal'] = 0;
if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
    foreach ($_SESSION['panier'] as $titreCD => $quantite) {
        // Récupérez les détails du CD à partir de la base de données en utilisant le titre
        $cdStatement = $db->prepare('SELECT * FROM CD WHERE titre = :titre');
        $cdStatement->bindParam(':titre', $titreCD);
        $cdStatement->execute();
        $cdDetails = $cdStatement->fetch();

        if ($cdDetails) {
            echo "<div>";
            echo "<h2>Le Titre : ".$cdDetails['titre']."</h2>";
            echo "<p>Auteur : ".$cdDetails['auteur']."</p>";
            echo "<p>Prix : ".$cdDetails['prix']."</p>";
            echo "<img src='".$cdDetails['pochette']."' alt='Pochette du CD'>";
            echo "<p>Quantité : ".$quantite."</p>"; // Affichage de la quantité
            echo "</div>";
            $_SESSION['PrixFinal'] = $quantite * $cdDetails['prix'] + $_SESSION['PrixFinal'];
        } else {
            echo "Détails du CD non trouvés pour le titre : ".$titreCD;
        }
    }
    echo "<form action='Payment.php' method='post'>";
    echo "<p>Prix Final : ".$_SESSION['PrixFinal']."</p>";
    echo "<input type='submit' value='Payer'>";
    echo "</form>";
} else {
    echo "Le panier est vide";
}

?>
