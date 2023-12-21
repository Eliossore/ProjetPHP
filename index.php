<?php
    session_start ();
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>vente de CD</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
<BODY>
    <a href='monPanier.php' class='bouton-panier'><span class='icone-panier'>🛒</span>Panier</a>
<?php
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
        echo "<h1>Utilisateur: ".$_SESSION['login']."</h1>";
    }
    else{
        echo "<form action='identification.php' method='post'>";
        echo "<input type='submit' value='Connexion'>";
        echo "</form>";
    }

    // Connexion à la bdd
    $_SESSION['bdd']= "projet"; // Base de données
    $_SESSION['host']= "127.0.0.0";
    $_SESSION['user']= "kek"; // Utilisateur
    $_SESSION['pass']= "kek"; // mp
    $_SESSION['nomtable']= "CD";

    $link=mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['bdd']) or die( "Impossible de se connecter à la base de données");
    $query = "SELECT * FROM Utilisateur WHERE Nom = '".$_SESSION['login']."'";
    $resultats = mysqli_query($link, $query);
    mysqli_close($link);
    if (mysqli_connect_errno()) {
        echo "Impossible de se connecter à MySQL" . mysqli_connect_error();
        exit();
     }
    $AcceAdmin = mysqli_fetch_assoc($resultats);

    $link=mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['bdd']) or die( "Impossible de se connecter à la base de données");

    // Afficher le contenu de la bdd
    $query = "SELECT * FROM ".$_SESSION['nomtable'];
    $resultats = mysqli_query($link, $query);
    mysqli_close($link);
    if (mysqli_connect_errno()) {
        echo "Impossible de se connecter à MySQL" . mysqli_connect_error();
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
        echo "<a href='PageCd.php?titre=".urlencode($donnees['titre'])."'>Voir les détails</a>"; // Page des détails du CD
        echo "</div>";
        if($AcceAdmin['Admin'] == true){    
            echo "<a href='Retirer.php?titre=".urlencode($donnees['titre'])."' class='bouton-moins'></a>"; // Bouton Supprimer
        }
        echo "</div>";
    }

    if($AcceAdmin['Admin'] == true){
        echo "<form action='AjouterAlbum.php' method='post'>";
        echo "<input type='submit' value='Ajouter un album'>";
        echo "</form>";
    }
?>


</BODY>
</HTML>