<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    // Validación de la contraseña (al menos una mayúscula, un número y un carácter especial)
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $contrasena)) {
        echo 
        '<script>
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
            window.location = "../../Vistas/html/register.html";
        </script>';
        exit();
    }

    // Encriptamiento de contraseña
    $contrasena = hash('sha512', $contrasena);
    
    $query = "INSERT INTO usuarios (nombre_completo, apellidos, email, telefono, contrasena) VALUES ('$nombre_completo', '$apellidos', '$email','$telefono', '$contrasena')";

    // Verificar que el correo no esté registrado
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    if(mysqli_num_rows($verificar_correo) > 0){
        echo 
        '<script>
            alert("Este correo ya está registrado, intenta con otro.");
            window.location = "register.php";
        </script>';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query);

    // Parte de validación de registro
    if($ejecutar){
        echo 
        '<script>
            alert("Usuario registrado exitosamente");
            window.location = "../../Vistas/html/login.html";
        </script>';
    }else{
        echo 
        '<script>
            alert("Inténtalo de nuevo, usuario no registrado");
            window.location = "../../Vistas/html/registro.html";
        </script>';
    }       

    mysqli_close($conexion);
?>
