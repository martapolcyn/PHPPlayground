<?php

if (empty($_POST["firstname"])) {
    die("Imię to pole obowiązkowe");
}

if (empty($_POST["lastname"])) {
    die("Nazwisko to pole obowiązkowe");
}

if (empty($_POST["username"])) {
    die("Login to pole obowiązkowe");
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

if ( !preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $_POST['zip_code']) ) {
    print 'Wprowadzono błędny kod pocztowy';
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Hasła muszą się zgadzać");
}

$pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (firstname, lastname, education, interests, street, houseno, flatno, zipcode, city, country, username, email, pwd)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

if ($_POST["interests"] != NULL) {
    $interests_array=implode(', ', $_POST["interests"]);
} else {
    $interests_array=NULL;
}


$stmt->bind_param("sssssssssssss",
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["education"],
                    $interests_array,
                    $_POST["street"],
                    $_POST["house_no"],
                    $_POST["flat_no"],
                    $_POST["zip_code"],
                    $_POST["city"],
                    $_POST["country"],
                    $_POST["username"],
                    $_POST["email"],
                    $pwd);
                    
if ($stmt->execute()) {

    header("Location: signup-yay.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Ten Login jest już zajęty");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
