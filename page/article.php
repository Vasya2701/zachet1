<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
  <? include_once'nav.php'; ?>
  <div><img style="width: 100%" src="https://picsum.photos/1250/100"></div>
  <div class="container">
<?


include_once('../db/connection.php');
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));


$log = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysqli_fetch_assoc($log);
$userouth=$userdata['user_login'];
// выполняем операции с базой данных
$article=htmlspecialchars($_GET["article"]);
$query = "SELECT * FROM post WHERE id=$article";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);

      echo'<div class="row">
          <div class="col-3">
              <ul class="my-2">

              </ul></div>
          <div class="col">
            <div class="row">
                            <h1>'.$row[1].'</h1>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img align="left" style="width: 200px; height: 200px;" src="'.$row[6].'" alt="foto" vspace="5" hspace="10">
                                <p align="">
                                  '.$row[2].'
               </div>
           </div>
           <div class="row">
               <strong style="float: left;">'.$row[3].' autor:'.$row[4].'</strong>
               <a style="width: 100px; float: right; " class="pull-right btn btn-primary">back</a>
           </div>
          </div>
      </div>
  </div>';
?>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
