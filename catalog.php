<?php
    include_once "utils/checkuser.php";
    if (isset($_GET["action"]) and isset($_GET["id"])) {
        $action = $_GET["action"];
        $id = $_GET["id"];
        if ($action === 'delete') {
            $dbConnection = mysqli_connect("localhost", "carparts_user", "111", "carparts");
            if ($dbConnection != false) {
                mysqli_query($dbConnection, "DELETE FROM parts WHERE id=$id");
                header( "Location: https://localhost/carparts/catalog.php", true, 303);
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>Каталог</title>
    </head>
    <body>
        <div align="center">
            <p>
                <a href="https://localhost/carparts/logout.php">Выйти</a>
            </p>
            <h2>Каталог запасных частей</h2>
            <p>
                <a href="https://localhost/carparts/addpart.php">Добавление нового товара</a>
            </p>
            <table border="1" cellpadding="7">
                <caption>Таблица запасных частей в наличии</caption>
                <thead>
                    <tr>
                        <th>Название детали</th>
                        <th>Стоимость</th>
                        <th>Количество на складе</th>
                        <th>Изменить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbConnection = mysqli_connect("localhost", "carparts_user", "111", "carparts");
                        if ($dbConnection != false) {
                            $result = mysqli_query($dbConnection, "SELECT * FROM parts");
                            if ($result != false) {
                                while($row = mysqli_fetch_array($result)) {
                                    $delete_href = "catalog.php?action=delete&id=" . $row["id"];
                                    echo "<tr>";
                                    echo "<td>" . $row["partName"] . "</td>";
                                    echo "<td>" . $row["cost"] .     "</td>";
                                    echo "<td>" . $row["inStock"] .  "</td>";
                                    echo "<td><a href=$delete_href>Удалить</a></td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>