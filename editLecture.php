<?php
include "dataBaseInfo.php"; 
if(isset($_POST["oldDersKodu"])&& isset($_POST["dersKodu"]))
{
    $old_dersKodu = $_POST["oldDersKodu"];
    $new_dersKodu = $_POST["dersKodu"];
    $dersAdi = $_POST["dersAdi"];
    $bolumAdi = $_POST["bolumAdi"];
    $bolum_query = "select * from bolum where bolumAdi='$bolumAdi'";
    $bolum_result = $conn->query($bolum_query);
    $bolum = mysqli_fetch_array($bolum_result);
    $bolumNo = $bolum["bolumNo"];
    $dersKazanim = $_POST["dersKazanim"];
    $edit_ders_query="update dersler set dersKodu='$new_dersKodu',dersAdi='$dersAdi',bolumNo=$bolumNo,dersKazanim='$dersKazanim' where dersKodu=$old_dersKodu;";
    $editDers = $conn->query($edit_ders_query);
    header("Location: dersler.php");
}
else echo 'post hatası';
?>