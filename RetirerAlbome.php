<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un CD</title>
</head>
<body>

<h2>Supprimer un CD</h2>
<form action="Retirer.php" method="post">
    <label for="titreCD">Titre du CD à supprimer :</label>
    <input type="text" name="titreCD" required><br>

    <input type="submit" value="Supprimer CD">
</form>

</body>
</html>