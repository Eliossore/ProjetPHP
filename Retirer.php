<head><meta http-equiv="refresh" content="2;url=index.php"></head>
<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

$cdTitre = urldecode($_GET['titre']);


// Connexion à la base de données
$_SESSION['bdd'] = "projet"; // Base de données
$_SESSION['host'] = "127.0.0.0"; // Serveur
$_SESSION['user'] = "kek"; // Utilisateur
$_SESSION['pass'] = "kek"; // Mot de passe

$_SESSION['link'] = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

$sql = "DELETE FROM CD WHERE titre = '$cdTitre'";

if (mysqli_query($_SESSION['link'], $sql)) {
    echo "CD Supprimé correctement";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header ('location: Index.php');
exit();
?>