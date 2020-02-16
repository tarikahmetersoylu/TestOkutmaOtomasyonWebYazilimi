<?php
include "dataBaseInfo.php";
if (isset($_POST['dersKodu']) && isset($_POST["dersAdi"]) && isset($_POST["bolumAdi"])) {
    $dersKodu = $_POST["dersKodu"];
    $dersAdi = $_POST["dersAdi"];
    $bolumAdi = $_POST["bolumAdi"];
    $bolum_query = "select * from bolum where bolumAdi='$bolumAdi'";
    $bolum_result = $conn->query($bolum_query);
    $bolum = mysqli_fetch_array($bolum_result);
    $bolumNo = $bolum["bolumNo"];
    $dersKazanim = $_POST["dersKazanim"];
    $dersKodu = strval($bolumNo) . $dersKodu;

    $control_query = "select dersKodu from dersler";
    $control_dersler = $conn->query($control_query);
    while($control_dersKodu = mysqli_fetch_array($control_dersler))
    {
        if($control_dersKodu["dersKodu"] == $dersKodu)
        {
            echo '<script>alert("Bu koda ait bir ders zaten mevcut.");</script>';
            break;
        }
        else
        {
            $insert_query = "insert into dersler(dersKodu,dersAdi,bolumNo,dersKazanim) values ('$dersKodu','$dersAdi',$bolumNo,'$dersKazanim');";
            $insert = $conn->query($insert_query);
            break;
        }
    }
}
    ?>