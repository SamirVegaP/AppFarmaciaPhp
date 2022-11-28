<?php
    if (isset($_POST['supEdit'])) {
        $id2 = $_POST['supId2'];
        $ruc = $_POST['supRUC2'];
        $supname2 = $_POST['supName2'];
        $supaddress2 = $_POST['supAddress2'];
        $supphone2 = $_POST['supPhone2'];
        $bank = $_POST['supBank2'];
        $account = $_POST['supAccount2'];
        $sql = "UPDATE supplier SET supRUC = '$ruc', supName = '$supname2', supAddress = '$supaddress2', supPhone = '$supphone2', supBank = '$bank', supAccount = '$account' WHERE supId = '$id2'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroProveedores.php');    
        }else{
            header('location: RegistroProveedores.php');  
        }
    }

    if(isset($_POST['supDelete'])){
        $id = $_POST['supId2'];
        $sql = "DELETE FROM supplier WHERE cliId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroClientes.php');    
        }
    }
?>