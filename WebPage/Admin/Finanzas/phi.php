<?php

if(isset($_POST['registerEmployee'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Finanzas/Caja/PhiSeal.php ");
}
if(isset($_POST['registerClient'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Finanzas/Caja/PhiBuy.php ");
}
?>