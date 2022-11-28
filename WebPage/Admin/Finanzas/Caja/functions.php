<?php
include_once '../../../../Php/SessionFunctions/user_session.php';
include_once '../../../../Php/SessionFunctions/seal.php';
$seal = new Seal();
$userSession = new UserSession();
if (isset($_POST['SealCreate'])) {
    $id = $_POST['seaId'];
    $date = $_POST['seaDate'];
    $fee = 0.0;
    $boleta = $_POST['tBoleta'];
    $idC = substr($_POST['tCliente'],0,1);
    $idE = $_POST['tUser'];
    $sql = "INSERT INTO seal VALUES ('$id', '$date', '$fee', '$boleta', '$idC', '$idE')";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        $userSession->setCurrentSeal($id);
        header('location: PhiSeal.php');  
    }
}

if (isset($_POST['proInsert'])) {
    $idsea = $userSession->getCurrentSeal();
    $idP = substr($_POST['idProduct'],0,1);
    $cdt = $_POST['proCantity'];
    $cost = $_POST['proCost'];
    $sql = "INSERT INTO detailseal VALUES ('$idsea','$idP','$cdt','$cost')";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        header('location: PhiSeal.php');  
    }
}

if (isset($_POST['proDelete'])) {
    $idsea = $_POST['proId2'];
    $idpro = $_POST['proId22'];
    $sql = "DELETE FROM detailseal WHERE seaId = $idsea AND proId = $idpro";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        header('location: PhiSeal.php');  
    }
}

if (isset($_POST['Boleta'])) {
    header("location: http://localhost/SisFarm/WebPage/Admin/Reportes/Reports/BoletadeVenta.php ");
}

if (isset($_POST['EndStore'])){
    $idUse = $userSession->getCurrentUser();
    if (isset($_SESSION['buyout'])) {
        $idBuy = $userSession->getCurrentBuyout();
    }
    $userSession->closeSession(); 
    $otheruS = new UserSession;
    $otheruS -> setCurrentUser($idUse);
    if (isset($_SESSION['buyout'])) {
        $otheruS -> setCurrentBuyout($idBuy);
    }
    header('location: PhiSeal.php'); 
}
?>