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
<h1>Мои статьи</h1>
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

        echo "<div class='container'>";


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
                                    <a style=" " href="page/article.html" class="pull-right btn btn-primary">More</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>';

            if( ($i % 2) == 1) echo'</div>';
        }
        echo '</div>';

      // очищаем результат
    mysqli_free_result($result);
?>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
