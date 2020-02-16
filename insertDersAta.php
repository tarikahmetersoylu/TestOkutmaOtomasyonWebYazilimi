<?php
include "dataBaseInfo.php";
if(isset($_POST["ders"]) && isset($_POST["bolumAdi"])&&isset($_POST["ogretimUye"]) &&isset($_POST["donemAdi"]))
{
    $dersKodu = getCode($_POST["ders"]);
    $bolumAdi=$_POST["bolumAdi"];
    $ogretimUye_sicilNo = getCode($_POST["ogretimUye"]);
    $donemAdi = $_POST["donemAdi"];

    $bolum_query = "select * from dersler where dersKodu='$dersKodu'";
    $bolum_result = $conn->query($bolum_query);
    $bolum = mysqli_fetch_array($bolum_result);
    $bolumNo = $bolum["bolumNo"];

    $donem_query = "select * from donem where donemAdi = '$donemAdi'";
    $donem_result = $conn->query($donem_query);
    $donem = mysqli_fetch_array($donem_result);
    $donemId = $donem["donemId"];

    $insert_query = "insert into dersAtama(dersKodu,bolumNo,sicilNo,donemId) values ('$dersKodu',$bolumNo,$ogretimUye_sicilNo,$donemId);";
    $insert = $conn->query($insert_query);
    header("Location: dersAtama.php");
}
else
{
    echo 'post edilmedi';
}
function getCode($string)
{
    $code = explode(" - ",$string);
    return $code[0];
}
?>