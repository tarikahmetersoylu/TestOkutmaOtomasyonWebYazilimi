<?php
    include "dataBaseInfo.php";
    if (isset($_POST['fakulteNo'])) {
        $fakulteNo=$_POST["fakulteNo"];
        $fakulteAdi = $_POST['fakulteAdi'];
        $conn = new mysqli($servername, $user, $pass, $dbname);
        $control_query = "select * from fakulte";
        $controlEt=$conn->query($control_query);
        while($fakulteler = mysqli_fetch_array($controlEt))
        {
            if($fakulteler["fakulteNo"] == $fakulteNo)
            {

            }
            else{
                $insert_query="insert into fakulte(fakulteNo,fakulteAdi) values ($fakulteNo,'$fakulteAdi');";
                $insert = $conn->query($insert_query);
            }
        }
        header("Location: fakulteler.php");
    } 
    else {
        echo 'post edilmedi';
    }
?>