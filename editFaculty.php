<?php
include "dataBaseInfo.php"; 
if(isset($_POST["oldfakulteNo"]))
{
    $old_fakulteNo = $_POST["oldfakulteNo"];
    $new_fakulteNo = $_POST["fakulteNo"];
    $fakulteAdi = $_POST["fakulteAdi"];
    $edit_faculty_query="update fakulte set fakulteNo=$new_fakulteNo,fakulteAdi='$fakulteAdi' where fakulteNo=$old_fakulteNo;";
    $editFaculty = $conn->query($edit_faculty_query);
    header("Location: fakulteler.php");
}
?>