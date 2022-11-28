<?php
    if (isset($_POST['labEdit'])) {
        $id2 = $_POST['empId2'];
        $dni2 = $_POST['empDNI2'];
        $empname2 = $_POST['empName2'];
        $emplastname2 = $_POST['empLastName2'];
        $sql = "UPDATE lab SET labName = '$dni2', labAddress = '$empname2', labPhonr = '$emplastname2' WHERE labId = '$id2'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroLaboratorios.php');    
        }else{
            header('location: RegistroUsuarios.php');  
        }
    }

    if(isset($_POST['labDelete'])){
        $id = $_POST['empId2'];
        $sql = "DELETE FROM lab WHERE labId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroLaboratorios.php');    
        }
    }
    if (isset($_POST['linkPL'])) {
        $idU = substr($_POST['idPro'],0,1);
        $idE = substr($_POST['idLab'],0,1);
        $sql = "UPDATE product SET labId = '$idE' WHERE proId = '$idU'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroLaboratorios.php');    
        }
    }
?>