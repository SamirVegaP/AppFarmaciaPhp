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
            <h2>RUC: </h2>
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
            <input type="text" name="supBank" placeholder = "Inserte Banco">
        </div>
        <div class = "sectionForm Cent">
            <h2> Cuenta de Banco: </h2>
            <input type="text" name="supAccount" placeholder = "Inserte Cuenta de Banco">
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
        $fila = mysqli_fetch_array($ejecutar);
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
            header('location: RegistroProveedores.php');    
        }
    }
    ?>
    <div class="Table">
        <table>
            <thead>
                <tr>
                    <td>RUC</td>
                    <td>Nombre</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Banco</td>
                    <td>Cuenta</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM supplier WHERE supId LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM supplier";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['supId'];
                    $name = $fila['supName'];
                    $phone = $fila['supPhone'];
                    $address = $fila['supAddress'];
                    $ruc = $fila['supRUC'];
                    $bank = $fila['supBank'];
                    $account = $fila['supAccount'];
                    $i++;  
                ?>
                <tr>
                    <form action="crudsupplier.php" method="post">
                        <input type="hidden" name="supId2" value = "<?php echo $id ?>">
                        <td><input type="text" name="supRUC2" value = "<?php echo $ruc ?>"></td>
                        <td><input type="text" name="supName2" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="supAddress2" value = "<?php echo $address ?>"></td>
                        <td><input type="text" name="supPhone2" value = "<?php echo $phone ?>"></td>
                        <td><input type="text" name="supBank2" value = "<?php echo $bank ?>"></td>
                        <td><input type="text" name="supAccount2" value = "<?php echo $account ?>"></td>
                        <td><input type="submit" name="supEdit" value = "Editar"></td>
                        <td><input type="submit" name="supDelete" value = "Eliminar"></td>
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