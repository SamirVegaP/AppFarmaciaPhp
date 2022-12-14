<?php
include_once '../../../../Php/SessionFunctions/user.php';
include_once '../../../../Php/SessionFunctions/user_session.php';
include_once '../../../../Php/SessionFunctions/buyout.php';
$user = new User();
$userSession = new UserSession();
$buyout = new Buyout();
?>

<!DOCTYPE html>
<html lang="en">
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
        <form action="functions2.php" method="post" class="formInsert">
            <div class="sectionForm Cent">
                <h3>Producto:</h3>
                <input list="id-pro" name = "idProduct" class="inputList">
                <datalist id = "id-pro" name = "idProduct">
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
            <div class = "sectionForm Sec">
                <h2> Cantidad: </h2>
                <input type="text" name="proCantity" placeholder = "Inserte cantidad">
            </div>
            <div class = "sectionForm Sec">
                <h2> Costo Unitario: </h2>
                <input type="text" name="proCost" placeholder = "Inserte el costo unitario">
            </div>
            <div class="sectionBtn Sec">
                <input type="submit" name = "proInsert" value="A??adir Producto">
            </div>
        <label class="Label Sec" for="Ventana"><h2>Atr??s</h2></label>
        </form>
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        $user->setUser($userSession->getCurrentUser());
        $iduser = $user->getId();
        if (isset($_SESSION['buyout'])) {
            $buyout->setBuyout($userSession->getCurrentBuyout());
            $idseal = $buyout->getId();
            $date = $buyout->getDate();
            $active = 1;
        }else{
            $active = 0;
            $sql0 = "SELECT MAX(buyId) FROM buyout";
            $con0=mysqli_connect("localhost","root","","bd_farm");
            $ejecutar0 = mysqli_query($con0, $sql0);
            if($ejecutar0){
                $fila = mysqli_fetch_array($ejecutar0);
                if ($fila['MAX(buyId)'] != null) {
                    $id = $fila['MAX(buyId)'] + 1; 
                }else{
                    $id = 0; 
                }   
            }
            $idseal = $id;
            $date = date('d/m/y',strtotime("-1 days")). "\n";
        }
    }
    ?>
    <?php
    if ($active == 0) {
    ?>
    <form action="functions2.php" method="post" class="formEr">
        <div class = "sectionForm Sec">
            <h2>ID: </h2>
            <input type="text" name="seaId" value = "<?php echo $idseal?>">
        </div>
        <div class = "sectionForm Sec">
            <h2>Fecha de Venta: </h2>
            <input type="text" name="seaDate" value = "<?php echo $date?>">
        </div>
        <div class = "sectionForm Sec">
            <h2>Metodo de Pago: </h2>
            <input list="options" name = "tMetodo" class="inputList">
            <datalist id = "options" name = "tMetodo">
                <option value="Paypal"></option>
                <option value="Efectivo"></option>
            </datalist>
        </div>
        <div class = "sectionForm Sec">
            <h2>Distribuidor: </h2>
            <input list="optioner" name = "tCliente" class="inputList">
            <datalist id = "optioner" name = "tCliente">
            <?php
                $sql = "SELECT * FROM supplier";
                $con=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($con, $sql);
                if ($ejecutar) {
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $idu = $fila['supId'];
                        $nameu = $fila['supName'];
                ?>
                <option value="<?php echo $idu.'-'.$nameu?>"></option>
            <?php
                }
                }
            ?>
            </datalist>
        </div>
        <input type="hidden" name="tUser" value = "<?php echo $userSession->getCurrentUser()?>">
        <div class="sectionBtn Cent">
            <input type="submit" name = "SealCreate" value="Generar Compra">
        </div>
    </form>
    <?php
    }
    ?>
    <?php
    if ($active == 1) {
    ?>
        <form action="functions2.php" method="post" class="searcherform">
            <input type="submit" name="EndStore" value="Terminar Venta">
            <label for="Ventana" class="other">A??adir Producto</label>
        </form>
        <div class="Table">
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Cantidad</td>
                    <td>Costo</td>
                    <td>Total</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = "SELECT * FROM detailbuyout WHERE buyId = $idseal";
                echo "<script> console.log('$consulta'); </script>";
                $conexion=mysqli_connect("localhost","root","","bd_farm");
                $ejecutar = mysqli_query($conexion, $consulta);
                $i = 0;
                if($ejecutar){
                while ($fila = mysqli_fetch_array($ejecutar)) {
                    $id = $fila['buyId'];
                    $idP = $fila['proId'];
                    $cdtp = $fila['proQuantity'];
                    $costp = $fila['proCost'];
                    $consulta2 = "SELECT * FROM product WHERE proId = $idP";
                    $conexion2=mysqli_connect("localhost","root","","bd_farm");
                    $ejecutar2 = mysqli_query($conexion2, $consulta2);
                    if ($ejecutar) {
                        while ($fila2 = mysqli_fetch_array($ejecutar2)) {
                            $proName = $fila2['proName'];
                        }
                    }
                    $i++;  
                ?>
                <tr>
                    <form action="functions2.php" method="post">
                        <input type="hidden" name="proId2" value = "<?php echo $id ?>">
                        <input type="hidden" name="proId22" value = "<?php echo $idP ?>">
                        <td><input type="text" name="proName2" value = "<?php echo $proName ?>"></td>
                        <td><input type="text" name="proQuantity2" value = "<?php echo $cdtp ?>"></td>
                        <td><input type="text" name="proCost2" value = "<?php echo $costp ?>"></td>
                        <td><input type="text" name="proCostT2" value = "<?php echo $costp*$cdtp ?>"></td>
                        <td><input type="submit" name="proDelete" value = "Eliminar"></td>
                    </form>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
</body>
</html>