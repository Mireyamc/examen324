<?php 
session_start();

if($_SESSION['usuario'] ){
    $nombreusuario=$_SESSION["nombreusuario"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">  
    <title>BANCO INIM</title>
</head>
<body>
    <header>
        <nav>
            <ul id="menu-ul">
                <li style="float: left;"><a class="menu-link" href="index.php">INICIO</a></li>
                <li class="menu-item"><a class="menu-link" href="cuentaahorro.php">CAJA DE AHORRO</a></li>
                <li class="menu-item"><a class="menu-link" href="cuentacorriente.php">CUENTA CORRIENTE</a></li>
                <li class="menu-item"><a class="menu-link" href="cuentamancomunada.php">CUENTA MANCOMUNADA</a></li>
                <?php if(!isset($_SESSION['usuario'])){ ?>
                    <li class="menu-item"><a class="menu-link" href="iniciar.php">INICIAR SESION</a></li>
            <?php }else {?> <li class="menu-item"><a class="menu-link" href="cerrars.php">CERRAR SESION</a></li>
                <li class="menu-item"><a class="menu-link" href="cuentas.php">CUENTAS</a></li>
                <?php }?>
           
            
            </ul>
        </nav>
    </header>