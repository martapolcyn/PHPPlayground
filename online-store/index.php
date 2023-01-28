<?php

    session_start();

    $connection = mysqli_connect("localhost", "root", "marta", "online_store");
    if (isset($_POST['add_to_cart'])) {

        if(isset($_SESSION['cart'])) {
            
            $session_array_id = array_column($_SESSION['cart'], "id");

            if (!in_array($_GET['id'], $session_array_id)) {

                $session_array = array (
                    'id' => $_GET['id'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity']
                );
    
                $_SESSION['cart'][] = $session_array;

            }

        } else {

            $session_array = array (
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );

            $_SESSION['cart'][] = $session_array;
        }
    }

?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <title>Art store</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="parent">
    <div class="child">
        <div class="items">
        <h2>Nasze produkty</h2>
            <?php
            $sql = "SELECT * FROM items";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) { ?>
                <form method="post" action="index.php?id=<?=$row['id'] ?>">
                    <div class="item">
                        <h3>
                            <?= $row['name']; ?> - 
                            <?= number_format($row['price'], 2, ',', ' '); ?> zł
                        </h3>
                        <p>
                            <?= $row['description']; ?>
                        </p>
                        <input type="number" name="quantity" value="1" class="quantity">
                        <input type="submit" name="add_to_cart" class="button_add" value="Do koszyka">
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="child">
        <div>
            <h2>Podaj dane do zamówienia:</h2>
            <form method="post" action="send-email.php">
                <div>
                    <label for="name">Imię</label>
                    <input type="text" name="firstname" id="firstname" required>
                </div>
                <div>
                    <label for="name">Nazwisko</label>
                    <input type="text" name="lastname" id="lastname" required>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <br>
                <div>
                    <div class="address">
                        <label for="street">Ulica</label>
                        <input type="text" id="street" name="street">
                    </div>
                    <div class="address">
                        <label for="house_no">Nr domu</label>
                        <input type="text" id="house_no" name="house_no">
                    </div>
                    <div class="address">
                        <label for=" flat_no">Nr mieszkania</label>
                        <input type="text" id="flat_no" name="flat_no">
                    </div>
                </div>
                <div>
                    <div class="address">
                        <label for="zip_code">Kod pocztowy</label>
                        <input type="text" id="zip_code" name="zip_code">
                    </div>
                    <div class="address">
                        <label for="city">Miasto</label>
                        <input type="text" id="city" name="city">
                    </div>
                </div>
                <br>
                <button class='button_send'>Złóż zamówienie</button>
            </form>
        </div>
        <div>
            <h2>Koszyk:</h2>
            <?php

                $total = 0;
            
                $output = "";

                $output .= "
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                            <th>Usuń</th>
                        <tr>
                ";

                if (!empty($_SESSION['cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) {

                        $output .= "
                            <tr>
                                <td>".$value['id']."</td>
                                <td>".$value['name']."</td>
                                <td>".$value['quantity']."</td>
                                <td>".$value['price']."</td>
                                <td>
                                    <a href='index.php?action=remove&id=".$value['id']."'>
                                        <button class='button_remove'>X</button>
                                    </a>
                                </td>
                            <tr>
                        ";

                        $total = $total + $value['quantity'] * $value['price'];
                    }

                }

                $output .= "
                    <tr>
                        <td colspan='2'></td>
                        <td>Suma</td>
                        <td>$total</td>
                        <td>
                            <a href='index.php?action=clearall'>
                                <button class='button_remove_all'>X</button>
                            </a>
                        </td>
                    </tr>
                ";

                echo $output;

            ?>
        </div>

        <?php 
            if (isset($_GET['action'])) {

                if ($_GET['action'] == "clearall") {
                    unset($_SESSION['cart']);
                }

                if ($_GET['action'] == "remove") {
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if ($value['id'] == $_GET['id']) {
                            unset($_SESSION['cart'][$key]);
                        }
                    }
                }
            }
        ?>

    </div>
</div>
</body>
</html>
