<?php
include 'conexion_be.php';
session_start();

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$query = "SELECT id, nombre_completo, email, rol FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['id'] = $usuario['id']; 
    $_SESSION['nombre'] = $usuario['nombre_completo'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['rol'] = $usuario['rol'];

    if ($usuario['rol'] == 1) {
        header("Location: admin.php"); 
        exit();
    } elseif ($usuario['rol'] == 2) {
        header("Location: ../../Vistas/html/index.php"); 
        exit();
    } else {
        echo '<script>
                alert("Rol no válido.");
                window.location = "../../Vistas/html/login.php
            </script>';
    }
} else {
    echo '<script>
            alert("Correo o contraseña incorrectos");
            window.location = "../../Vistas/html/login.php
        </script>';
}

mysqli_close($conexion);
?>