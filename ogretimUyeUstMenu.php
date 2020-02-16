<?php
if (!isset($_SESSION)) {

	session_start();
}
$sicilNo = $_SESSION['glbogretimUye']['sicilNo'];
$ustMenu = '<div id="Header1">
<div id="HeaderSinirlamaAlani1">
    <div>
        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" style="float:right; margin-top:12px; margin-right:10px;">
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <ul class="acilirMenuUl">
                <li class="acilirMenuItemi" style="text-align:center;"><a class="dropdown-item" href="#"><img src="avatar5.png" alt="kullanıcıLogo" class="img-circle" style="width:33px; height:33px; border-radius:50%;  line-height:1.5;"><span style="padding-left:6px;"> '. $_SESSION["glbogretimUye"]["adi"] . "  ". $_SESSION["glbogretimUye"]["soyadi"] . '</span></a></li>
                <li class="acilirMenuItemi"><a class="dropdown-item" href="ogretimUyesiDersBilgileriPhp.php">Dersler</a></li>
                <div class="dropdown-divider" style="margin:0; padding:0;"></div>
                <li class="acilirMenuItemi"><a class="dropdown-item" href="adminLogin.php">Çıkış</a></li>
            </ul>
        </div>
    </div>
    <img src="avatar5.png" alt="kullanıcıLogo" class="img-circle" style="max-width:50px; height:47px;  margin:5px; border-radius:50%; float:right; cursor:pointer;">
</div>
</div>';
?>