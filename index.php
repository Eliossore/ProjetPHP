<?php
    session_start ();
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>vente de CD</title>
        <link rel="stylesheet" href="style.css">
    </head>
<BODY>
<?php
    $nombd = "projet";
    $utilisateur = "root";
    $mdp = "root";
    $host = "localhost";
    $table = "CD";
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
        echo "<h1>Utilisateur: ".$_SESSION['login']."</h1>";
    }
    else{
        echo "<form action='identification.php' method='post'>";
        echo "<input type='submit' value='Connexion'>";
        echo "</form>";
    }
    echo "<a href='monPanier.php'>Panier</a>";

    // Connexion à la bdd
    $_SESSION['bdd']= "fsprocq_bd"; // Base de données
    $_SESSION['host']= "lakartxela.iutbayonne.univ-pau.fr";
    $_SESSION['user']= "fsprocq_bd"; // Utilisateur
    $_SESSION['pass']= "fsprocq_bd"; // mp
    $_SESSION['nomtable']= "CD"; /* Connection bdd */

    $link=mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['bdd']) or die( "Impossible de se connecter à la base de données");

    // Afficher le contenu de la bdd
    $query = "SELECT * FROM ".$_SESSION['nomtable'];

    $resultats = mysqli_query($link, $query);
    mysqli_close($link);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
       }

    while ($donnees = mysqli_fetch_assoc($resultats))
    {
        echo "<div class='Carte'>";
        $pathImg = $donnees['pochette'];
        echo "<img src='$pathImg' alt='Pochette du CD'>";
        echo "<div class='texte'>";
        echo "<h2>Le Titre : ".$donnees['titre']."</h2>";
        echo "<p>Auteur : ".$donnees['auteur']."</p>";
        echo "<a href='PageCd.php?titre=".urlencode($donnees['titre'])."'>Voir les détails</a>"; 
        echo "</div>";
        echo "</div>";
    }
?>


</BODY>
</HTML>