<?php
session_start(); // Démarrez la session au début de chaque fichier PHP
    $numeroCarte = $_POST['numeroCarte'];
    $dateExpiration = $_POST['dateExpiration'];

    // Simuler la vérification des conditions de paiement
    if ($numeroCarte[0] == $numeroCarte[15] && $dateExpiration > date('Ym') + 3) {
        // Paiement validé, afficher un message et rediriger vers la page principale
        echo "Payment validé, retour à la page principale dans quelques instants...";
        
        // Videz la variable de session panier
        unset($_SESSION['panier']);
        
        // Redirigez vers la page principale (index.php) après quelques secondes
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    } else {
        echo '<body onLoad="alert(\'Carte invalide réessayer\')">';
        echo '<meta http-equiv="refresh" content="0;URL=Payment.php">';
    }
?>
