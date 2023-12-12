<?php
    session_start ();
?>
<HTML>
<HEAD><TITLE>CD</TITLE></HEAD>
<BODY>

<?php

$db = new PDO(
    'mysql:host=lakartxela;dbname=fsprocq_bd;charset=utf8',
    'fsprocq_bd',
    'fsprocq_bd'
);

if (isset($_GET['titre'])) {
    $cdTitre = urldecode($_GET['titre']);

    $cdStatement = $db->prepare('SELECT * FROM CD WHERE titre = :titre');
    $cdStatement->bindParam(':titre', $cdTitre);
    $cdStatement->execute();
    $cdDetails = $cdStatement->fetch();

    if ($cdDetails) {
        echo "<h2>Détails du CD:</h2>";
        echo "<p>Titre : ".$cdDetails['titre']."</p>";
        echo "<p>Auteur : ".$cdDetails['auteur']."</p>";
        echo "<p>Genre : ".$cdDetails['genre']."</p>";
        echo "<p>Prix : ".$cdDetails['prix']."</p>";
        echo "<img src='".$cdDetails['pochette']."' alt='Pochette du CD'>"; 

        echo "<form action='ajouterAuPanier.php' method='post'>";
        echo "<input type='hidden' name='titre' value='".$cdDetails['titre']."'>";
        echo "<input type='submit' value='Ajouter au panier'>";
        echo "</form>";
    } else {
        echo "CD non trouvé";
    }
} else {
    echo "Titre du CD non spécifié";
}
?>

</BODY>
</HTML>