<?php
include_once '../../../../Php/SessionFunctions/user_session.php';
include_once '../../../../Php/SessionFunctions/buyout.php';
$buyout = new Buyout();
$userSession = new UserSession();
if (isset($_POST['SealCreate'])) {
    $id = $_POST['seaId'];
    $date = $_POST['seaDate'];
    $fee = 0.0;
    $boleta = $_POST['tMetodo'];
    $idC = substr($_POST['tCliente'],0,1);
    $idE = $_POST['tUser'];
    $sql = "INSERT INTO buyout VALUES ('$id', '$date', '$boleta', '$idC', '$idE');";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        $userSession->setCurrentBuyout($id);
        header('location: PhiSeal.php');  
    }
}

if (isset($_POST['proInsert'])) {
    $idbuy = $userSession->getCurrentBuyout();
    $idP = substr($_POST['idProduct'],0,1);
    $cdt = $_POST['proCantity'];
    $cost = $_POST['proCost'];
    $sql = "INSERT INTO detailbuyout VALUES ('$idbuy','$idP','$cost','$cdt')";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        header('location: PhiBuy.php');  
    }
}

if (isset($_POST['proDelete'])) {
    $idsea = $_POST['proId2'];
    $idpro = $_POST['proId22'];
    $sql = "DELETE FROM detailbuyout WHERE buyId = $idsea AND proId = $idpro";
    $con=mysqli_connect("localhost","root","","bd_farm");
    $exe = mysqli_query($con, $sql);
    if ($exe) {
        header('location: PhiBuy.php');  
    }
}

if (isset($_POST['EndStore'])){
    $idUse = $userSession->getCurrentUser();
    $userSession->closeSession(); 
    $userSession->setCurrentUser($idUse);
    header('location: PhiBuy.php'); 
}
?>