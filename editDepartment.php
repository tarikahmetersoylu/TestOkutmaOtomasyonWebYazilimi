<?php
include "dataBaseInfo.php"; 
if(isset($_POST["oldBolumNo"])&& isset($_POST["bolumNo"]))
{
    $old_bolumNo = $_POST["oldBolumNo"];
    $new_bolumNo = $_POST["bolumNo"];
    $bolumAdi = $_POST["bolumAdi"];
    $fakulteAdi = $_POST["fakulteAdi"];
    $fakulteNo_query = "select * from fakulte where fakulteAdi = '$fakulteAdi'";
    $getfakulteNo = $conn->query($fakulteNo_query);
    $fakulte = mysqli_fetch_array($getfakulteNo);
    $fakulteNo=$fakulte["fakulteNo"];
    $edit_dep_query="update bolum set bolumNo=$new_bolumNo,bolumAdi='$bolumAdi',fakulteNo='$fakulteNo' where bolumNo=$old_bolumNo;";
    $edit_Dep = $conn->query($edit_dep_query);
    header("Location: BolumEkleme.php");
}
else echo 'post hatası';
?>