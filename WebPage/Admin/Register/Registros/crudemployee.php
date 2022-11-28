<?php
    if (isset($_POST['empEdit'])) {
        $id2 = $_POST['empId2'];
        $dni2 = $_POST['empDNI2'];
        $empname2 = $_POST['empName2'];
        $emplastname2 = $_POST['empLastName2'];
        $emprol2 = $_POST['empRol2'];
        $empgender2 = $_POST['empGender2'];
        $empphone2 = $_POST['empPhone2'];
        $empaddress2 = $_POST['empAddress2'];
        $et2 = $_POST['empEntryTime2'];
        $dt2 = $_POST['empDepartureTime2'];
        $empsalary2 = $_POST['empSalary2'];
        $sql = "UPDATE employee SET empDNI = '$dni2', empName = '$empname2', empLastName = '$emplastname2', empRol = '$emprol2', empGender = '$empgender2', empPhone = '$empphone2', empAddress = '$empaddress2', empEntryTime = '$et2', empDepartureTime = '$dt2', empSalary = '$empsalary2' WHERE empId = '$id2'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroEmpleados.php');    
        }else{
            header('location: RegistroUsuarios.php');  
        }
    }

    if(isset($_POST['empDelete'])){
        $id = $_POST['empId2'];
        $sql = "DELETE FROM employee WHERE empId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroEmpleados.php');    
        }
    }
?>