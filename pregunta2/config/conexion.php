<?php 
$host="localhost";
$bd="bdmireyaconsuelomamanicarita";
$usuario="mireya";
$contrasenia="123456";
$conexion = new mysqli($host, $usuario, $contrasenia, $bd);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} 
?>