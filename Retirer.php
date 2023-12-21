<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le titre du CD à supprimer
    $titreCD = isset($_POST['titreCD']) ? $_POST['titreCD'] : '';

    // Valider les données (vous pouvez ajouter des validations plus poussées selon vos besoins)

    $link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    // Préparer la requête de suppression
    $query = "DELETE FROM CD WHERE titre = ?";
    $stmt = mysqli_prepare($link, $query);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Binder les paramètres
        mysqli_stmt_bind_param($stmt, "s", $titreCD);

        // Exécuter la requête
        $result = mysqli_stmt_execute($stmt);

        // Vérifier si la suppression a réussi
        if ($result) {
            echo "Le CD a été supprimé avec succès de la base de données.";
        } else {
            echo "Erreur lors de la suppression du CD : " . mysqli_error($link);
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($link);
    }

    // Fermer la connexion
    mysqli_close($link);
}
?>