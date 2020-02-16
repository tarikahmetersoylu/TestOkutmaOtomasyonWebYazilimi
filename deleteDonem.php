<?php
include "dataBaseInfo.php"; 
if(isset($_POST["donemId"]))
{
    $donemId = $_POST["donemId"];
    $deleteDonem_query="delete from donem where donemId = $donemId ;";
    $delete = $conn->query($deleteDonem_query);
    header("Location: donemler.php");
}
?>