<?php 
  include "dataBaseInfo.php"; 
  if(isset($_POST["bolumAdi"]))
  {
      $bolumAdi = $_POST["bolumAdi"];
      $conn = new mysqli($servername,$user,$pass,$dbname);
      $deleteDepartment="delete from bolum where bolumAdi='$bolumAdi';";
      $delete = $conn->query($deleteDepartment);
      header("Location: BolumEkleme.php");
  }
?>