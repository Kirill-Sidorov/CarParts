<!DOCTYPE html>
<html>
    <head>
        <meta charset=UTF-8>
        <title>carparts</title>
    </head>
    <body>
        <div align="center">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $conn = new PDO("mysql:host=localhost;dbname=carparts", "carparts_user", "111", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                            $sql = "SELECT * FROM parts";
                            $result = $conn->query($sql);
                            while($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row["partName"] . "</td>";
                                echo "<td>" . $row["cost"] .     "</td>";
                                echo "<td>" . $row["inStock"] .  "</td>";
                                echo "</tr>";
                            }
                        }
                        catch (PDOException $e) {
                            echo "Connection failed: " . $e->getMessage();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>