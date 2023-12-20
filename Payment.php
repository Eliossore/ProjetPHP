<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <form action="verifPayment.php" method="post">
        <label for="numeroCarte">Numéro de carte (16 chiffres) :</label>
        <input type="text" name="numeroCarte" required pattern="\d{16}">
        <br>
        <label for="dateExpiration">Date d'expiration (format : YYYYMM) :</label>
        <input type="text" name="dateExpiration" required pattern="\d{6}">
        <br>
        <input type="submit" name="valider" value="Valider">
    </form>
</body>
</html>