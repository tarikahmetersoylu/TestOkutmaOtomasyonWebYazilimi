<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" language="javascript" src="Script.js"></script>
  <link href="css.css" rel="stylesheet">
  <link href="table.css" rel="stylesheet">

  <title>Kullanıcılar</title>
  <?php
  include "dataBaseInfo.php";
  if (isset($_POST["sicilNo"])) {
    $control=False;
    $sicilNo = $_POST["sicilNo"];
    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $sifre = $_POST["sifre"];
    $control_query = "select sicilNo from ogretimUye";
    $control_ogretimUye = $conn->query($control_query);
    while ($control_uyeler = mysqli_fetch_array($control_ogretimUye)) {
      if ($control_uyeler["sicilNo"] == $sicilNo) {
        echo '<script>alert("Bu sicil Numarasına sahip bir öğretim görevlisi zaten mevcut.")</script>';
        $control=True;
      }
    }
    if(!$control)
    {
      $insert_query = "insert into ogretimUye(sicilNo,adi,soyadi,sifre) values ($sicilNo,'$adi','$soyadi','$sifre');";
      $insert = $conn->query($insert_query);
    }
  }
  ?>
  <!-- Bootstrap core CSS -->


  <!-- Custom styles for this template -->

</head>

<body onresize="test()" onLoad="yenile()">
  <div id="TumSayfa" onClick="kapat()">
    <?php
    include "leftMenu.php";
    $conn = new mysqli($servername, $user, $pass, $dbname);
    $query = "select * from ogretimUye;";
    $ogretimUyeleri = $conn->query($query);
    echo $leftMenu;
    ?>
    <div id="Icerik">
      <div id="GenelTabloSinirlamaAlani">
        <div class="col-md-12">

          <h3 class="title-5 m-b-35">Kullanıcı Bilgileri</h3>
          <div class="table-data__tool">

            <div class="table-data__tool-right">
              <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModelUserAdd"><i class="zmdi zmdi-plus"></i>Yeni Kullanıcı Ekle</button>
            </div>
          </div>
          <div class="table-responsive table-responsive-data2">
            <table id="TabloSinirlamaAlani" class="table table-data2">
              <thead>
                <tr>
                  <th>Sicil Numarası</th>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>Şifre</th>
                  <th>Düzenle</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($ogretimUye = mysqli_fetch_array($ogretimUyeleri)) {
                  echo '
    <tr class="tr-shadow">
      <td>' . $ogretimUye["sicilNo"] . '</td>
      
      <td>' . $ogretimUye["adi"] . '</td>
      
      <td>' . $ogretimUye["soyadi"] . '</td>
      
      <td>' . $ogretimUye["sifre"] . '</td>
      
      <td>
        <div class="table-data-feature">
              <button onclick="userEdit(' . $ogretimUye["sicilNo"] . ',`' . ($ogretimUye["adi"]) . '`,`' . $ogretimUye["soyadi"] . '`,`' . $ogretimUye["sifre"] . '`)" type="submit" data-target="#myModalUserEdit" data-toggle="modal" class="item" data-placement="top" title="Güncelle" data-original-title="Edit">
                <i class="zmdi zmdi-edit"></i>
              </button>
          <button onclick="deleteUser(' . $ogretimUye["sicilNo"] . ',`' . $ogretimUye["adi"] . '`,`' . $ogretimUye["soyadi"] . '`)" data-target="#myModalDeleteUser" data-toggle="modal" class="item" data-toggle="tooltip" data-placement="top" title="Sil" data-original-title="Delete">
            <i class="zmdi zmdi-delete"></i>
          </button>
        </div>
      </td>
    </tr>
    <tr class="spacer"></tr>';
                }
                ?>
                <script>
                  function userEdit(sicilNo, adi, soyadi, sifre) {
                    getUserName(sicilNo, adi, soyadi, sifre);
                  }

                  function getUserName(sicilNo, adi, soyadi, sifre) {
                    document.getElementById("sicilNoID").value = sicilNo;
                    document.getElementById("oldsicilNoID").value = sicilNo;
                    document.getElementById("adiID").value = adi;
                    document.getElementById("soyadiID").value = soyadi;
                    document.getElementById("sifreID").value = sifre;
                  }

                  function deleteUser(sicilNo, adi, soyadi) {
                    document.getElementById("deleteUserID").value = sicilNo;
                    document.getElementById("whichUserName").innerHTML = adi + " " + soyadi;
                  }
                </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModelUserAdd">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Kullanici Ekle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="kullaniciEkle.php" method="post">
            <div class="form-group">
              <label><b>Sicil No:</b></label>
              <input type="text" class="form-control" name="sicilNo" required>
            </div>
            <div class="form-group">
              <label><b>Adı:</b></label>
              <input type="text" class="form-control" name="adi" required>
            </div>
            <div class="form-group">
              <label><b>Soyadı:</b></label>
              <input type="text" class="form-control" name="soyadi" required>
            </div>
            <div class="form-group">
              <label><b>Şifre:</b></label>
              <input type="text" class="form-control" name="sifre" required>
            </div>
            <button type="submit" class="btn btn-primary">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--User Edit Modal -->
  <div class="modal fade" id="myModalUserEdit">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Kullanici Düzenle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="editUser.php" method="post">
            <div class="form-group">
              <label><b>Sicil No:</b></label>
              <input id="oldsicilNoID" type="hidden" class="form-control" name="oldsicilNo" value="">
              <input id="sicilNoID" type="text" class="form-control" name="sicilNo" required>
            </div>
            <div class="form-group">
              <label><b>Adı:</b></label>
              <input id="adiID" type="text" class="form-control" name="adi" required>
            </div>
            <div class="form-group">
              <label><b>Soyadı:</b></label>
              <input id="soyadiID" type="text" class="form-control" name="soyadi" required>
            </div>
            <div class="form-group">
              <label><b>Şifre:</b></label>
              <input id="sifreID" type="text" class="form-control" name="sifre" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalDeleteUser">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Kullanıcı Sil</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="whichUserName"></label>
          adlı kullanıcıyı silmek istediğinize emin misiniz?
          <form action="deleteUser.php" method="post">
            <button type="submit" class="btn btn-danger">Evet</button>
            <input id="deleteUserID" type="hidden" class="form-control" name="sicilNo" value="">
          </form>
          <form>
            <button type="close" class="btn btn-info">Hayır</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>