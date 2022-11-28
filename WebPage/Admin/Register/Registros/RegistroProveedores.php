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
        <form action="RegistroProveedores.php" method="post" class="formInsert">
        <div class = "sectionForm Cent">
            <h2>DNI: </h2>
            <input type="text" name="supRUC" placeholder = "Inserte su RUC">
        </div>
        <div class = "sectionForm Sec">
            <h2>Nombre: </h2>
            <input type="text" name="supName" placeholder = "Inserte su Nombre">
        </div>
        <div class = "sectionForm Sec">
            <h2> Teléfono: </h2>
            <input type="text" name="supPhone" placeholder = "(Código de País) + Teléfono">
        </div>
        <div class = "sectionForm Sec">
            <h2> Dirección: </h2>
            <input type="text" name="supAddress" placeholder = "Inserte su Dirección">
        </div>
        <div class = "sectionForm Sec">
            <h2> Banco: </h2>
            <input type="email" name="supBank" placeholder = "Inserte Banco">
        </div>
        <div class = "sectionForm Cent">
            <h2> Cuenta de Banco: </h2>
            <input type="email" name="supAccount" placeholder = "Inserte Cuenta de Banco">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "supCreate" value="Añadir Proveedor">
        </div>
        <label class="Label Sec" for="Ventana"><h2>Atrás</h2></label>
        </form>
    </div>

    <form action="RegistroProveedores.php" method="post" class="searcherform">
        <input type="search" name="Buscador" id="logSearcher">
        <input type="submit" name="Searcher" value="Buscar">
        <label for="Ventana" class="other">Añadir</label>
    </form>
    <?php
    if(isset($_POST['supCreate'])){
        $sql = "SELECT MAX(supId) FROM supplier";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        if($ejecutar){
            $id = $fila['MAX(supId)'] + 1;    
        }

        $supname = $_POST['supName'];
        $supphone = $_POST['supPhone'];
        $supaddress = $_POST['supAddress'];
        $supRUC = $_POST['supRUC'];
        $supBank = $_POST['supBank'];
        $supAccount = $_POST['supAccount'];
        $sql2 = "INSERT INTO `supplier` VALUES ('$id', '$supname', '$supRUC', '$supaddress', '$supphone', '$supBank', '$supAccount')";
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