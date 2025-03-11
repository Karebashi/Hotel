<?php
$servername = "localhost";
$username = "root";
$password = ""; // Asegúrate de que esta línea contenga la contraseña correcta si la hay
$dbname = "hotel";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>