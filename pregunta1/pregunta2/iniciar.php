<?php

include("config/conexion.php");
session_start();

if($_POST) {
    $correo = $_POST['usuario'];
    $pass = $_POST['contrasenia'];
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE telefono = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows >= 1) {
        $usuarioa = $result->fetch_assoc();
        $contra = $usuarioa['pwd'];
        $verifica = password_verify($pass, $contra);
        if($pass==$contra) {
            $_SESSION['idus'] = $usuarioa['id'];
            $_SESSION['usuario'] = true;
            $nombreu = $usuarioa['nombre'];
            $tipo = $usuarioa['tipo_us'];
            $_SESSION['tipo_us'] = $tipo;
            $_SESSION['nombreusuario'] = $nombreu;
            $_SESSION['telefono'] = $usuarioa['telefono'];
            switch($tipo) {
                case 'cliente':
                    header('Location:index.php');
                    break;
                case 'administrador':
                    header('Location:index.php');
                    break;
            }
        } else {
            $mensaje = "Error: usuario o contraseña incorrectos";
        }
    } else {
        $mensaje = "Error: usuario o contraseña incorrectos";
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Banco INIM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e0f7fa;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card-header {
            background: radial-gradient(circle, rgba(0, 33, 55, 1) 0%, rgba(0, 90, 123, 1) 100%);
            color: white;
            font-size: 24px;
        }
        .btn-primary {
            background: radial-gradient(circle, rgba(0, 33, 55, 1) 0%, rgba(0, 90, 123, 1) 100%);
            border-color: #007bff;
        }
        .btn-primary:hover {
        background-color: #000000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">Iniciar sesión</div>
                    <div class="card-body">
                        <?php if(isset($mensaje)){ ?>
                            <?php echo $mensaje; ?>
                        <?php }?>

                        <form method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Usuario (telefono):</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Escribe el usuario">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Escribe la contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <a type="btn" class="btn btn-primary" href="usuariocuenta.php">Registro</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>