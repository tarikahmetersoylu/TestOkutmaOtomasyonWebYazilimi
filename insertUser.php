<?php 
include "dataBaseInfo.php";
    if(isset($_POST["sicilNo"]))
    {
        $sicilNo = $_POST["sicilNo"];
        $adi = $_POST["adi"];
        $soyadi = $_POST["soyadi"];
        $sifre = $_POST["sifre"];
        $conn = new mysqli($servername,$user,$pass,$dbname);
        $insert_query = "insert into ogretimUye(sicilNo,adi,soyadi,sifre) values ($sicilNo,'$adi','$soyadi','$sifre');";
        $insert = $conn->query($insert_query);
        header("Location: kullaniciEkle.php");
    }
?>