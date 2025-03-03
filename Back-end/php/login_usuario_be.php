<?php
    include 'conexion_be.php';

    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $contrasena_hashed = hash('sha512', $contrasena);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena_hashed'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $email;
        header("location: ../../Vistas/html/index.html");
        exit();
    } else {
        echo 
        '<script>
            alert("Usuario no existente o credenciales incorrectas.");
            window.location = "../../Vistas/html/login.html";
        </script>';
        exit();
    }
?>
