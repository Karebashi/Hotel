<?php
include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];

if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $contrasena)) {
    echo '<script>
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
            window.location = "../../Vistas/html/register.html";
        </script>';
    exit();
}

$contrasena = hash('sha512', $contrasena);

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script>
            alert("Este correo ya está registrado, intenta con otro.");
            window.location = "../../Vistas/html/register.html";
        </script>';
    exit();
}

$query = "INSERT INTO usuarios (nombre_completo, apellidos, email, telefono, contrasena, rol) 
          VALUES ('$nombre_completo', '$apellidos', '$email', '$telefono', '$contrasena', 2)";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script>
            alert("Usuario registrado exitosamente");
            window.location = "../../Vistas/html/login.html";
        </script>';
} else {
    echo '<script>
            alert("Error al registrar usuario");
            window.location = "../../Vistas/html/register.html";
        </script>';
}

mysqli_close($conexion);
?>
