<?php
  /* Принимаем данные из формы */



  $page_id = $_POST["page_id"];
  $text_comment = $_POST["text_comment"];
  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности
  $mysqli = mysqli_connect("localhost", "root", "", "zachet");// Подключается к базе данных
  $query = mysqli_query($mysqli, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
  $userdata = mysqli_fetch_assoc($query);
  $name = $userdata['user_login'];
  $query = ("INSERT INTO `commit` (`id`, `name`, `text`, `date`, `time`, `id_article`, `like`, `dislike`, `img`) VALUES (NULL, '$name', '$text_comment', NULL, NULL, '$page_id', '0', '0', '\'#\'')");
  mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
  // Добавляем комментарий в таблицу
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>
