<?php
include_once '../../Php/SessionFunctions/user.php';
include_once '../../Php/SessionFunctions/user_session.php';

$user = new User();
$userSession = new UserSession();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Img/Icono.webp" type="image/webp">
    <link rel="stylesheet" href="../../Css/administrator.css">
    <title>Farmacia Jossi'e</title>
</head>
<body>
    <nav>
        <a href="UserAsignation.php" target="MyFrame">Editar mi Cuenta</a>
        <a href="Registered.php" target="MyFrame">Registros</a>
        <a href="Financer.php" target="MyFrame">Movimientos Financieros</a>
        <a href="Reports.php" target="MyFrame">Reportes</a>
        <a href="../../Php/SessionFunctions/logout.php">Salir de la sesión</a>
    </nav>
    <iframe src="Reports.php" frameborder="0" name = "MyFrame"></iframe>
</body>
</html>
<?php
}else{
    header('location: ../home_login.php') ;
}
?>