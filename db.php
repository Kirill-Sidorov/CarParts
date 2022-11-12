<?php
try {
    // подключаемся к серверу
    $conn = new PDO("mysql:host=localhost;dbname=carparts", "carparts_user", "111", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Database connection established";

    $sql = "SELECT * FROM parts";

    $result = $conn->query($sql);
    echo "<table><tr><th>id</th><th>partName</th><th>cost</th><th>inStock</th></tr>";

    while($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row["id"] .       "</td>";
        echo "<td>" . $row["partName"] . "</td>";
        echo "<td>" . $row["cost"] .     "</td>";
        echo "<td>" . $row["inStock"] .  "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>