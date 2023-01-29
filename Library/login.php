<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_array();
    
    if ($user['utype']=="user") {
        // echo "user";
        
        if (password_verify($_POST["password"], $user["passwordhash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    } elseif ($user["utype"]=="admin") {
        // echo "admin";

        if (password_verify($_POST["password"], $user["passwordhash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: adminpanel.php");
            exit;
        }
    } else {
        echo "Nieprawidłowy email lub hasło";
    }
    
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Biblioteka</title>
</head>
<body>
    <h1>Logowanie</h1>
    <form method="post">
        <label for="login">E-Mail</label>
        <input type="email" name="email" id="email" required
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password" required>
        
        <button class="button">Zaloguj się</button>
    
        <br><br><br>
        <div>
            <h3>Nie masz jeszcze konta?</h3><br>
            <h4><a href="signup.html">Zarejestruj się</a></h4>
        </div>
    </form>
</body>
</html>