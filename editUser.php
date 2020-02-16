<?php
include "dataBaseInfo.php"; 
if(isset($_POST["oldsicilNo"]))
{
    $old_sicilNo = $_POST["oldsicilNo"];
    $new_sicilNo = $_POST["sicilNo"];
    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $sifre = $_POST["sifre"];

    $conn = new mysqli($servername,$user,$pass,$dbname);

    $edit_user_query="update ogretimUye set sicilNo=$new_sicilNo,adi='$adi',soyadi='$soyadi',sifre='$sifre' where sicilNo=$old_sicilNo;";
    $editUser = $conn->query($edit_user_query);
    header("Location: kullaniciEkle.php");
}
?>