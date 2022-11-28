<?php
include_once '../Php/SessionFunctions/user.php';
include_once '../Php/SessionFunctions/user_session.php';

$user = new User();
$userSession = new UserSession();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    if($user->getRol() == 'Administrador'){
        header('location: Admin/home_administrator.php');
    }else{
        header('location: Sealer/home_sealer.php') ;
    }
}else if (isset($_POST['useNametag']) && isset($_POST['usePassword'])) {
    $userForm = $_POST['useNametag'];
    $passForm = $_POST['usePassword'];
    if($user->userExists($userForm, $passForm)){
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        if($user->getRol() == 'Administrador'){
            header('location: Admin/home_administrator.php');
        }else{
            header('location: Sealer/home_sealer.php') ;
        }
    }else{
        echo "Nombre de usuario y/o Password incorrecto";
        $errorLogin = "Nombre de usuario y/o password es incorrecto";
        header("location: home_login.php");
    }
}else{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/Icono.webp" type="image/webp">
    <link rel="stylesheet" href="../Css/home_style.css">
    <title>Farmacia Jossi'e</title>
</head>
<body>
    <div class="BG">
        <img src="../Img/background.jpg" alt="">
    </div>
    <div class="conForm">
        <img src="../Img/Logo.webp" alt="" class="ImgReference">
        <form action="" method="post">
            <div class="conInput">
                <h2>Usuario:</h2>
                <input type="text" name="useNametag" placeholder = "Ingrese su Usuario" autocomplete = "off">
                <h2>Contraseña:</h2>
                <input type="password" name="usePassword" placeholder = "Ingrese su Contraseña">
                <input type="submit" value="Ingresar">
            </div>
        </form>
    </div>
</body>
</html>
<?php
    }
?>