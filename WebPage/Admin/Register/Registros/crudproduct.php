<?php
    if (isset($_POST['cliEdit'])) {
        $id2 = $_POST['empId2'];
        $name2 = $_POST['empDNI2'];
        $concen2 = $_POST['empName2'];
        $cost2 = $_POST['empLastName2'];
        $sn2 = $_POST['empGender2'];
        $exp = $_POST['empRUC2'];
        $pres2 = $_POST['empAddress2'];
        $sql = "UPDATE product SET proName = '$name2', proConcentracion = '$concen2', proCost = '$cost2', proSanRegistration = '$sn2', proExpiration = '$exp', proPresentation = '$pres2',  labId = '0' WHERE proId = '$id2'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroProductos.php');    
        }else{
            header('location: RegistroUsuarios.php');  
        }
    }

    if(isset($_POST['cliDelete'])){
        $id = $_POST['empId2'];
        $sql = "DELETE FROM product WHERE proId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroProductos.php');    
        }
    }
?>