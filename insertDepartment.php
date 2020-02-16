<?php
    include "dataBaseInfo.php";
    if (isset($_POST['fakulteAdi'])) {
        $fakulteAdi = $_POST['fakulteAdi'];
        $bolumNo = $_POST['bolumNo'];
        $bolumAdi = $_POST['bolumAdi'];
        $bolumKazanim = $_POST['bolumKazanim'];
        $fakulteNo_query = "select * from fakulte where fakulteAdi = '$fakulteAdi'";
        $fakulteNo_result = $conn->query($fakulteNo_query);
        $fakulte = mysqli_fetch_array($fakulteNo_result);
        $fakulteNo = $fakulte['fakulteNo'];
        $bolumNo = $fakulteNo . $bolumNo;
        $control_query = "select bolumNo from bolum";
        $control_bolum = $conn->query($control_query);
        while($control_bolumNo = mysqli_fetch_array($control_bolum))
        {
            if($control_bolumNo["bolumNo"]==$bolumNo)
            {
                echo '<script>alert("Bu bölüm numarasına sahip bir bölüm zaten mevcut.")</script>';
            }
            else{
                $add_query = "insert into bolum(fakulteNo,bolumNo,bolumAdi,bolumKazanim) values ($fakulteNo,$bolumNo,'$bolumAdi','$bolumKazanim');";
                $result = $conn->query($add_query);
            }
        }
    } 
    ?>