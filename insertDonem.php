<?php
include "dataBaseInfo.php";
if (isset($_POST['donemId'])) {
    $donemId = $_POST["donemId"];
    $donemAdi = $_POST["donemAdi"];
    $control_query = "select donemId from donem";
    $control_donem = $conn->query($control_query);
    while($control_donemID = mysqli_fetch_array($control_donem))
    {
        if($control_donemID["donemId"] == $donemId)
        {
            echo '<script>alert("Bu donem Koduna ait bir dönem zaten mevcutç")</script>';
        }
        else{
            $insert_query = "insert into donem(donemId,donemAdi) values ($donemId,'$donemAdi');";
            $insert = $conn->query($insert_query);
        }
    }
} 
?>
