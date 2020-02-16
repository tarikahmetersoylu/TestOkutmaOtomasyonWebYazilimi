<?php
include "dataBaseInfo.php"; 
if(isset($_POST["dersKodu"]))
{
    $dersKodu = $_POST["dersKodu"];
    $deleteDers_query="delete from dersler where dersKodu = $dersKodu;";
    $delete = $conn->query($deleteDers_query);
    header("Location: dersler.php");
}
?>