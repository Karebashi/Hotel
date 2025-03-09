<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Hotel AquaMar Resort</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fa-solid fa-water"></i> Hotel AquaMar Resort </h1>
            <nav>
                <ul>
                <li><a href="index.php">Inicio</a></li>
                    <li><a href="about.php">Nosotros</a></li>
                    <li><a href="services.php">Servicios</a></li>
                    <li><a href="habitaciones.php">Habitaciones</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                    <?php if ($isClient): ?>
                        <li><a href="../../Back-end/php/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.html">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <section class="contact">
        <div class="container">
            <h2>Contacto</h2>
            <div id="status-message"></div>
            <div class="contact-info">
                <div class="contact-details">
                    <p><i class="fas fa-map-marker-alt"></i> Dirección: Hotel AquaMar Resort, Cra. 2 #6-49, El Rodadero, Gaira, Santa Marta, Magdalena</p>
                    <p><i class="fas fa-phone-alt"></i> Teléfono: +57 300 3618052</p>
                    <p><i class="fas fa-envelope"></i> Email: aquemaresort@gmail.com</p>
                </div>
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3913.7557824746173!2d-74.22927082536597!3d11.205696488970341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef4f567ed7b6d7b%3A0xe0018e31b8a1055!2sHotel%20Arhuaco%20Rodadero!5e0!3m2!1ses!2sco!4v1740703633628!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <form action="../../Back-end/php/send_email.php" method="post">
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Asunto:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const statusMessage = document.getElementById('status-message');

            if (status === 'success') {
                statusMessage.innerHTML = '<div class="alert alert-success">El mensaje ha sido enviado correctamente.</div>';
            } else if (status === 'error') {
                statusMessage.innerHTML = '<div class="alert alert-danger">El mensaje no pudo ser enviado. Por favor, inténtelo de nuevo más tarde.</div>';
            } else if (status === 'invalid') {
                statusMessage.innerHTML = '<div class="alert alert-warning">Método de solicitud no válido.</div>';
            }
        });
    </script>
    <footer>
        <div class="container">
            <p>&copy; 2025 Hotel AquaMar Resort. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>