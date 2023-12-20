<?php
session_start();
?>

<HTML>
<HEAD>
    <TITLE>CD</TITLE>
</HEAD>
<BODY>

<?php

$link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

// Récupérer le titre du CD depuis la requête GET
if (isset($_GET['titre'])) {
    $cdTitre = urldecode($_GET['titre']);

    $query = "SELECT * FROM " . $_SESSION['nomtable'] . " WHERE titre = '" . mysqli_real_escape_string($link, $cdTitre) . "'";
    $resultats = mysqli_query($link, $query);

    if ($resultats) {
        $cdDetails = mysqli_fetch_assoc($resultats);

        if ($cdDetails) {
            echo "<h2>Détails du CD:</h2>";
            echo "<p>Titre : " . $cdDetails['titre'] . "</p>";
            echo "<p>Auteur : " . $cdDetails['auteur'] . "</p>";
            echo "<p>Genre : " . $cdDetails['genre'] . "</p>";
            echo "<p>Prix : " . $cdDetails['prix'] . "</p>";
            echo "<img src='" . $cdDetails['pochette'] . "' alt='Pochette du CD'>";

            echo "<form action='ajouterAuPanier.php' method='post'>";
            echo "<input type='hidden' name='titre' value='" . $cdDetails['titre'] . "'>";
            echo "<input type='submit' value='Ajouter au panier'>";
            echo "</form>";
        } else {
            echo "CD non trouvé";
        }
    } else {
        echo "Erreur lors de la récupération des détails du CD";
    }
} else {
    echo "Titre du CD non spécifié";
}

// Fermer la connexion
mysqli_close($link);
?>

</BODY>
</HTML>
