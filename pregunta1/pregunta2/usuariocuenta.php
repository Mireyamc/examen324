<?php

include("config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $ci = $_POST["ci"];
    $fecha = $_POST["fecha"];
    $telefono = $_POST["telefono"];
    $pwd = $_POST["pwd"];
    $sql_verificar = "SELECT * FROM usuario WHERE nombre='$nombre' OR ci='$ci'";
    $resultado = $conexion->query($sql_verificar);
    if ($resultado->num_rows > 0) {
        echo "<script>alert('El usuario ya existe');</script>";
    } else {
    $fecha_nacimiento = new DateTime($fecha);
    $fecha_actual = new DateTime();
    $edad = $fecha_nacimiento->diff($fecha_actual)->y;
    if ($edad < 18) {
        echo "<script>alert('Lo siento, debes ser mayor de edad para crear una cuenta.');</script>";
    } else {
    $sql = "INSERT INTO usuario (nombre, ci, fecha,telefono,pwd) VALUES ('$nombre', '$ci', '$fecha','$telefono','$pwd')";
    if ($conexion->query($sql) === TRUE) {
        echo '<script>alert("usuario agregado con exito");</script>';
        header("Location: iniciar.php");
    } else {
        echo "Error al agregar el usuario: " . $conexion->error;
    }
    }
 }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
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
                    <div class="card-header">Registro Usuario</div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label><br>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="ci">CI:</label><br>
                                <input type="text" class="form-control" id="ci" name="ci" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha:</label><br>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label><br>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Contraseña:</label><br>
                                <input type="password" class="form-control" id="pwd" name="pwd">
                            </div>
                            <button type="submit" class="btn btn-primary"> Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>