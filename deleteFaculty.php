<?php 
  include "dataBaseInfo.php"; 
  if(isset($_POST["fakulteNo"]))
  {
      $fakulteNo = $_POST["fakulteNo"];
      $conn = new mysqli($servername,$user,$pass,$dbname);
      $deleteFaculty="delete from fakulte where fakulteNo='$fakulteNo';";
      $delete = $conn->query($deleteFaculty);
      header("Location: fakulteler.php");
  }
?>