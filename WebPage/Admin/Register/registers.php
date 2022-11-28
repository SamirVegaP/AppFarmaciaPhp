<?php

if(isset($_POST['registerEmployee'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroEmpleados.php ");
}
if(isset($_POST['registerUsuario'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroUsuarios.php ");
}
if(isset($_POST['registerClient'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroClientes.php ");
}
if(isset($_POST['registerProducts'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroProductos.php ");
}
if (isset($_POST['registerLabs'])) {
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroLaboratorios.php ");
}
if(isset($_POST['registerSupplier'])){
    header("location: http://localhost/SisFarm/WebPage/Admin/Register/Registros/RegistroProveedores.php ");
}
?>