<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    $sql_books = "SELECT * FROM books";
    $result_books = $mysqli->query($sql_books);

    $sql_borrowings = "SELECT * FROM borrowings WHERE id_user = {$_SESSION["user_id"]}";
    $result_borrowings = $mysqli->query($sql_borrowings);
}

if (isset($_POST["newborrow"])) {

    $book_id = $_POST['select-book'];
    $date_borrow = $_POST['date-borrow'];
    $sql_date_borrow = date("Y-m-d", strtotime($date_borrow));
    $date_return = $_POST['date-return'];
    $sql_date_return = date("Y-m-d", strtotime($date_return));

    $query = "INSERT INTO borrowings (id_user, id_book, date_borrow, date_return)
              VALUES ('{$_SESSION["user_id"]}', '$book_id', '$sql_date_borrow', '$sql_date_return')";

    if ($mysqli->query($query)) {
        header("Location: " . $_SERVER['REQUEST_URI']);
    } else {
        echo "Error: " . $mysqli->error;
    }
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
        <br>
        <h4>Twoje dane: </h4>
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

        <br><br>
        <h4>Wypożycz książkę: </h4>

        <form action="" method="post">
            <div>
            <select name="select-book">
                <option value='0'>-- Wybierz książkę --</option>
                <?php
                    while ($book = $result_books->fetch_assoc()) {
                        echo "<option value='".$book["id"]."'>" .$book["author"]. ", " .$book["title"]. "</option>";
                    }
                ?>
            </select>
            </div>
            <br>
            <div>
                <label for="date-borrow">Data wypożyczenia:</label>
                <input type="date" name="date-borrow">
            </div>
            <br>
            <div>
                <label for="date-return">Data zwrotu: </label>
                <input type="date" name="date-return">
            </div>
            <br>
            <input type="submit" name="newborrow" value="Wypożycz">

        </form>
        <br>

        <h4>Historia wypożyczeń: </h4>

        <br>
        <table>
        <tr>
            <th>id</th>
            <th>id user</th>
            <th>id book</th>
            <th>Data wypożyczenia</th>
            <th>Data zwrotu</th>
        </tr>

        <?php while ($borrowing = $result_borrowings->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $borrowing["id"]; ?></td>
                <td><?php echo $borrowing["id_user"]; ?></td>
                <td><?php echo $borrowing["id_book"]; ?></td>
                <td><?php echo $borrowing["date_borrow"]; ?></td>
                <td><?php echo $borrowing["date_return"]; ?></td>
            </tr>
        <?php endwhile; ?>
        </table>

        <br><br><br>
        <h4><a href="logout.php">Wyloguj</a></h4>
        
    <?php else: ?>
        
        <p><a href="login.php">Zaloguj się</a> lub <a href="signup.html">Załóż konto</a></p>
        
    <?php endif; ?>
</body>
</html>


