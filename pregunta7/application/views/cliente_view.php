<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido, Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <center>
        <br>
        <br>
        <h1>Bienvenido, Cliente</h1>
        <p>Hola, <?php echo $usuario->nombre; ?>. ¡Bienvenido a nuestro sitio!</p>
        <p>Estamos encantados de tenerte con nosotros.</p>
        <form action="<?php echo site_url('Login/cerrar_sesion'); ?>" method="post">
            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
        </form>
        </center>
    </div>
</body>
</html>
