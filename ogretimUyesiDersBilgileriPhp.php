<?php
include "dataBaseInfo.php";
include "ogretimUyeUstMenu.php";
$dersler_query = "select (select dersAdi from dersler where dersKodu = dersAtama.dersKodu) as dersAdi,(select bolumAdi from bolum where bolumNo = dersAtama.bolumNo) as bolumAdi,(select donemAdi from donem where donemId=dersAtama.donemId) as donemId from dersAtama where sicilNo = $sicilNo";
$dersler = $conn->query($dersler_query);
?>
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
    <link href="ogretimUyesiAnaSayfaCss.css" rel="stylesheet">
    <link href="css.css" rel="stylesheet">
    <link href="table.css" rel="stylesheet">

    <title>Kullanıcılar</title>

    <!-- Bootstrap core CSS -->


    <!-- Custom styles for this template -->

</head>

<body>

    <div id="TumSayfa" style="background-color:#E5E5E5;">
        <?php echo $ustMenu ?>
        <div id="GenelTabloSinirlamaAlani">
            <div class="col-md-12">

                <h3 class="title-5 m-b-35">Dersler</h3>
                <div class="table-responsive table-responsive-data2">
                    <table id="TabloSinirlamaAlani" class="table table-data2">
                        <thead>
                            <tr>
                                <th>Ders</th>
                                <th>Bölüm</th>
                                <th>Vize</th>
                                <th>Final</th>
                                <th>Bütünleme</th>
                                <th>Sınav Okut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($o_ders = mysqli_fetch_array($dersler)) {
                                echo '
                                    <tr>
                                        <td>' . $o_ders["dersAdi"] . '</td>
                                        <td>' . $o_ders["bolumAdi"] . '</td>
                                        <td>Vize </td>
                                        <td>Final</td>
                                        <td>Bütünleme</td>
                                        <td>
                                            <form action="ogretimUyesiAnaSayfaPhp.php" method="POST">
                                            <input type="hidden" name="dersAdiName"  value="' . $o_ders["dersAdi"] . '">
                                            <input type="hidden" name="bolumAdiName" value="' . $o_ders["bolumAdi"] . '">
                                            <input type="hidden" name="donemName" value="' . $o_ders["donemId"] . '">
                                                <button onclick="" class="au-btn au-btn-icon au-btn--darkseagreen au-btn--small">
                                                    Sınavı Okut
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</body>

</html>