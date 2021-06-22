<?
    require_once 'db/connection.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));


if($_GET["years"] == 0)
{
$query = "SELECT * FROM post ";
}
else {
  $year = $_GET["years"];
  $mount = $_GET["mounts"];
  $query = "SELECT * FROM post WHERE MONTH(date) = $mount AND YEAR(date) = $year";
}


// выполняем операции с базой данных


$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
$rows = mysqli_num_rows($result); // количество полученных строк

        echo'<div class="col">';


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
                                <img style="width: 100%" src="../img/'. $row[6] .'">
                            </div>
                            <div class="col">
                                <p>
                                    '.$row[7].'
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-3">' .$row[3]. '</div>
                                <div class="col-3">Autor:' .$row[4].'</div>
                                <div class="col-3"></div>
                                <div style="padding:" class="col-3 text-right">
                                    <a style=" " href="page/article.php?article='.$row[0].'" class="pull-right btn btn-primary">More</a>
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
