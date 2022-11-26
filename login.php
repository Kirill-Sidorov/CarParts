<?php
    session_start();
    if (isset($_SESSION['userRole'])) {
        header( "Location: https://localhost/carparts/catalog.php", true, 303);
        exit();
    }
    $request_method = strtoupper($_SERVER['REQUEST_METHOD']);
    if ($request_method === 'POST') {
        $loginInput = $_POST["loginInput"];
        $passwordInput = $_POST["passwordInput"];

        if (strlen($loginInput) == 0 || strlen($passwordInput) == 0) {
            $loginError = "Необходимо ввести логин и пароль!";
        }

        if (isset($loginError)) {
            $_SESSION['loginError'] = $loginError;
        } else {
            $dbConnection = mysqli_connect("localhost", "carparts_user", "111", "carparts");
            if ($dbConnection != false) {
                $result = mysqli_query($dbConnection, "SELECT * FROM users WHERE login='$loginInput'");
                if ($result != false) {
                    while($row = mysqli_fetch_array($result)) {
                        if ($row['password']) {
                            if (password_verify($passwordInput, $row['password'])) {
                                $_SESSION['userRole'] = $row['role'];
                                header( "Location: https://localhost/carparts/catalog.php", true, 303);
                                exit();
                            }
                        }
                    }
                }
            }
            $_SESSION['loginError'] = "Неверный логин или пароль!";
        }
        header( "Location: https://localhost/carparts/login.php", true, 303);
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Вход на сайт</title>
    </head>
    <style>
        h4 {
            color: red;
        }
    </style>
    <body>
        <div align="center">
            <form method="POST" action="login.php">
                <table>
                    <tr>
                        <td><label for="loginInput">Логин</label></td>
                        <td><input id="loginInput" type="text" name="loginInput" value=""/></td>
                    </tr>
                    <tr>
                        <td><label for="passwordInput">Пароль</label></td>
                        <td><input id="passwordInput" type="password" name="passwordInput" value=""/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Войти</button></td>
                    </tr>
                </table>
                <?php
                    if (isset($_SESSION['loginError'])) {
                        $error = $_SESSION['loginError'];
                        echo "<h4>$error</h4>";
                        unset($_SESSION['loginError']);
                    }
                ?>
                <p>
                    <a href="https://localhost/carparts/registration.php">Регистрация</a>
                </p>
            </form>
        </div>
    </body>
</html>