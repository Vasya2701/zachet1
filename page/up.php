<?php
require_once '../db/connection.php'; // подключаем скрипт

    $date = date("Y-m-d");
    $time = date("G:i:s");

if (isset($_POST['name']) && isset($_POST['text'])) {

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));


    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $text = htmlentities(mysqli_real_escape_string($link, $_POST['text']));




    // Путь загрузки
    $path = '../img/';

// Обработка запроса
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Загрузка файла и вывод сообщения
        $img = $_FILES['picture']['name'];
        if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
            echo 'Что-то пошло не так';
        else
            header ('Location: ../index.php');
    }

}

// подключаемся к серверу
// создание строки запроса
$query = "INSERT INTO `post` (`id`, `head`, `text`, `date`, `autor`, `link`, `img`, `pretext`) VALUES (NULL, '$name', '$text', '$date', 'admin', '1', '$img', 'pre')";

// выполняем запрос
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if ($result) {
    echo "<span style='color:blue;'>Данные добавлены</span>";
}


// закрываем подключение
mysqli_close($link);
