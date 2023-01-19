<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                   $mysqli->real_escape_string($_POST["username"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["pwd"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
            <em>Nieprawidłowy login lub hasło</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="login">Login</label>
        <input type="text" name="username" id="username"
               value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
        
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password">
        
        <button>Zaloguj się</button>
    </form>
    
</body>
</html>







