<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Saldos por departamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <br>
    <br>
        <h1>Monto por departamento</h1>
        <br>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>La Paz</th>
                    <th>Santa Cruz</th>
                    <th>Potosí</th>
                    <th>Tarija</th>
                    <th>Cochabamba</th>
                    <th>Sucre</th>
                    <th>Pando</th>
                    <th>Beni</th>
                    <th>Oruro</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $saldos_departamentos->{"La Paz"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Santa Cruz"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Potosí"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Tarija"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Cochabamba"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Sucre"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Pando"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Beni"}; ?></td>
                    <td><?php echo $saldos_departamentos->{"Oruro"}; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
