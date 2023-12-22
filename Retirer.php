<head><meta http-equiv="refresh" content="2;url=index.php"></head>
<?php
session_start(); // Démarrez la session au début de chaque fichier PHP

$cdTitre = urldecode($_GET['titre']);


// Connexion à la base de données
$_SESSION['bdd']= "fsprocq_bd"; // Base de données
$_SESSION['host']= "lakartxela.iutbayonne.univ-pau.fr";
$_SESSION['user']= "fsprocq_bd"; // Utilisateur
$_SESSION['pass']= "fsprocq_bd"; // mp

$links = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");
$sql = "DELETE FROM CD WHERE titre = '$cdTitre'";

if (mysqli_query($links, $sql)) {
    echo "CD Supprimé correctement";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
echo '<meta http-equiv="refresh" content="0;URL=index.php">';
?>