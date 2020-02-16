<?php
include "dataBaseInfo.php"; 
if(isset($_POST["sicilNo"]))
{
    $sicilNo = $_POST["sicilNo"];
    $conn = new mysqli($servername,$user,$pass,$dbname);
    $deleteUser_query="delete from ogretimUye where sicilNo = $sicilNo ;";
    $delete = $conn->query($deleteUser_query);
    header("Location: kullaniciEkle.php");
}
?>