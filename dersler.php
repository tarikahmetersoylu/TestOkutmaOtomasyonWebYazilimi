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
  <title>DERSLER</title>
  <?php
  include "dataBaseInfo.php";
  if (isset($_POST['dersKodu']) && isset($_POST["dersAdi"]) && isset($_POST["bolumAdi"])) {
    $control = false;
    $dersKodu = $_POST["dersKodu"];
    $dersAdi = $_POST["dersAdi"];
    $bolumAdi = $_POST["bolumAdi"];
    $bolum_query = "select * from bolum where bolumAdi='$bolumAdi'";
    $bolum_result = $conn->query($bolum_query);
    $bolum = mysqli_fetch_array($bolum_result);
    $bolumNo = $bolum["bolumNo"];
    $dersKazanim = $_POST["dersKazanim"];
    $dersKodu = strval($bolumNo) . $dersKodu;

    $control_query = "select dersKodu from dersler";
    $control_dersler = $conn->query($control_query);
    while ($control_dersKodu = mysqli_fetch_array($control_dersler)) {
      if (strcmp($control_dersKodu["dersKodu"], $dersKodu) == 0) {
        echo '<script>alert("Bu koda ait bir ders zaten mevcut.");</script>';
        $control = true;
      }
    }
    if (!$control) {
      $insert_query = "insert into dersler(dersKodu,dersAdi,bolumNo,dersKazanim) values ('$dersKodu','$dersAdi',$bolumNo,'$dersKazanim');";
      $insert = $conn->query($insert_query);
    }
  }

  ?>
</head>

<body onresize="test()" onLoad="yenile()">
  <div id="TumSayfa" onClick="kapat()">
    <?php
    include "leftMenu.php";
    include "dataBaseInfo.php";
    $query = "select dersKodu,dersAdi,dersKazanim,(select bolumAdi from bolum where bolumNo=dersler.bolumNo) as bolumAdi from dersler;";
    $dersler = $conn->query($query);
    echo $leftMenu;
    ?>
    <div id="Icerik">
      <div id="GenelTabloSinirlamaAlani">
        <div class="col-md-12">

          <h3 class="title-5 m-b-35">Ders Bilgileri</h3>
          <div class="table-data__tool">

            <div class="table-data__tool-right">
              <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modalAddLecture"><i class="zmdi zmdi-plus"></i>Yeni Ders Ekle</button>
            </div>
          </div>
          <div class="table-responsive table-responsive-data2">
            <table id="TabloSinirlamaAlani" class="table table-data2">
              <thead>
                <tr>

                  <th>Ders Kodu</th>
                  <th>Ders Adı</th>
                  <th>Bölümü</th>
                  <th>ÖĞRENİM KAZANIMLARI</th>
                  <th>Düzenle</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($ders = mysqli_fetch_array($dersler)) {
                  echo '
                        <tr class="tr-shadow">
                          <td>' . $ders["dersKodu"] . '</td>
                          <td class="status--process">' . $ders["dersAdi"] . '</td>
                          <td>' . $ders["bolumAdi"] . '</td>
                          <td>
                            <button onclick="showKazanim(`' . $ders["dersKazanim"] . '`)" class="au-btn au-btn-icon au-btn--darkseagreen au-btn--small" data-toggle="modal" data-target="#modalDersKazanim">
                              Göster
                            </button>
                          </td>
                          <td>
                            <div class="table-data-feature">
                              <button onclick="lectureEdit(`' . $ders["dersKodu"] . '`,`' . $ders["dersAdi"] . '`,`' . $ders["bolumAdi"] . '`,`' . $ders["dersKazanim"] . '`)" data-toggle="modal" data-target="#modalLectureEdit" class="item" data-toggle="tooltip" data-placement="top" title="Güncelle" data-original-title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                              </button>
                              <button onclick="deleteLecture(`' . $ders["dersKodu"] . '`,`' . $ders["dersAdi"] . '`)" data-toggle="modal" data-target="#modalDeleteLecture" class="item" data-toggle="tooltip" data-placement="top" title="Sil" data-original-title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <tr class="spacer"></tr>';
                }
                ?>
                <script>
                  function lectureEdit(dersKodu, dersAdi, bolumAdi, dersKazanim) {
                    getLecture(dersKodu, dersAdi, bolumAdi, dersKazanim);
                  }

                  function getLecture(dersKodu, dersAdi, bolumAdi, dersKazanim) {
                    document.getElementById("dersKoduID").value = dersKodu;
                    document.getElementById("oldDersKoduID").value = dersKodu;
                    document.getElementById("dersAdiID").value = dersAdi;
                    document.getElementById("bolumAdiID").value = bolumAdi;
                    document.getElementById("dersKazanimID").value = dersKazanim;
                  }

                  function deleteLecture(dersKodu, dersAdi) {
                    document.getElementById("deleteLectureID").value = dersKodu;
                    document.getElementById("whichLecture").innerHTML = dersAdi;
                  }

                  function showKazanim(kazanim) {
                    document.getElementById("showDersKazanimID").innerHTML = kazanim;
                  }
                </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalAddLecture">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Ekle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form action="dersler.php" method="post">
            <div class="form-group">
              <label><b>Ders Kodu:</b></label>
              <input type="text" class="form-control" name="dersKodu" required>
            </div>
            <div class="form-group">
              <label><b>Ders Adı:</b></label>
              <input type="text" class="form-control" name="dersAdi" required>
            </div>
            <div class="form-group">
              <label>Bölüm:</label>
              <select class="form-control" name="bolumAdi">
                <?php
                $bolum_query = "select * from bolum;";
                $bolum_result = $conn->query($bolum_query);
                while ($bolumler = mysqli_fetch_array($bolum_result)) {
                  echo '<option>' . $bolumler["bolumAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label><b>Kazanımları:</b></label>
              <textarea class="md-textarea form-control" rows="8" name="dersKazanim" required></textarea>
            </div>
            <button type="submit" class="btn btn-info">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLectureEdit">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Düzenle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="editLecture.php" method="post">
            <div class="form-group">
              <label><b>Ders Kodu:</b></label>
              <input id="dersKoduID" type="text" class="form-control" name="dersKodu" required>
              <input id="oldDersKoduID" type="hidden" class="form-control" name="oldDersKodu" value="">
            </div>
            <div class="form-group">
              <label><b>Ders Adı:</b></label>
              <input id="dersAdiID" type="text" class="form-control" name="dersAdi" required>
            </div>
            <div class="form-group">
              <label>Bölüm:</label>
              <select class="form-control" name="bolumAdi" id="bolumAdiID">
                <?php
                $bolum_query = "select * from bolum;";
                $bolum_result = $conn->query($bolum_query);
                while ($bolumler = mysqli_fetch_array($bolum_result)) {
                  echo '<option>' . $bolumler["bolumAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label><b>Kazanımları:</b></label>
              <textarea id="dersKazanimID" class="md-textarea form-control" rows="8" name="dersKazanim"></textarea>
            </div>
            <button type="submit" class="btn btn-info">Kaydet</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete -->
  <div class="modal fade" id="modalDeleteLecture">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Sil</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="whichLecture"></label>
          adlı dersi silmek istediğinize emin misiniz ?
          <form action="deleteLecture.php" method="post">
            <button type="submit" class="btn btn-danger">Evet</button>
            <input id="deleteLectureID" type="hidden" class="form-control" name="dersKodu" value="">
          </form>
          <form>
            <button type="close" class="btn btn-info">Hayır</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalDersKazanim">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Kazanımları</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="showDersKazanimID"></label>
          <form>
            <button type="close" class="btn btn-info">Tamam</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>