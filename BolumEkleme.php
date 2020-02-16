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
  <title>BÖLÜMLER</title>
  <?php
    include "dataBaseInfo.php";
    if (isset($_POST['fakulteAdi']) && isset($_POST['bolumNo']) && isset($_POST['bolumAdi'])) {
        $control=false; 
        $fakulteAdi = $_POST['fakulteAdi'];
        $bolumNo = $_POST['bolumNo'];
        $bolumAdi = $_POST['bolumAdi'];
        $bolumKazanim = $_POST['bolumKazanim'];
        $fakulteNo_query = "select * from fakulte where fakulteAdi = '$fakulteAdi'";
        $fakulteNo_result = $conn->query($fakulteNo_query);
        $fakulte = mysqli_fetch_array($fakulteNo_result);
        $fakulteNo = $fakulte['fakulteNo'];
        $bolumNo = $fakulteNo . $bolumNo;
        $control_query = "select bolumNo from bolum";
        $control_bolum = $conn->query($control_query);
        while($control_bolumNo = mysqli_fetch_array($control_bolum))
        {
            if($control_bolumNo["bolumNo"] == $bolumNo)
            {
                echo '<script>alert("Bu bölüm numarasına sahip bir bölüm zaten mevcut.");</script>';
                $control=True;
            }
        }
        if(!$control){
          $add_query = "insert into bolum(fakulteNo,bolumNo,bolumAdi,bolumKazanim) values ($fakulteNo,$bolumNo,'$bolumAdi','$bolumKazanim');";
          $result = $conn->query($add_query);
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
    $query = "select bolumNo,bolumAdi,bolumKazanim,(select fakulteAdi from fakulte where fakulteNo = bolum.fakulteNo) as fakulteAdi from bolum";
    $result = $conn->query($query);
    echo $leftMenu;
    ?>
    <div id="Icerik">
      <div id="GenelTabloSinirlamaAlani">
        <div class="col-md-12">

          <h3 class="title-5 m-b-35">BÖLÜM BİLGİLERİ</h3>
          <div class="table-data__tool">

            <div class="table-data__tool-right">
              <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalBolumEkle"><i class="zmdi zmdi-plus"></i>Yeni Bölüm Ekle</button>
            </div>
          </div>
          <div class="table-responsive table-responsive-data2">
            <table id="TabloSinirlamaAlani" class="table table-data2">
              <thead>
                <tr>
                  <th>Bölüm Kodu</th>
                  <th>Bölüm Adı</th>
                  <th>Fakülte Adı</th>
                  <th>Program Kazanımları</th>
                  <th>Düzenle</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($bolum = mysqli_fetch_array($result)) {
                  echo '<tr class="tr-shadow">
                <td >' . $bolum["bolumNo"] . '</td>
                
                <td class="status--process"> ' . $bolum["bolumAdi"] . ' </td>
                
                <td>' . $bolum["fakulteAdi"] . '</td>
                
                <td><button onclick="showKazanim(`'.$bolum["bolumKazanim"].'`)" class="au-btn au-btn-icon au-btn--darkseagreen au-btn--small" data-toggle="modal" data-target="#modalKazanim">Göster</button></td>
                <td>
                  <div class="table-data-feature">
                    <button onclick="depEdit(' . $bolum["bolumNo"] . ',`' . ($bolum["bolumAdi"]) . '`,`' . $bolum["fakulteAdi"] . '`)" data-target="#myModalDepEdit" data-toggle="modal" class="item" data-toggle="tooltip" data-placement="top" title="Güncelle" data-original-title="Edit">
                      <i class="zmdi zmdi-edit"></i>
                    </button>
                    <button onclick="deleteDepartment(`' . ($bolum["bolumAdi"]) . '`)" data-target = "#myModalDelete" data-toggle="modal" class="item" data-toggle="tooltip" data-placement="top" title="Sil" data-original-title="Delete">
                      <i class="zmdi zmdi-delete"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr class="spacer"></tr>';
                }
                ?>
                <script>
                  function depEdit(bolumNo, bolumAdi, fakulteAdi) {
                    getDepName(bolumNo, bolumAdi, fakulteAdi);
                  }

                  function getDepName(bolumNo, bolumAdi, fakulteAdi) {
                    document.getElementById("bolumNoID").value = bolumNo;
                    document.getElementById("oldBolumNoID").value = bolumNo;
                    document.getElementById("bolumAdiID").value = bolumAdi;
                    document.getElementById("editFacultyName").value = fakulteAdi;
                  }

                  function deleteDepartment(bolumAdi) {
                    document.getElementById("deleteBolumAdiID").value = bolumAdi;
                    document.getElementById("whichDep").innerHTML = bolumAdi;
                  }

                  function showKazanim(kazanim) {
                    document.getElementById("showBolumKazanimID").innerHTML = kazanim;
                  }
                </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalBolumEkle">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bölüm Ekle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="BolumEkleme.php" method="post">
            <div class="form-group">
              <label><b>Bölüm No:</b></label>
              <input type="text" class="form-control" name="bolumNo" required>
            </div>
            <div class="form-group">
              <label><b>Bölüm Adı:</b></label>
              <input type="text" class="form-control" name="bolumAdi" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Fakülte:</label>
              <select class="form-control" name="fakulteAdi">
                <?php
                $fakulte_query = "select * from fakulte;";
                $fakulte_result = $conn->query($fakulte_query);
                while ($fakulteler = mysqli_fetch_array($fakulte_result)) {
                  echo '<option>' . $fakulteler['fakulteAdi'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label><b>Kazanımları:</b></label>
              <textarea id="bolumKazanimID" class="md-textarea form-control" rows="8" name = "bolumKazanim" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ekle</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Department Edit Modal -->
  <div class="modal fade" id="myModalDepEdit">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bölüm Düzenle</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="editDepartment.php" method="post">
            <div class="form-group">
              <label><b>Bölüm No:</b></label>
              <input id="oldBolumNoID" type="hidden" class="form-control" name="oldBolumNo" value="">
              <input id="bolumNoID" type="text" class="form-control" name="bolumNo" required>
            </div>
            <div class="form-group">
              <label><b>Bölüm Adı:</b></label>
              <input id="bolumAdiID" type="text" class="form-control" name="bolumAdi" required>
            </div>
            <div class="form-group">
              <label>Fakülte:</label>
              <select class="form-control" name="fakulteAdi" id="editFacultyName">
                <?php
                $fakulte_query = "select * from fakulte;";
                $fakulte_result = $conn->query($fakulte_query);
                while ($fakulteler = mysqli_fetch_array($fakulte_result)) {
                  echo '<option>' . $fakulteler['fakulteAdi'] . '</option>';
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Modal-->
  <div class="modal fade" id="myModalDelete">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bölüm Sil</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="whichDep"></label>
          bölümünü silmek istediğinize emin misiniz ?
          <form action="deleteDepartment.php" method="post">
            <button type="submit" class="btn btn-danger">Evet</button>
            <input id="deleteBolumAdiID" type="hidden" class="form-control" name="bolumAdi" value="">
          </form>
          <form>
            <button type="close" class="btn btn-info">Hayır</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalKazanim">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bölüm Kazanımları</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <label id="showBolumKazanimID"></label>
          <form>
            <button type="close" class="btn btn-info">Tamam</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>