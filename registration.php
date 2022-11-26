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
        $passwordRepeatInput = $_POST["passwordRepeatInput"];

        if (strlen($passwordInput) < 1) {
            $registrationError = "Необходимо ввести пароль!";
        }

        if ($passwordInput !== $passwordRepeatInput) {
            $registrationError = "Пароли должны совпадать!";
        }

        if (strlen($loginInput) < 3) {
            $registrationError = "Длина логина должна быть больше 2 символов!";
        }

        if (isset($registrationError)) {
            $_SESSION['registrationError'] = $registrationError;
        } else {
            $dbConnection = mysqli_connect("localhost", "carparts_user", "111", "carparts");
            if ($dbConnection != false) {
                $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (login, password, role) VALUES ('$loginInput', '$passwordHash', 'CUSTOMER')";
                mysqli_query($dbConnection, $sql);
                header( "Location: https://localhost/carparts/login.php", true, 303);
                exit();
            }
            $_SESSION['registrationError'] = "Произошла ошибка при создани нового пользователя!";
        }
        header( "Location: https://localhost/carparts/registration.php", true, 303);
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Регистрация</title>
    </head>
    <style>
        h4 {
            color: red;
        }
    </style>
    <body>
    <div align="center">
        <form method="POST" action="registration.php">
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
                    <td><label for="passwordRepeatInput">Повторите пароль</label></td>
                    <td><input id="passwordRepeatInput" type="password" name="passwordRepeatInput" value=""/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Регистрация</button></td>
                </tr>
            </table>
            <?php
                if (isset($_SESSION['registrationError'])) {
                    $error = $_SESSION['registrationError'];
                    echo "<h4>$error</h4>";
                    unset($_SESSION['registrationError']);
                }
            ?>
            <p>
                <a href="https://localhost/carparts/login.php">Вход на сайт</a>
            </p>
        </form>
    </div>
    </body>
</html>