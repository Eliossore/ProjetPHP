<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])) {
    $titreCD = $_POST['titre'];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Vérifiez si le CD est déjà dans le panier
    if (array_key_exists($titreCD, $_SESSION['panier'])) {
        $_SESSION['panier'][$titreCD]++; // Augmente la quantité si le CD est déjà présent
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