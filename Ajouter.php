<?php
session_start(); // Démarrage de la session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupére les données du formulaire

    $repertoire = "image/";
    $nomvar = $_FILES['pochette'];
    $repertoire = $repertoire . basename($_FILES[$nomvar]['name']);
    move_uploaded_file($_FILES[$nomvar]['tmp_name'], $repertoire);

    echo "$repertoire <br><br>";

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : 0;
    $pochette = isset($repertoire) ? $repertoire : '';

    // Connexion à la base de données
    $_SESSION['bdd'] = "projet"; // Base de données
    $_SESSION['host'] = "127.0.0.0"; // Serveur
    $_SESSION['user'] = "kek"; // Utilisateur
    $_SESSION['pass'] = "kek"; // Mot de passe

    $_SESSION['link'] = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    $sql = "INSERT INTO CD (titre, auteur, genre, prix, pochette) VALUES ('$titre', '$auteur', '$genre', $prix, '$pochette')";

    if (mysqli_query($_SESSION['link'], $sql)) {
        echo "Nouveau CD insérer correctement";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

}
?>