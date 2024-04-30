<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido, administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <center>
        <br>
        <br>
        <h1>Bienvenido, Administrador
        </h1>
        <h2>
    <p style="color: blue;"><?php echo $usuario->nombre; ?></p>
</h2>
    </center>
    </div>
</body>
</html>