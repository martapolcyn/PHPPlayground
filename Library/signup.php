<?php

if (empty($_POST["firstname"])) {
    die("Imię to pole obowiązkowe");
}

if (empty($_POST["lastname"])) {
    die("Nazwisko to pole obowiązkowe");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Nieprawidłowy email");
}

if (strlen($_POST["password"]) < 8) {
    die("Hasło musi mieć co najmniej 8 znaków");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Hasło musi mieć co najmniej jedną literę");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Hasło musi mieć co najmniej jedną cyfrę");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Hasła muszą się zgadzać");
}

$passwordhash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (firstname, lastname, email, passwordhash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}


$stmt->bind_param("ssss",
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["email"],
                    $passwordhash);
                    
if ($stmt->execute()) {

    header("Location: signup-yay.html");
    exit;

} else {
    if ($mysqli->errno === 1062) {
        die("Ten email jest już zarejestrowany");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
