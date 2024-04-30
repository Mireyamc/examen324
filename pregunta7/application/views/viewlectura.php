<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <title>Listado de Cuentas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h1>Listado de Cuentas</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Saldo</th>
                    <th>Tipo</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cuentas as $cuenta): ?>
                    <tr>
                        <td><?php echo $cuenta->id; ?></td>
                        <td><?php echo $cuenta->saldo; ?></td>
                        <td><?php echo $cuenta->tipo; ?></td>
                        <td><?php echo $cuenta->fecha_cre; ?></td>
                        <td>
                            <a href="<?php echo base_url('index.php/Lectura/borrar/' . $cuenta->id); ?>" class="btn btn-danger">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

