<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire

    $repertoire = "image/";
    $nomvar = $_POST['pochette'];
    $repertoire = $repertoire . basename($_FILES[$nomvar]['name']);
    move_uploaded_file($_FILES[$nomvar]['tmp_name'], $repertoire);

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    $pochette = isset($repertoire);

    // Valider les données (vous pouvez ajouter des validations plus poussées selon vos besoins)

    // Connexion à la base de données
    $_SESSION['bdd'] = "fsprocq_bd"; // Base de données
    $_SESSION['host'] = "lakartxela.iutbayonne.univ-pau.fr";
    $_SESSION['user'] = "fsprocq_bd"; // Utilisateur
    $_SESSION['pass'] = "fsprocq_bd"; // Mot de passe

    $_SESSION['link'] = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    // Préparer la requête d'insertion
    $query = "INSERT INTO CD (titre, auteur, genre, prix, pochette) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($_SESSION['link'], $query);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Binder les paramètres
        mysqli_stmt_bind_param($stmt, "sssd", $titre, $auteur, $genre, $prix, $pochette);

        // Exécuter la requête
        $result = mysqli_stmt_execute($stmt);

        // Vérifier si l'insertion a réussi
        if ($result) {
            echo "Le CD a été ajouté avec succès à la base de données.";
        } else {
            echo "Erreur lors de l'ajout du CD : " . mysqli_error($_SESSION['link']);
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($_SESSION['link']);
    }

    // Fermer la connexion
    mysqli_close($_SESSION['link']);
}
?>