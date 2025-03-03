<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../Vistas/css/regis.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="../../Vistas/html/index.html"><i class="fa-solid fa-water"></i> Hotel AquaMar Resort</a></h1>
        </div>
    </header>
    <div class="login-container register-container">
        <h1>Registro</h1>
        <form id="register-form" action="registro_usuario_be.php" method="POST">
            <div class="input-group">
                <label for="first-name">Nombres</label>
                <input type="text" id="first-name" name="nombre_completo" placeholder="Introduce tu nombre" required>
            </div>
            <div class="input-group">
                <label for="last-name">Apellidos</label>
                <input type="text" id="last-name" name="apellidos" placeholder="Introduce tus apellidos" required>
            </div>
            <div class="input-group">
                <label for="username">Correo Electrónico</label>
                <input type="email" id="username" name="email" placeholder="Introduce tu correo electrónico" required>
            </div>
            <div class="input-group">
                <label for="phone">Teléfono</label>
                <input type="tel" id="phone" name="telefono" placeholder="Introduce tu número de teléfono" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="contrasena" placeholder="Introduce tu contraseña" required>
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Introduce tu contraseña nuevamente" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <div class="extra-links">
            <a href="../../Vistas/html/login.html">¿Ya tienes una cuenta? Inicia sesión aquí</a>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(event) {
            let password = document.getElementById('password');
            let confirmPassword = document.getElementById('confirm-password');

            // Expresión regular para validar la contraseña
            let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

            // Verificar que las contraseñas coincidan
            if (password.value !== confirmPassword.value) {
                alert("Las contraseñas no coinciden.");
                password.style.border = "2px solid red";
                confirmPassword.style.border = "2px solid red";
                event.preventDefault();
                return;
            } else {
                password.style.border = "";
                confirmPassword.style.border = "";
            }

            // Verificar que la contraseña cumpla con los requisitos
            if (!passwordRegex.test(password.value)) {
                alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
                password.style.border = "2px solid red";
                event.preventDefault();
                return;
            } else {
                password.style.border = "";
            }
        });
    </script>
</body>
</html>
