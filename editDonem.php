<?php
include "dataBaseInfo.php"; 
if(isset($_POST["oldDonemId"])&& isset($_POST["donemId"]))
{
    $old_donemId = $_POST["oldDonemId"];
    $new_donemId = $_POST["donemId"];
    $donemAdi = $_POST["donemAdi"];
    $edit_donem_query="update donem set donemId=$new_donemId,donemAdi='$donemAdi' where donemId=$old_donemId;";
    $editDonem = $conn->query($edit_donem_query);
    header("Location: donemler.php");
}
else echo 'post hatası';
?>