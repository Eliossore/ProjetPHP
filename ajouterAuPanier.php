<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])) {
    $titreCD = $_POST['titre'];

    // Ajoutez le titre au panier (une variable de session)
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Vérifiez si le CD est déjà dans le panier
    if (array_key_exists($titreCD, $_SESSION['panier'])) {
        $_SESSION['panier'][$titreCD]++; // Augmentez la quantité si le CD est déjà présent
    } else {
        $_SESSION['panier'][$titreCD] = 1; // Ajoutez le CD au panier avec une quantité initiale de 1
    }

    // Redirigez l'utilisateur vers la page de détails du CD
    header("Location: index.php");
    exit();
} else {
    echo "Mauvaise requête";
}
?>