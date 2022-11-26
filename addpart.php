<?php
    include_once "utils/checkuser.php";
    if ($_SESSION['userRole'] !== "ADMIN") {
        header( "Location: https://localhost/carparts/catalog.php", true, 303);
        exit();
    }
    $request_method = strtoupper($_SERVER['REQUEST_METHOD']);
    if ($request_method === 'POST') {
        $partName = $_POST["partName"];
        $cost = $_POST["cost"];
        $inStock = $_POST["inStock"];
        if (strlen($partName) > 0 and $cost > 0 and $inStock > 0) {
            $dbConnection = mysqli_connect("localhost", "carparts_user", "111", "carparts");
            if ($dbConnection != false) {
                mysqli_query($dbConnection, "INSERT INTO parts (partName, cost, inStock) VALUES ('$partName', $cost, $inStock)");
                header( "Location: https://localhost/carparts/catalog.php", true, 303);
                exit();
            }
        }
        header( "Location: https://localhost/carparts/addpart.php", true, 303);
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>Добавить запасную часть</title>
    </head>
    <body>
        <div align="center">
            <form method="POST" action="addpart.php">
                <h2>Добавление новой запасной части в каталог</h2>
                <table>
                    <tr>
                        <td><label for="partName">Название детали</label></td>
                        <td><input id="partName" type="text" name="partName"></td>
                    </tr>
                    <tr>
                        <td><label for="cost">Стоимость</label></td>
                        <td><input id="cost" type="number" min="1" name="cost"></td>
                    </tr>
                    <tr>
                        <td><label for="inStock">Количество</label></td>
                        <td><input id="inStock" type="number" min="1" name="inStock"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Создать</button></td>
                    </tr>
                </table>
            </form>
            <a href="https://localhost/carparts/catalog.php">Каталог запасных частей</a>
        </div>
    </body>
</html>