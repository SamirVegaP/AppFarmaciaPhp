<?php
    if (isset($_POST['cliEdit'])) {
        $id2 = $_POST['empId2'];
        $dni2 = $_POST['empDNI2'];
        $empname2 = $_POST['empName2'];
        $emplastname2 = $_POST['empLastName2'];
        $empgender2 = $_POST['empGender2'];
        $ruc = $_POST['empRUC2'];
        $empaddress2 = $_POST['empAddress2'];
        $empphone2 = $_POST['empPhone2'];
        $email = $_POST['empEmail2'];
        $sql = "UPDATE client SET cliDNI = '$dni2', cliName = '$empname2', cliLastName = '$emplastname2', cliGender = '$empgender2', cliRUC = '$ruc', cliAddress = '$empaddress2', cliPhone = '$empphone2',  cliEmail = '$email'WHERE cliId = '$id2'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroClientes.php');    
        }else{
            header('location: RegistroUsuarios.php');  
        }
    }

    if(isset($_POST['cliDelete'])){
        $id = $_POST['empId2'];
        $sql = "DELETE FROM client WHERE cliId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroClientes.php');    
        }
    }
?>