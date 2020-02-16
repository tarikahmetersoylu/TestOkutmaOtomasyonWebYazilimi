<?php
include "dataBaseInfo.php";
    if(isset($_POST["dersKodu"]))
    {
        $dersKodu = $_POST["dersKodu"];
        $delete_query = "delete from dersAtama where dersKodu = '$dersKodu'";
        $delete = $conn->query($delete_query);
        header("Location: dersAtama.php");
    }
    else{
        echo 'post edilmedi';
    }
?>