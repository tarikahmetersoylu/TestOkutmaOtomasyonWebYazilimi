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

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->
</head>
<script>
  function dersAtaSelectBolumChange() {

  }

  function dersleriListele() {
    document.getElementById("dersAtaDerslerID").options.length = 0;
    var x = document.getElementById("dersAtaDerslerID");
    var option = document.createElement("option");
    option.text = "Dersler";
    x.add(option);
  }
</script>

<body onresize="test()" onLoad="yenile()">
  <div id="TumSayfa" onClick="kapat()">
    <?php
    include "dataBaseInfo.php";
    include "leftMenu.php";
    echo $leftMenu;

    $dersAta_query = "select (select dersKodu from dersler where dersKodu = dersAtama.dersKodu)as dersKodu, (select dersAdi from dersler where dersKodu = dersAtama.dersKodu) as dersAdi,(select bolumAdi from bolum where bolumNo = dersAtama.bolumNo) as bolumAdi,(select concat_ws(' ',adi,soyadi) from ogretimUye where sicilNo=dersAtama.sicilNo) as adi,(select sicilNo from ogretimUye where sicilNo=dersAtama.sicilNo) as sicilNo,(select donemAdi from donem where donemId=dersAtama.donemId) as donemAdi from dersAtama;";
    $dersAta_result = $conn->query($dersAta_query);

    $dersler_query = "select * from dersler";
    $bolumler_query = "select * from bolum";
    $ogretimUye_query = "select * from ogretimUye";
    $donem_query = "select * from donem";
    $dersler_result = $conn->query($dersler_query);

    $bolumler_result = $conn->query($bolumler_query);

    $ogretimUye_result = $conn->query($ogretimUye_query);

    $donem_result = $conn->query($donem_query);
    ?>
    <div id="Icerik">
      <div id="GenelTabloSinirlamaAlani">
        <div class="col-md-12">

          <h3 class="title-5 m-b-35">Atanan Dersler</h3>
          <div class="table-data__tool">

            <div class="table-data__tool-right">
              <button data-target="#modalDersATA" data-toggle="modal" class="au-btn au-btn-icon au-btn--green au-btn--small"><i class="zmdi zmdi-plus"></i>Ders Ata</button>
            </div>
          </div>
          <div class="table-responsive table-responsive-data2">
            <table id="TabloSinirlamaAlani" class="table table-data2">
              <thead>
                <tr>
                  <th>Ders Adı</th>
                  <th>Bölümü</th>
                  <th>Öğretmen</th>
                  <th>Dönemi</th>
                  <th>Düzenle</th>
                  <th>Sınavı Okut</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($atananDersler = mysqli_fetch_array($dersAta_result)) {
                  echo '
                        <tr class="tr-shadow">
                          <td>' . $atananDersler["dersAdi"] . '</td>
                          <td>' . $atananDersler["bolumAdi"] . '</td>
                          <td>' . $atananDersler["adi"] . '</td>
                          <td>' . $atananDersler["donemAdi"] . '</td>
                          <td>
                            <div class="table-data-feature">
                              <button onclick="editDers(`' . $atananDersler["dersKodu"] . '`,`' . $atananDersler["dersAdi"] . '`,`' . $atananDersler["bolumAdi"] . '`,`' . $atananDersler["sicilNo"] . ' - ' . $atananDersler["adi"] . '`,`' . $atananDersler["donemAdi"] . '`)" data-toggle="modal" data-target="#modalEditDersAta" class="item" data-toggle="tooltip" data-placement="top" title="Güncelle" data-original-title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                              </button>
                              <button onclick="deleteDers(`' . $atananDersler["dersKodu"] . '`,`' . $atananDersler["dersAdi"] . '`)" data-toggle="modal" data-target="#modalDeleteAtananDers" class="item" data-toggle="tooltip" data-placement="top" title="Sil" data-original-title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                              </button>
                            </div>
                          </td>
                          <td>
                          <form method="POST" action="adminTestOkut.php">
                          <input type="hidden" name="dersAdiName"  value="' . $atananDersler["dersAdi"] . '">
                          <input type="hidden" name="bolumAdiName" value="' . $atananDersler["bolumAdi"] . '">
                          <input type="hidden" name="donemName" value="' . $atananDersler["donemAdi"] . '">
                          <button onclick="" class="au-btn au-btn-icon au-btn--darkseagreen au-btn--small">
                            Sınavı Okut
                          </button>
                          </form>
                          </td>
                        </tr>
                        <tr class="spacer"></tr>';
                }
                ?>
                <script>
                  function editDers(dersKodu, dersAdi, bolumAdi, ogretimUye, donem) {
                    document.getElementById("dersKoduID").value = dersKodu;
                    document.getElementById("whichDers").innerHTML = dersAdi;
                    document.getElementById("bolumSelectID").value = bolumAdi;
                    document.getElementById("ogretimUyeSelectID").value = ogretimUye;
                    document.getElementById("donemSelectID").value = donem;
                  }

                  function deleteDers(dersKodu, dersAdi) {
                    document.getElementById("whichLecture").innerHTML = dersAdi;
                    document.getElementById("deleteAtananDersID").value = dersKodu;
                  }
                </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDersATA">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Atama</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form action="insertDersAta.php" method="post">
            <div class="form-group">
              <label>Ders Kodu - Adı:</label>
              <select class="form-control" name="ders" id="dersAtaDerslerID">
                <?php
                while ($dersler = mysqli_fetch_array($dersler_result)) {
                  echo '<option>' . $dersler["dersKodu"] . " - " . $dersler["dersAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
           
            <div class="form-group">
              <label>Öğretim Görevlisi Kodu - Adı:</label>
              <select class="form-control" name="ogretimUye">
                <?php
                while ($ogretimUyeleri = mysqli_fetch_array($ogretimUye_result)) {
                  echo '<option>' . $ogretimUyeleri["sicilNo"] . " - " . $ogretimUyeleri["adi"] . " " . $ogretimUyeleri["soyadi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Dönem:</label>
              <select class="form-control" name="donemAdi">
                <?php
                while ($donemler = mysqli_fetch_array($donem_result)) {
                  echo '<option>' . $donemler["donemAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <button onclick="" type="submit" class="btn btn-info">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEditDersAta">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ders Düzenleme</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form action="editDersAta.php" method="post">
            <div class="form-group">
              <label id="whichDers"></label> adlı dersi Düzenliyorsunuz.
              <input type="hidden" id="dersKoduID" name="dersKodu" value="" required>
            </div>
            <div class="form-group">
              <label>Bölümü:</label>
              <select class="form-control" name="bolumAdi" id="bolumSelectID">
                <?php
                $bolumler_result = $conn->query($bolumler_query);
                while ($bolumler = mysqli_fetch_array($bolumler_result)) {
                  echo '<option>' . $bolumler["bolumAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Öğretim Görevlisi Kodu - Adı:</label>
              <select class="form-control" name="ogretimUye" id="ogretimUyeSelectID">
                <?php
                $ogretimUye_result = $conn->query($ogretimUye_query);
                while ($ogretimUyeleri = mysqli_fetch_array($ogretimUye_result)) {
                  echo '<option>' . $ogretimUyeleri["sicilNo"] . " - " . $ogretimUyeleri["adi"] . " " . $ogretimUyeleri["soyadi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Dönem:</label>
              <select class="form-control" name="donemAdi" id="donemSelectID">
                <?php
                $donem_result = $conn->query($donem_query);
                while ($donemler = mysqli_fetch_array($donem_result)) {
                  echo '<option>' . $donemler["donemAdi"] . '</option>';
                }
                ?>
              </select>
            </div>
            <button onclick="" type="submit" class="btn btn-info">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDeleteAtananDers">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Dersi Kaldır</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="whichLecture"></label>
          adlı dersi kaldırmak istediğinize emin misiniz?
          <form action="deleteAtananDers.php" method="post">
            <button type="submit" class="btn btn-danger">Evet</button>
            <input id="deleteAtananDersID" type="hidden" class="form-control" name="dersKodu" value="">
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