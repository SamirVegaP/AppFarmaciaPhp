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
        <form action="RegistroProductos.php" method="post" class="formInsert">
        <div class = "sectionForm Sec">
            <h2>Nombre: </h2>
            <input type="text" name="proName" placeholder = "Inserte su Nombre">
        </div>
        <div class = "sectionForm Sec">
            <h2>Concentración: </h2>
            <input type="text" name="proConcentration" placeholder = "Inserte la Concentración">
        </div>
        <div class = "sectionForm Sec">
            <h2> Costo Unitario: </h2>
            <input type="text" name="proCost" placeholder = "Inserte el costo unitario">
        </div>
        <div class = "sectionForm Sec">
            <h2> Registro Sanatorio: </h2>
            <input type="text" name="proSanRegistration" placeholder = "Registro Sanitario">
        </div>
        <div class = "sectionForm Sec">
            <h2> Fecha Expiracion: </h2>
            <input type="date" name="proExpiration" placeholder = "Fecha de Expiracion">
        </div>
        <div class = "sectionForm Third">
            <h2> Presentación: </h2>
            <input type="text" name="proPresentation" placeholder = "Presentación del Producto">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "proCreate" value="Añadir Cliente">
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
    if(isset($_POST['proCreate'])){
        $sql = "SELECT MAX(proId) FROM product";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        $fila = mysqli_fetch_array($ejecutar);
        if($ejecutar){
            $id = $fila['MAX(proId)'] + 1;    
        }

        $proname = $_POST['proName'];
        $proconcentration = $_POST['proConcentration'];
        $procost= $_POST['proCost'];
        $prosn = $_POST['proSanRegistration'];
        $prodate = $_POST['proExpiration'];
        $propres = $_POST['proPresentation'];
        $sql2 = "INSERT INTO `product` VALUES ('$id', '$proname', '$proconcentration', '$procost', '$prosn', '$prodate', '$propres', '0')";
        $exe = mysqli_query($con, $sql2);
        if($exe){
            header('location: RegistroProductos.php');    
        }
    }
    ?>
    <div class="Table">
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Concentración</td>
                    <td>Costo</td>
                    <td>Registro <br> Sanitario</td>
                    <td>Fecha de <br> Vencimiento </td>
                    <td>Presentación</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM product WHERE proName LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM product";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['proId'];
                    $name = $fila['proName'];
                    $concen = $fila['proConcentracion'];
                    $cost = $fila['proCost'];
                    $sn = $fila['proSanRegistration'];
                    $exp = $fila['proExpiration'];
                    $pres = $fila['proPresentation'];
                    $i++;  
                ?>
                <tr>
                    <form action="crudproduct.php" method="post">
                        <input type="hidden" name="empId2" value = "<?php echo $id ?>">
                        <td><input type="text" name="empDNI2" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="empName2" value = "<?php echo $concen ?>"></td>
                        <td><input type="text" name="empLastName2" value = "<?php echo $cost ?>"></td>
                        <td><input type="text" name="empGender2" value = "<?php echo $sn ?>"></td>
                        <td><input type="text" name="empRUC2" value = "<?php echo $exp ?>"></td>
                        <td><input type="text" name="empAddress2" value = "<?php echo $pres ?>"></td>
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