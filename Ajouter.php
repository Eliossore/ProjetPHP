<?php
session_start(); // Démarrage de la session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupére les données du formulaire

    $repertoire = "image/";
    $nomvar = $_FILES['pochette'];
    $repertoire = $repertoire . basename($nomvar['name']);
    move_uploaded_file($nomvar['tmp_name'], $repertoire);

    echo "$repertoire <br><br>";

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : 0;
    $pochette = isset($repertoire) ? $repertoire : '';

    $link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    $sql = "INSERT INTO CD (titre, auteur, genre, prix, pochette) VALUES ('$titre', '$auteur', '$genre', $prix, '$pochette')";

    if (mysqli_query($link, $sql)) {
        echo "Nouveau CD insérer correctement";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($link);
    }

    mysqli_close($link);
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}
?>