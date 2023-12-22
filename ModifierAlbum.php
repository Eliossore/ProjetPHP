<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un CD</title>
</head>
<body>

<h2>Ajouter un CD</h2>
<h3>Remplir les champs a modifier</h3>
<form action="Modifier.php" method="post" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required><br>

    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" required><br>

    <label for="genre">Genre :</label>
    <input type="text" name="genre" required><br>

    <label for="prix">Prix :</label>
    <input type="number" name="prix" step="1" required><br>

    <input type="submit" value="Modifier CD">
</form>

</body>
</html>