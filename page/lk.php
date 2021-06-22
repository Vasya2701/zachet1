<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
<?
include_once'nav.php';
?>
<h1 class="mx-5">Личный кабинет</h1>

<?





include_once('../db/connection.php');
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));


$log = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysqli_fetch_assoc($log);
$userouth=$userdata['user_login'];
// выполняем операции с базой данных

$query = "SELECT * FROM post WHERE autor='$userouth'";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
$rows = mysqli_num_rows($result); // количество полученных строк

        echo "<div class='container'>
        <div class='row'>
            <div class='col-4'>
                <ul class='my-02'>";?>




                  <?
                  // Страница авторизации

                  // Функция для генерации случайной строки
                  function generateCode($length=6) {
                      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
                      $code = "";
                      $clen = strlen($chars) - 1;
                      while (strlen($code) < $length) {
                              $code .= $chars[mt_rand(0,$clen)];
                      }
                      return $code;
                  }

                  // Соединямся с БД
                  $link=mysqli_connect("localhost", "admin", "12345678", "zachet");
                  if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
                  {
                  $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                  $userdata = mysqli_fetch_assoc($query);
                  $autuser=$userdata['user_login'];
                  }
                  if(isset($_POST['submiti']))
                  {
                      // Вытаскиваем из БД запись, у которой логин равняеться введенному
                      $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_hash = '".intval($_COOKIE['id'])."' LIMIT 1");

                      $data = mysqli_fetch_assoc($query);
                      $newpassword = md5(md5($_POST['newpassword']));
                      // Сравниваем пароли
                      $a = md5(md5(trim($_POST['newpassword'])));
                      echo ''.$a.'';
                      $autuser=$data['user_login'];
                      if($data['user_password'] == md5(md5(trim($_POST['password']))))
                      {



                          // Записываем в БД новый хеш авторизации и IP
                          mysqli_query($link, "UPDATE users SET user_login='".$autuser."' WHERE user_password='".$newpassword."'");

                          // Ставим куки
//  setcookie("id", "", time() - 3600*24*30*12, "/");
                        //  setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!


                          // Переадресовываем браузер на страницу проверки нашего скрипта
                        //  header("Location: ../login.php"); exit();
                      }
                      else
                      {
                          print "Вы ввели неправильный логин/пароль";
                      }
                  }
                  ?>
                  <form method="POST">

                  Пароль <input name="password" type="password" required><br>
                  новый Пароль <input name="newpassword" type="password" required><br>
                  Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>
                  <input name="submiti" type="submit" value="изменить пароль">
                  </form>







                  <h4>Добавить статью</h4>
                <form method="post" action="up.php" enctype="multipart/form-data" class="mx-auto" style="width: 250px">
    <div class="form-group">
        <label for="exampleInputEmail1">Название</label>
        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Описание</label>
        <textarea name="text" type="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Аннотация</label>
        <textarea name="pretext" type="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

    </div>






    <div >
        <input type="file" name="picture">
        <input type="submit" value="Загрузить">
    </div>
</form>
<?php echo "
                </ul>
                </div>
                <div class='col'><h3>Мои статьи</h3>";



 for ($i = 0 ; $i < $rows ; ++$i)
 {
        $row = mysqli_fetch_row($result);



            if( ($i % 2) == 0) echo'<div class="row">';

                echo '<div class="col">
                    <div>
                        <div class="row">
                            <a><h1> '. $row[1] .' </h1></a>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <img style="width: 100%" src="'. $row[6] .'">
                            </div>
                            <div class="col">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor purus non turpis varius ultricies.
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-3">' .$row[3]. '</div>
                                <div class="col-3">Autor:' .$row[4].'</div>
                                <div class="col-3"></div>
                                <div style="padding:" class="col-3 text-right">
                                    <a style=" " href="article.php?article='.$row[0].'" class="pull-right btn btn-primary">More</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>';

            if( ($i % 2) == 1) echo'</div>';
        }
        echo '</div></div>
    </div>';

      // очищаем результат
    mysqli_free_result($result);
?>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
