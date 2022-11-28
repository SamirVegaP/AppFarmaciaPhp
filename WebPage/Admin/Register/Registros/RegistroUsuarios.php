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
        <form action="RegistroUsuarios.php" method="post" class="formInsert">
        <div class = "sectionForm Cent">
            <h2>DNI: </h2>
            <input type="text" name="useDNI" placeholder = "Inserte su DNI">
        </div>
        <div class = "sectionForm Sec">
            <h2>Nombre: </h2>
            <input type="text" name="useName" placeholder = "Inserte su nombre">
        </div>
        <div class = "sectionForm Sec">
            <h2>Apellidos: </h2>
            <input type="text" name="useLastName" placeholder = "Inserte sus apellidos">
        </div>
        <div class = "sectionForm Cent">
            <h2> Nombre de Usuario: </h2>
            <input type="text" name="useNametag" placeholder = "Inserte un Nametag">
        </div>
        <div class = "sectionForm Sec">
            <h2> Correo Electrónico: </h2>
            <input type="email" name="useEmail" placeholder = "Inserte un email">
        </div>
        <div class = "sectionForm Sec">
            <h2> Contraseña: </h2>
            <input type="password" name="usePassword" placeholder = "Inserte una contraseña">
        </div>
        <div class = "sectionForm Cent">
            <h2> Rol: </h2>
            <input type="text" name="useRol" placeholder = "Inserte un Rol">
        </div>
        <div class="sectionBtn Sec">
            <input type="submit" name = "userCreate" value="Añadir Usuario">
        </div>
        <label class="Label Sec" for="Ventana"><h2>Atrás</h2></label>
        </form>
    </div>

    <form action="RegistroUsuarios.php" method="post" class="searcherform">
        <input type="search" name="Buscador" id="logSearcher">
        <input type="submit" name="Searcher" value="Buscar">
        <label for="Ventana" class="other">Añadir</label>
    </form>
    <?php
    if(isset($_POST['userCreate'])){
        $sql = "SELECT MAX(useId) FROM user";
        $con=mysqli_connect("localhost","root","","bd_farm");
        $ejecutar = mysqli_query($con, $sql);
        if($ejecutar){
            $id = $fila['MAX(useId)'] + 1;    
        }

        $dni = $_POST['useDNI'];
        $usename = $_POST['useName'];
        $uselastname = $_POST['useLastName'];
        $usenametag = $_POST['useNametag'];
        $usemail = $_POST['useEmail'];
        $md5pass = md5($_POST['usePassword']);
        $userol = $_POST['useRol'];
        $sql2 = "INSERT INTO `user` (`useId`, `useDNI`, `useName`, `useLastName`, `useNametag`, `useEmail`, `usePassword`, `useRol`) VALUES ('$id', '$dni', '$usename', '$uselastname', '$usenametag', '$usemail', '$md5pass', '$userol')";
        $exe = mysqli_query($con, $sql2);
        if($exe){
            header('location: RegistroUsuarios.php');    
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
                    <td>Usuario</td>
                    <td>Correo</td>
                    <td>Rol</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['Searcher'])){
                    $dato = $_POST['Buscador'];
                    $consulta = "SELECT * FROM user WHERE useName LIKE '%$dato%'";
                }else{
                    $consulta = "SELECT * FROM user";
                }
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['useId'];
                    $dni = $fila['useDNI'];
                    $name = $fila['useName'];
                    $lastname = $fila['useLastName'];
                    $nametag = $fila['useNametag'];
                    $email = $fila['useEmail'];
                    $rol = $fila['useRol'];
                    $i++;  
                ?>
                <tr>
                    <form action="cruduser.php" method="post">
                        <input type="hidden" name="useId" value = "<?php echo $id ?>">
                        <td><input type="text" name="useDNI" value = "<?php echo $dni ?>"></td>
                        <td><input type="text" name="useName" value = "<?php echo $name ?>"></td>
                        <td><input type="text" name="useLastName" value = "<?php echo $lastname ?>"></td>
                        <td><input type="text" name="useNametag" value = "<?php echo $nametag ?>"></td>
                        <td><input type="text" name="useEmail" value = "<?php echo $email ?>"></td>
                        <td><input type="text" name="useRol" value = "<?php echo $rol ?>"></td>
                        <td><input type="submit" name="useEdit" value = "Editar"></td>
                        <td><input type="submit" name="useDelete" value = "Eliminar"></td>
                    </form>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <form class="SecUser" action="cruduser.php" method="post">
        <div class="contain_section">
            <h3>Usuario:</h3>
            <input list="id-usuarios" name = "idUse">
            <datalist id = "id-usuarios" name = "idUse">
                <?php
                $sql = "SELECT * FROM user";
                $con=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($con, $sql);
                if ($ejecutar) {
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $idu = $fila['useId'];
                        $dni = $fila['useDNI'];
                        $nameu = $fila['useName'];
                ?>
                <option value="<?php echo $idu.'-'.$nameu?>">
                <?php
                    }
                }
                ?>
            </datalist>
        </div>
        <div class="contain_section">
            <h3>Empleado:</h3>
            <input list="id-emp" name= "idEm">
            <datalist id = "id-emp" name = "idEm">
                <?php
                $sql2 = "SELECT * FROM employee";
                $con2=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar2 = mysqli_query($con2, $sql2);
                if ($ejecutar2) {
                    while ($fila = mysqli_fetch_array($ejecutar2)) {
                        $ide = $fila['empId'];
                        $namee = $fila['empName'];
                ?>
                <option value="<?php echo $ide.'-'.$namee?>">
                <?php
                    }
                }
                ?>
            </datalist>
        </div>
        <div class="btn_section">
            <input type="submit" value="Enlazar Usuario y Empleado" name = "linkUE">
        </div>
    </form>
</body>
</html>