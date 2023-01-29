<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
</head>
<body>
<h1>Biblioteka</h1>
    
    <?php if (isset($user)): ?>
        <br>
        <h3>Witaj <?= htmlspecialchars($user["firstname"]) ?></h3>
        <p>Twoje dane: </p>
        <br>
        <table>
        <tr>
            <th>Numer karty</th>
            <td><?= htmlspecialchars($user["id"]) ?></td>
        </tr>
        <tr>
            <th>Imię</th>
            <td><?= htmlspecialchars($user["firstname"]) ?></td>
        </tr>
        <tr>
            <th>Nazwisko</th>
            <td><?= htmlspecialchars($user["lastname"]) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($user["email"]) ?></td>
        </tr>
        </table>
        <br>
        <h4><a href="logout.php">Wyloguj</a></h4>
        
    <?php else: ?>
        
        <p><a href="login.php">Zaloguj się</a> lub <a href="signup.html">Załóż konto</a></p>
        
    <?php endif; ?>
</body>
</html>


