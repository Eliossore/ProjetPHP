<?php
    session_start ();
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>vente de CD</title>
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

    print "Tentative de connexion sur sitebd<br>";

    $link=mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['bdd']) or die( "Impossible de se connecter à la base de données");

    // Afficher le contenu de la bdd
    $query = "SELECT * FROM ".$_SESSION['nomtable'];

    $resultats = mysqli_query($link, $query);
       
    echo "Résultats de la requête : <br>";
    while ($donnees = mysqli_fetch_assoc($resultats))
    {
        echo "<div>";
        $pathImg = $donnees['pochette'];
        echo "<h2>Le Titre : ".$donnees['titre']."</h2>";
        echo "<p>Auteur : ".$donnees['auteur']."</p>";
        echo "<img src='$pathImg' alt='Pochette du CD'>";
        echo "<a href='PageCd.php?titre=".urlencode($donnees['titre'])."'>Voir les détails</a>"; 
        echo "</div>";
    }
?>


</BODY>
</HTML>