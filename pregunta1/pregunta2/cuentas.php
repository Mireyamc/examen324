<?php include('header.php'); ?>
<?php
include('config/conexion.php');
if (!isset($_SESSION['idus'])) {
    header("Location: iniciar.php");
}
date_default_timezone_set('America/Santiago');
$fecha_act = date('Y-m-d\TH:i'); 
$nombreusu=$_SESSION['nombreusuario'];
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$idusu = $_SESSION['idus'];
$cuentasu = array();
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$result = $conexion->query("SELECT * FROM cuenta WHERE id_us= $idusu and activo=1");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cuentasu[] = $row;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    if ($accion == "Agregar" || $accion == "Modificar") {
        $saldocuenta = $_POST['saldo'];
        $tipo=$_POST['tipo'];
        if ($accion == "Agregar") {"INSERT INTO cuenta (tipo,  fecha_cre, id_us, activo)
            VALUES ('$tipo_cuenta', '$fecha_creacion', $idusu, 1)";
            $stmt = $conexion->prepare("INSERT INTO cuenta (tipo,  fecha_cre, id_us, activo) VALUES (?, ?, ?, 1)");
            $stmt->bind_param("ssi", $tipo, $fecha_act, $idusu);
        } elseif ($accion == "Modificar") {
            $stmt = $conexion->prepare("SELECT saldo FROM cuenta WHERE id = ?");
            $stmt->bind_param("i", $txtID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $saldocu= $row['saldo'];
            $stmt->close();
            $monto = $_POST['monto'];
            $operacion = $_POST['operacion'];   
            if ($operacion == "deposito" && $monto !=0) {
                $saldocu += $monto;
                $stmt = $conexion->prepare("INSERT INTO transaccion (id_cuenta, id_us, tipo, monto, fecha_h) VALUES (?,?, 'deposito', ?, ?)");
                $stmt->bind_param("iiis", $txtID,$idusu, $monto, $fecha_act);
                $stmt->execute();
                $stmt->close();
            } elseif ($operacion == "retiro" && $monto !=0)  {
                if ($saldocu< $monto) {
                    echo '<script>alert("Saldo insuficiente");</script>';
            echo '<script>window.location.href = "cuentas.php";</script>';
            exit; 
                } else {
                    $saldocu -=$monto;
                    $stmt = $conexion->prepare("INSERT INTO transaccion (id_cuenta, id_us, tipo, monto, fecha_h) VALUES (?,?, 'retiro', ?, ?)");
                    $stmt->bind_param("iiis", $txtID,$idusu, $monto, $fecha_act);
                    $stmt->execute();
                    $stmt->close();
                }
            }
                    $stmt = $conexion->prepare("UPDATE cuenta SET saldo=?, tipo=? WHERE id=?");
                $stmt->bind_param("isi", $saldocu, $tipo, $txtID);
        }

        $stmt->execute();
        $stmt->close();
        header("Location: cuentas.php");
    }
    if ($accion == "Seleccionar") {
        $stmt = $conexion->prepare("SELECT * FROM cuenta WHERE id = ?");
        $stmt->bind_param("i", $txtID);
        $stmt->execute();
        $result = $stmt->get_result();
        $cnts = $result->fetch_assoc();
        $fecha_creacion = $cnts['fecha_cre'];
        $saldocuenta = $cnts['saldo'];
        $tipo = $cnts['tipo'];

    }


    if ($accion == "Borrar") {
        $stmt = $conexion->prepare("SELECT saldo FROM cuenta WHERE id = ?");
        $stmt->bind_param("i", $txtID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $saldo_actual = $row['saldo'];
        $stmt->close();
    
        if ($saldo_actual > 0) {
            echo '<script>alert("no se puede eliminar una cuenta con saldo aun, porfavor retire su dinero primero");</script>';
            echo '<script>window.location.href = "cuentas.php";</script>';
        } else {
            $stmt = $conexion->prepare("UPDATE cuenta SET activo = 0 WHERE id = ?");
            $stmt->bind_param("i", $txtID);
            $stmt->execute();
            $stmt->close();
            header("Location: cuentas.php");
        }
    }
    
}
?></br> </br> </br>
<div class="col-md-5">
    <div class="card">
        <div class="card-header">Datos de la cuenta</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
            <div class="form-group" <?php echo ($accion == "Seleccionar") ? '' : 'style="display: none;"'; ?>>
            <label for="txtFechaCreacion">Id Cuenta:</label>
                <input type="text" name="txtID"  readonly id="txtID" value="<?php echo isset($txtID) ? $txtID : ''; ?>">
            </div> 
            <div class="form-group" >
                                <label for="id_us">Titular:</label>
                                <input type="text" class="form-control" name="id_us" value="<?php echo $nombreusu; ?>" readonly>
                            </div>

                <div class="form-group">
                    <label for="txtFechaCreacion">Fecha de Creación:</label>
                    <input type="datetime-local" readonly required class="form-control" value="<?php echo ($accion == "Seleccionar" && isset($fecha_creacion)) ? $fecha_creacion : $fecha_act; ?>" name="txtFechaCreacion" id="txtFechaCreacion" placeholder="Fecha de Creación">
                </div>

                <div class="form-group" <?php echo ($accion == "Seleccionar") ? '' : 'style="display: none;"'; ?>>
                <label for="txtFechaCreacion">Saldo:</label>
                    <input readonly type="text" required class="form-control" value="<?php echo isset($saldocuenta) ? $saldocuenta : ''; ?>" name="saldo" id="saldo" placeholder="Saldo">
                </div>

                <div class="form-group" <?php echo ($accion == "Seleccionar") ? '' : 'style="display: none;"'; ?>>
                    <label for="monto">Monto a depositar o retirar:</label>
                    <input type="text" required class="form-control" value="0" name="monto" id="monto" placeholder="Ingrese el monto">
                </div>

                <div class="form-group" <?php echo ($accion == "Seleccionar") ? '' : 'style="display: none;"'; ?>>
                    <label for="operacion" class="form-label mt-4">Operación:</label>
                    <select class="form-select" name="operacion" id="operacion">
                        <option value="deposito">Depósito</option>
                        <option value="retiro">Retiro</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="tipo" class="form-label mt-4">Tipo de cuenta:</label>
                    <select class="form-select" name="tipo" id="tipo">
                    <option value="ahorro" <?php if (isset($tipo) && $tipo == "ahorro") echo "selected"; ?>>Caja de Ahorros</option>
                    <option value="corriente" <?php if (isset($tipo) && $tipo == "corriente") echo "selected"; ?>>Cuenta Corriente</option>
                    <option value="mancomunada" <?php if (isset($tipo) && $tipo == "mancomunada") echo "selected"; ?>>Cuenta Mancomunada</option>
                    </select>
                </div>

                <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-9">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>   Saldo </th>
                <th>   tipo </th>
                <th>fecha de creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cuentasu as $cnts) { ?>
                <tr>
                    <td><?php echo $cnts['id']; ?></td>
                    <td><?php echo $cnts['saldo']; ?></td>
                    <td><?php echo $cnts['tipo']; ?></td>
                    <td><?php echo $cnts['fecha_cre']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID"  id="txtID" value="<?php echo $cnts['id']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
