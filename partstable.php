<html>
    <head>
        <title>carparts</title>
    </head>
    <body>
        <div align="center">
            <h1>Добро пожаловать, работник склада!</h1>
            <h3>Таблица запасные частей</h3>

            <table border="1" cellpadding="7">
                <thead>
                    <tr>
                        <th>Название детали</th>
                        <th>Стоимость</th>
                        <th>Количество на складе</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Компрессор кондиционера</td>
                        <td>10000</td>
                        <td>4</td>
                    </tr>
                    <?php
                        if(isset($_POST["partName"]) and isset($_POST["cost"]) and isset($_POST["inStock"])) {
                            $partName = $_POST["partName"];
                            $cost = $_POST["cost"];
                            $inStock = $_POST["inStock"];
                            echo "
                                <tr>
                                    <td>$partName</td>
                                    <td>$cost</td>
                                    <td>$inStock</td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>

            <form method="POST" action="partstable.php">
                <h3>Добавление запасной части</h3>
                <p>
                    <label for="partName">Название детали</label>
                    <input id="partName" type="text" name="partName">
                </p>
                <p>
                    <label for="cost">Стоимость</label>
                    <input id="cost" type="number" min="1" name="cost">
                </p>
                <p>
                    <label for="inStock">Количество</label>
                    <input id="inStock" type="number" min="1" name="inStock">
                </p>
                <button type="submit">Создать</button>
            </form>

        </div>
    </body>
</html>