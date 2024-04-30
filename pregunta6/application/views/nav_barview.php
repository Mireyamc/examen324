<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo site_url('admin'); ?>">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Lectura'); ?>">Cuentas</a>
                </li>
                
                <li class="nav-item">
                    <form action="<?php echo site_url('Login/cerrar_sesion'); ?>" method="post">
                        <button type="submit" class="btn btn-link nav-link">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>