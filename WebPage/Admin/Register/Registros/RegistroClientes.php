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
        <form action="RegistroClientes.php" method="post" class="formInsert">
        <div class = "sectionForm Cent">
            <h2>DNI: </h2>
            <input type="text" name="cliDNI" placeholder = "Inserte su DNI">
        </div>
        <div class = "sectionForm Sec">
            <h2>Nombre: </h2>
            <input type="text" name="cliName" placeholder = "Inserte su Nombre">
        </div>
        <div class = "sectionForm Sec">
            <h2>Apellidos: </h2>
            <input type="text" name="cliLastName" placeholder = "Inserte sus Apellidos">
        </div>
        <div class = "sectionForm Cent">
            <h2> Género: </h2>
            <input type="radio" name="cliGender" value = "M" id="GenderM">
            <label for="GenderM">Masculino</label>
            <input type="radio" name="cliGender" value = "F" id="GenderF">
            <label for="GenderF">Femenino</label>
        </div>
        <div class = "sectionForm Sec">
            <h2> RUC: </h2>
            <input type="text" name="cliRUC" placeholder = "Inserte RUC">
        </div>
        <div class = "sectionForm Sec">
            <h2> Teléfono: </h2>
            <input type="text" name="cliPhone" placeholder = "(Código de País) + Teléfono">
        </div>
        <div class = "sectionForm Sec">
            <h2> Dirección: </h2>
            <input type="text" name="cliAddress" placeholder = "Inserte su Dirección">
        </div>
        <div class = "sectionForm Third">
            <h2> Email: </h2>
            <input type="email" name="cliEmail" placeholder = "Inserte Email">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "cliCreate" value="Añadir Cliente">
        </div>
        <label class="Label Sec" for="Ventana"><h2>Atrás</h2></label>
        </form>
    </div>

    <form action="RegistroClientes.php" method="post" class="searcherform">
        <input type="search" name="Buscador" id="logSearcher">
        <input type="submit" name="Searcher" value="Buscar">
        <label for="Ventana" class="other">Añadir</label>
    </form>
    <?php
    if(isset($_POST['cliCreate'])){
        $sql = "SELECT MAX(cliId) FROM client";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        if($ejecutar){
            $id = $fila['MAX(cliId)'] + 1;    
        }

        $dni = $_POST['cliDNI'];
        $cliname = $_POST['cliName'];
        $clilastname = $_POST['cliLastName'];
        $cligender= $_POST['cliGender'];
        $cliphone = $_POST['cliPhone'];
        $cliaddress = $_POST['cliAddress'];
        $cliRUC = $_POST['cliRUC'];
        $cliemail = $_POST['cliEmail'];
        $sql2 = "INSERT INTO `client` VALUES ('$id', '$cliname', '$clilastname', '$cligender', '$dni', '$cliphone', '$cliRUC', '$cliemail', '$cliaddress')";
        $exe = mysqli_query($con, $sql2);
        if($exe){
            header('location: RegistroClientes.php');    
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
                    <td>Género</td>
                    <td>RUC</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Email</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM client WHERE dni LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM client";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['cliId'];
                    $dni = $fila['cliDNI'];
                    $name = $fila['cliName'];
                    $lastname = $fila['cliLastName'];
                    $gender = $fila['cliGender'];
                    $phone = $fila['cliPhone'];
                    $address = $fila['cliAddress'];
                    $ruc = $fila['cliRUC'];
                    $email = $fila['cliEmail'];
                    $i++;  
                ?>
                <tr>
                    <form action="crudclient.php" method="post">
                        <input type="hidden" name="empId2" value = "<?php echo $id ?>">
                        <td><input type="text" name="empDNI2" value = "<?php echo $dni ?>"></td>
                        <td><input type="text" name="empName2" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="empLastName2" value = "<?php echo $lastname ?>"></td>
                        <td><input type="text" name="empGender2" value = "<?php echo $gender ?>"></td>
                        <td><input type="text" name="empRUC2" value = "<?php echo $ruc ?>"></td>
                        <td><input type="text" name="empAddress2" value = "<?php echo $address ?>"></td>
                        <td><input type="text" name="empPhone2" value = "<?php echo $phone ?>"></td>
                        <td><input type="text" name="empEmail2" value = "<?php echo $email ?>"></td>
                        <td><input type="submit" name="cliEdit" value = "Editar"></td>
                        <td><input type="submit" name="cliDelete" value = "Eliminar"></td>
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