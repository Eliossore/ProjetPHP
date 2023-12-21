<?php
    session_start();
    $link = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['bdd']) or die("Impossible de se connecter à la base de données");

    $query = "SELECT Mdp FROM Utilisateur WHERE Nom = '" . $_POST['login'] . "'";
    $resultats = mysqli_query($link, $query);

    if ($resultats) {
        $utilisateurDetails = mysqli_fetch_assoc($resultats);
        $login_valide = $_POST['login'];
        $pwd_valide = $utilisateurDetails['Mdp'];
        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            // on redirige notre visiteur vers une page de notre section membre
            header ('location: index.php');
        }
        else {
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            echo '<meta http-equiv="refresh" content="0;URL=identification.php">';
        }
        
    } else {
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        echo '<meta http-equiv="refresh" content="0;URL=identification.php">';
    }

?>