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
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
        echo "<h1>Utilisateur: ".$_SESSION['login']."<h/1>";
    }
    else{
        echo "<form action='identification.php' method='post'>";
        echo "<input type='submit' value='Connexion'>";
        echo "</form>";
    }
    echo "<a href='monPanier.php'>Panier</a>";
    $db = new PDO(
        'mysql:host=lakartxela;dbname=fsprocq_bd;charset=utf8',
        'fsprocq_bd',
        'fsprocq_bd'
    );
    $recipesStatement = $db->prepare('SELECT * FROM CD');
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();
    foreach ($recipes as $ligne)
    {
        echo "<div>";
        $pathImg = $ligne['pochette'];
        echo "<h2>Le Titre : ".$ligne['titre']."</h2>";
        echo "<p>Auteur : ".$ligne['auteur']."</p>";
        echo "<img src='$pathImg' alt='Pochette du CD'>";
        echo "<a href='PageCd.php?titre=".urlencode($ligne['titre'])."'>Voir les détails</a>"; 
        echo "</div>";
    }
?>


</BODY>
</HTML>