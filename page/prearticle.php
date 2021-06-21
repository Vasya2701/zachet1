<? 
    require_once 'db/connection.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query = "SELECT * FROM `post`";

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
