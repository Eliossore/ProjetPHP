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
        echo "<h1>Utilisateur: ".$_SESSION['login']."<h/1>";
    }
    else{
        echo "<form action='identification.php' method='post'>";
        echo "<input type='submit' value='Connexion'>";
        echo "</form>";
    }
    echo "<a href='monPanier.php'>Panier</a>";
    // Connexion à la bdd
    $bdd= "projet"; // Base de données
    $host= "localhost";
    $user= "kek"; // Utilisateur
    $pass= "kek"; // mp
    $nomtable= "CD"; /* Connection bdd */

    print "Tentative de connexion sur sitebd<br>";

    $link=mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données");

    // Afficher le contenu de la bdd
    $query = "SELECT * FROM $nomtable";

    $resultats = mysqli_query($link, $query);
    mysqli_close($link);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
       }
    else 
    {
        echo "Connexion réussi <br>";
    }
       
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