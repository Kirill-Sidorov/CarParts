<?php
    $link = mysqli_connect("localhost", "carparts_user", "111", "carparts");

    if ($link == false) {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    else {
        $sql = "SELECT * FROM parts";
        $result = mysqli_query($link, $sql);
        if ($result == false) {
            print("Произошла ошибка при выполнении запроса");
        }
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
?>