<?php
include 'conexion_be.php';
session_start();

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$query = "SELECT email, rol FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['id_usuario'] = $usuario['id_usuario'];
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
                window.location = "../../Vistas/html/login.html";
            </script>';
    }
} else {
    echo '<script>
            alert("Correo o contraseña incorrectos");
            window.location = "../../Vistas/html/login.html";
        </script>';
}

mysqli_close($conexion);
?>
