<?php
    // Присвоение значения переменным
    $site_title = "PHP Пример";
    $bg_color = "yellow";
    $user_name = "Студент Сидоров";
    $hello = "Привет, Мир!";
?>
<html>
    <title><?php print $hello; ?></title>
</html>
<body bgcolor="<?php print $bg_color; ?>">

<?php
    // Приветствие с датой
    print "Вывод текущей даты <br>";
    print "PHP Recipes | ".date("F d. Y")." <br> Привет, $user_name! <br>";
    print "<br>Конец вывода";
?>

<?php
    // Массивы
    $meat[0] = "Один";
    $meat[1] =  "Два";
    $meat[2] = "Три";
    $i = 1;
    print "<br> $i-й элемент массива =  $meat[$i] <br>";
?>