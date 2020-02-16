<!doctype html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>Başlıksız Belge</title>

</head>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link type="text/css" rel="stylesheet" href="Stil.css">
  <title>Extra Eğitim</title>
</head>

<body class="login-body" style="height: auto; min-height: 100%;">


  <div class="container">

    <form class="form-signin" action="" method="post">
      <h2 class="form-signin-heading">Login</h2>
      <div class="login-wrap">
        <input type="text" class="form-control" name="username" placeholder="Username" autofocus required>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <button class="btn btn-lg btn-login btn-block" type="submit">Login</button>
        <?php
        include "dataBaseInfo.php";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
          $username = $_POST["username"];
          $password = $_POST["password"];

          $conn = new mysqli($servername, $user, $pass, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $admin_query = "select * from admins where kullaniciAdi = '$username' and sifre = '$password'";
          $ogretimUye_query = "select * from ogretimUye where sicilNo = $username and sifre = '$password'";
          
          $admin_result = $conn->query($admin_query);
          $ogretimUye_result = $conn->query($ogretimUye_query);
          
          $admin_response = mysqli_fetch_assoc($admin_result);
          $ogretimUye_response = mysqli_fetch_assoc($ogretimUye_result);
          if ($admin_result->num_rows > 0) {
            session_start();
            $_SESSION["glbAdmin"] = $admin_response;
            header("Location: kullaniciEkle.php");
          } 
          else if($ogretimUye_result->num_rows > 0){
            session_start();
            $_SESSION["glbogretimUye"] = $ogretimUye_response;
            header("Location: ogretimUyesiDersBilgileriPhp.php");
          }
          else {
            echo '<div class="text-danger text-center">Hatalı Kullanıcı adi veya sifre</div>';
          }
        }
        ?>
      </div>
    </form>
  </div>
</body>

</html>