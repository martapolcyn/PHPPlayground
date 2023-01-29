<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_array();
}


// tutaj

if (isset($_POST["add"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];

    $query = "INSERT INTO books (title, author)
              VALUES ('$title', '$author')";

    if ($mysqli->query($query)) {
        echo "Dodano!";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

if (isset($_POST["remove"])) {
    $id = $_POST["id"];

    $query = "DELETE FROM books WHERE id = $id";

    if ($mysqli->query($query)) {
        echo "Usunięto!";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$query = "SELECT * FROM books";
$result = $mysqli->query($query);

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
<h1>Panel administratora</h1>
    
    <?php if (isset($user) AND $user['utype']=="admin"): ?>
        
        <h2>Lista dostępnych książek</h2>
        <!-- <p style="color:green"> Jesteś adminem!</p> -->
        <br><br>
        <table>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
        </tr>

        <?php while ($book = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $book["id"]; ?></td>
                <td><?php echo $book["title"]; ?></td>
                <td><?php echo $book["author"]; ?></td>
            </tr>
        <?php endwhile; ?>
        </table>
        <br><br>

        <h3>Dodaj nową pozycję</h3>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Tytuł">
            <input type="text" name="author" placeholder="Autor">
            <input type="submit" name="add" value="Dodaj">
        </form>

        <h3>Usuń pozycję</h3>
        <form action="" method="post">
            <input type="number" name="id" placeholder="ID">
            <input type="submit" name="remove" value="Usuń">
        </form>


        
    <?php else: ?>
        <br>
        <h2 style="color:red">Nie masz autoryzacji do tej strony</h2>
        <br><br>
        <h4><a href="login.php">Zaloguj się jako administrator</a></h4>
        
    <?php endif; ?>

    <br>
    <h4><a href="logout.php">Wyloguj</a></h4>
</body>
</html>


