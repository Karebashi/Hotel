<?php
include 'conexion_be.php';

$token = $_POST['token'];
$contrasena = $_POST['contrasena'];

// Validar la contraseña
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $contrasena)) {
    echo '<script>
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
            window.location = "../../Vistas/html/restablecer_contrasena.html?token='.$token.'";
          </script>';
    exit();
}

// Encriptar la contraseña
$contrasena = hash('sha512', $contrasena);

// Actualizar la contraseña en la base de datos
$query = "UPDATE usuarios SET contrasena = '$contrasena', token = NULL WHERE token = '$token'";
$result = mysqli_query($conexion, $query);

if ($result) {
    echo '<script>
            alert("Tu contraseña ha sido restablecida exitosamente.");
            window.location = "../../Vistas/html/login.html";
          </script>';
} else {
    echo '<script>
            alert("Error al restablecer la contraseña.");
            window.location = "../../Vistas/html/restablecer_contrasena.html?token='.$token.'";
          </script>';
}

mysqli_close($conexion);
?>