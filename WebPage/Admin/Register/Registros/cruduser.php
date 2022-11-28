<?php
    if (isset($_POST['useEdit'])) {
        $id = $_POST['useId'];
        $dni = $_POST['useDNI'];
        $usename = $_POST['useName'];
        $uselastname = $_POST['useLastName'];
        $usenametag = $_POST['useNametag'];
        $usemail = $_POST['useEmail'];
        $userol = $_POST['useRol'];
        $sql = "UPDATE user SET useDNI = '$dni', useName = '$usename', useLastName = '$uselastname', useNametag = '$usenametag', useEmail = '$usemail', useRol = '$userol' WHERE useId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroUsuarios.php');    
        }else{
            header('location: RegistroClientes.php');
        }
    }

    if(isset($_POST['useDelete'])){
        $id = $_POST['useId'];
        $sql = "DELETE FROM user WHERE useId = '$id'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroUsuarios.php');    
        }
    }

    if (isset($_POST['linkUE'])) {
        $idU = substr($_POST['idUse'],0,1);
        $idE = substr($_POST['idEm'],0,1);
        $sql = "UPDATE employee SET useId = '$idU' WHERE empId = '$idE'";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $exe = mysqli_query($con, $sql);
        if($exe){
            header('location: RegistroUsuarios.php');    
        }
    }
    ?>