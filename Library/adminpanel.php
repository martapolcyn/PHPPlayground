<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_array();
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
<h1>Panel administratora</h1>
    
    <?php if (isset($user) AND $user['utype']=="admin"): ?>
        
        <p style="color:green"> Jesteś adminem!</p>
        <p><a href="logout.php">Wyloguj</a></p>
        
    <?php else: ?>
        
        <p style="color:red">Nie masz autoryzacji do tej strony</p>
        <p><a href="login.php">Zaloguj się</a> lub <a href="signup.html">Załóż konto</a></p>
        
    <?php endif; ?>
</body>
</html>


