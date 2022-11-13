<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Загрузка файла</title>
    </head>
    <body>
        <?php
            if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) {
                $filename = $_FILES["filename"]["name"];
                move_uploaded_file($_FILES["filename"]["tmp_name"], $filename);

                $string = $_POST["string"];
                if (strlen($string) > 0) {
                    $fd = fopen($filename, 'a') or die("Не удалось открыть файл");
                    fwrite($fd, $string);
                    fclose($fd);
                }

                $content = htmlentities(file_get_contents($filename));
                echo "
                    <p>Файл загружен. Содержимое файла:</p>
                    <p>$content</p>
                ";
            }
        ?>
        <h2>Загрузка файла</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="upload_file">Выберите файл:</label>
            <input id="upload_file" type="file" name="filename" size="10"/><br/><br/>
            <label for="string">Добавить строку в файл:</label>
            <input id="string" type="text" name="string"><br/><br/>
            <input type="submit" value="Загрузить" />
        </form>
    </body>
</html>