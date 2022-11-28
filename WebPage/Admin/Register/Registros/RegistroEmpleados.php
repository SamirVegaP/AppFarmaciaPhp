<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Css/tablero.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <input type="checkbox" id="Ventana">
    <div class="formall">
        <form action="RegistroEmpleados.php" method="post" class="formInsert">
        <div class = "sectionForm Cent">
            <h2>DNI: </h2>
            <input type="text" name="empDNI" placeholder = "Inserte su DNI">
        </div>
        <div class = "sectionForm Sec">
            <h2>Nombre: </h2>
            <input type="text" name="empName" placeholder = "Inserte su Nombre">
        </div>
        <div class = "sectionForm Sec">
            <h2>Apellidos: </h2>
            <input type="text" name="empLastName" placeholder = "Inserte sus Apellidos">
        </div>
        <div class = "sectionForm Cent">
            <h2> Ocupación: </h2>
            <input type="text" name="empRol" placeholder = "Inserte su Ocupación">
        </div>
        <div class = "sectionForm Cent">
            <h2> Género: </h2>
            <input type="radio" name="empGender" value = "M" id="GenderM">
            <label for="GenderM">Masculino</label>
            <input type="radio" name="empGender" value = "F" id="GenderF">
            <label for="GenderF">Femenino</label>
        </div>
        <div class = "sectionForm Sec">
            <h2> Teléfono: </h2>
            <input type="text" name="empPhone" placeholder = "(Código de País) + Teléfono">
        </div>
        <div class = "sectionForm Sec">
            <h2> Dirección: </h2>
            <input type="text" name="empAddress" placeholder = "Inserte su Dirección">
        </div>
        <div class = "sectionForm Third">
            <h2> Hora de Entrada: </h2>
            <input type="text" name="empEntryTime" placeholder = "Inserte Hora de Entrada">
        </div>
        <div class = "sectionForm Third">
            <h2> Hora de Salida: </h2>
            <input type="text" name="empDepartureTime" placeholder = "Inserte Hora de Salida">
        </div>
        <div class = "sectionForm 33">
            <h2> Salario: </h2>
            <input type="text" name="empSalary" placeholder = "Inserte Monto de Salario">
        </div>
        <div class = "sectionForm">
            <input type="hidden" name="useId" placeholder = "Código de Usuario" value = "0">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "empCreate" value="Añadir Empleado">
        </div>
        <label class="Label Sec" for="Ventana"><h2>Atrás</h2></label>
        </form>
    </div>

    <form action="RegistroEmpleados.php" method="post" class="searcherform">
        <input type="search" name="Buscador" id="logSearcher">
        <input type="submit" name="Searcher" value="Buscar">
        <label for="Ventana" class="other">Añadir</label>
    </form>
    <?php
    if(isset($_POST['empCreate'])){
        $sql = "SELECT MAX(empId) FROM employee";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        if($ejecutar){
            $id = $fila['MAX(empId)'] + 1;    
        }

        $dni = $_POST['empDNI'];
        $empname = $_POST['empName'];
        $emplastname = $_POST['empLastName'];
        $empgender= $_POST['empGender'];
        $empphone = $_POST['empPhone'];
        $empaddress = $_POST['empAddress'];
        $empet = $_POST['empEntryTime'];
        $empdt = $_POST['empDepartureTime'];
        $empsalary = $_POST['empSalary'];
        $emprol = $_POST['empRol'];
        $useid = $_POST['useId'];
        $sql2 = "INSERT INTO `employee` VALUES ('$id', '$empname', '$emplastname', '$emprol', '$empgender', '$dni', '$empphone', '$empaddress', '$empet', '$empdt', '$empsalary', '$useid')";
        $exe = mysqli_query($con, $sql2);
        if($exe){
            header('location: RegistroEmpleados.php');    
        }
    }
    ?>
    <div class="Table">
        <table>
            <thead>
                <tr>
                    <td>DNI</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Ocupación</td>
                    <td>Género</td>
                    <td>Celular</td>
                    <td>Dirección</td>
                    <td>Entrada</td>
                    <td>Salida</td>
                    <td>Salario</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM employee WHERE empname LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM employee";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['empId'];
                    $dni = $fila['empDNI'];
                    $name = $fila['empName'];
                    $lastname = $fila['empLastName'];
                    $rol = $fila['empRol'];
                    $gender = $fila['empGender'];
                    $phone = $fila['empPhone'];
                    $address = $fila['empAddress'];
                    $houre = $fila['empEntryTime'];
                    $hours = $fila['empDepartureTime'];
                    $salario = $fila['empSalary'];
                    $useid = $fila['useId'];
                    $i++;  
                ?>
                <tr>
                    <form action="crudemployee.php" method="post">
                        <input type="hidden" name="empId2" value = "<?php echo $id ?>">
                        <td><input type="text" name="empDNI2" value = "<?php echo $dni ?>"></td>
                        <td><input type="text" name="empName2" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="empLastName2" value = "<?php echo $lastname ?>"></td>
                        <td><input type="text" name="empRol2" value = "<?php echo $rol ?>"></td>
                        <td><input type="text" name="empGender2" value = "<?php echo $gender ?>"></td>
                        <td><input type="text" name="empPhone2" value = "<?php echo $phone ?>"></td>
                        <td><input type="text" name="empAddress2" value = "<?php echo $address ?>"></td>
                        <td><input type="text" name="empEntryTime2" value = "<?php echo $houre ?>"></td>
                        <td><input type="text" name="empDepartureTime2" value = "<?php echo $hours ?>"></td>
                        <td><input type="text" name="empSalary2" value = "<?php echo $salario ?>"></td>
                        <input type="hidden" name="useId2" value = "<?php echo $useid ?>">
                        <td><input type="submit" name="empEdit" value = "Editar"></td>
                        <td><input type="submit" name="empDelete" value = "Eliminar"></td>
                    </form>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>