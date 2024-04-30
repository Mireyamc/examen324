<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Inicio de sesión</h1>
        <form action="<?php echo site_url('Login/iniciar_sesion'); ?>" method="post">
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Iniciar sesión">
        </form>
        <?php
        // Mostrar mensaje de error si lo hay
        if ($this->session->flashdata('mensaje_error')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('mensaje_error') . '</div>';
        }
        ?>
    </div>
</body>
</html>