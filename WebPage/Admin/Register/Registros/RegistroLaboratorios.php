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
        <form action="RegistroLaboratorios.php" method="post" class="formInsert">
        <div class = "sectionForm Cent">
            <h2>Nombre: </h2>
            <input type="text" name="labName" placeholder = "Inserte su Nombre">
        </div>
        <div class = "sectionForm Cent">
            <h2>Dirección: </h2>
            <input type="text" name="labAddress" placeholder = "Inserte la Dirección">
        </div>
        <div class = "sectionForm Cent">
            <h2> Teléfono: </h2>
            <input type="text" name="labPhone" placeholder = "Inserte el Teléfono">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "labCreate" value="Añadir Laboratorio">
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
    if(isset($_POST['labCreate'])){
        $sql = "SELECT MAX(labId) FROM lab";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        $fila = mysqli_fetch_array($ejecutar);
        if($ejecutar){
            $id = $fila['MAX(labId)'] + 1;    
        }

        $labname = $_POST['labName'];
        $labaddress = $_POST['labAddress'];
        $labphone = $_POST['labPhone'];
        $sql2 = "INSERT INTO `lab` VALUES ('$id', '$labname', '$labaddress', '$labphone')";
        $exe = mysqli_query($con, $sql2);
        if($exe){
            header('location: RegistroLaboratorios.php');    
        }
    }
    ?>
    <div class="Table">
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM lab WHERE labName LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM lab";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['labId'];
                    $name = $fila['labName'];
                    $concen = $fila['labAddress'];
                    $cost = $fila['labPhone'];
                    $i++;  
                ?>
                <tr>
                    <form action="crudlab.php" method="post">
                        <input type="hidden" name="empId2" value = "<?php echo $id ?>">
                        <td><input type="text" name="empDNI2" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="empName2" value = "<?php echo $concen ?>"></td>
                        <td><input type="text" name="empLastName2" value = "<?php echo $cost ?>"></td>
                        <td><input type="submit" name="labEdit" value = "Editar"></td>
                        <td><input type="submit" name="labDelete" value = "Eliminar"></td>
                    </form>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <form class="SecUser" action="crudlab.php" method="post">
        <div class="contain_section">
            <h3>Producto:</h3>
            <input list="id-pro" name = "idPro">
            <datalist id = "id-pro" name = "idPro">
                <?php
                $sql = "SELECT * FROM product";
                $con=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($con, $sql);
                if ($ejecutar) {
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $idp = $fila['proId'];
                        $namep = $fila['proName'];
                ?>
                <option value="<?php echo $idp.'-'.$namep?>">
                <?php
                    }
                }
                ?>
            </datalist>
        </div>
        <div class="contain_section">
            <h3>Laboratorio:</h3>
            <input list="id-lab" name= "idLab">
            <datalist id = "id-lab" name = "idLab">
                <?php
                $sql2 = "SELECT * FROM lab";
                $con2=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar2 = mysqli_query($con2, $sql2);
                if ($ejecutar2) {
                    while ($fila = mysqli_fetch_array($ejecutar2)) {
                        $idl = $fila['labId'];
                        $namel = $fila['labName'];
                ?>
                <option value="<?php echo $idl.'-'.$namel?>">
                <?php
                    }
                }
                ?>
            </datalist>
        </div>
        <div class="btn_section">
            <input type="submit" value="Enlazar Usuario y Empleado" name = "linkPL">
        </div>
    </form>
</body>
</html>