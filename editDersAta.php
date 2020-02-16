<?php
include "dataBaseInfo.php"; 
if(isset($_POST["dersKodu"]))
{
    $dersKodu = $_POST["dersKodu"];
    $bolumAdi = $_POST["bolumAdi"];
    $ogretimUye_sicilNo = getCode($_POST["ogretimUye"]);
    $donemAdi =$_POST["donemAdi"];

    $donemId_query = "select * from donem where donemAdi = '$donemAdi'";
    $donem_result = $conn->query($donemId_query);
    $donem = mysqli_fetch_array($donem_result);

    $bolum_query = "select * from bolum where bolumAdi = '$bolumAdi'";
    $bolum_result = $conn->query($bolum_query);
    $bolum = mysqli_fetch_array($bolum_result);

    $donemId=$donem["donemId"];
    $bolumNo=$bolum["bolumNo"];

    $edit_atananDers_query="update dersAtama set bolumNo='$bolumNo',sicilNo = '$ogretimUye_sicilNo',donemId='$donemId' where dersKodu='$dersKodu'";
    $editAtananDers = $conn->query($edit_atananDers_query);
    header("Location: dersAtama.php");
}
else {

    echo 'post hatası';
}

function getCode($string)
{
    $code = explode(" - ",$string);
    return $code[0];
}
?>