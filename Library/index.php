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
    <title>Home</title>
</head>
<body>
<h1>Biblioteka</h1>
    
    <?php if (isset($user)): ?>
        
        <p>Witaj <?= htmlspecialchars($user["firstname"]) ?></p>
        <p>Twoje dane: </p>

        <p>Numer karty: <?= htmlspecialchars($user["id"]) ?></p>
        <p>Imię: <?= htmlspecialchars($user["firstname"]) ?></p>
        <p>Nazwisko: <?= htmlspecialchars($user["lastname"]) ?></p>
        <p>Email: <?= htmlspecialchars($user["email"]) ?></p>
        
        <p><a href="logout.php">Wyloguj</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Zaloguj się</a> lub <a href="signup.html">Załóż konto</a></p>
        
    <?php endif; ?>
</body>
</html>


