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
<h1>Home</h1>
    
    <?php if (isset($user)): ?>
        
        <p>Witaj <?= htmlspecialchars($user["firstname"]) ?></p>
        <p>Oto Twoje dane podane przy rejestracji: </p>

        <p>Login: <?= htmlspecialchars($user["username"]) ?></p>
        <p>Imię: <?= htmlspecialchars($user["firstname"]) ?></p>
        <p>Nazwisko: <?= htmlspecialchars($user["lastname"]) ?></p>
        <p>
            Adres: <?= htmlspecialchars($user["street"]) ?>
            <?= htmlspecialchars($user["houseno"]) ?> / <?= htmlspecialchars($user["flatno"]) ?>
        </p>
        <p>
            <?= htmlspecialchars($user["zipcode"]) ?> <?= htmlspecialchars($user["city"]) ?><!--, <?= htmlspecialchars($user["country"]) ?>-->
        </p>
        <p>Wykształcenie: <?= htmlspecialchars($user["education"]) ?></p>
        <p>Zainteresowania: <?= htmlspecialchars($user["interests"]) ?></p>
        
        <p><a href="logout.php">Wyloguj</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Zaloguj się</a> lub <a href="signup.html">Załóż konto</a></p>
        
    <?php endif; ?>
</body>
</html>


