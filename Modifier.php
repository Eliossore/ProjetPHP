<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : 0;



    $link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    // Mettre à jour les données du CD dans la base de données
    $sql = "UPDATE CD SET auteur='$auteur', genre='$genre', prix=$prix WHERE titre='$titre'";

    if (mysqli_query($link, $sql)) {
        echo "CD modifié correctement";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($link);
    }

    mysqli_close($link);
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}

?>