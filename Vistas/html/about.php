<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Hotel AquaMar Resort</title>
    <link rel="stylesheet" href="../css/styles_2.css">
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
                        <li><a href="mis_reservas.php">Mis Reservas</a></li>
                        <li><a href="../../Back-end/php/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.html">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <section class="welcome parallax">
        <div class="container">
            <h1>Sobre Nosotros</h1>
            <h2>Descubre la historia y la misión de Hotel AquaMar Resort.</h2>
        </div>
    </section>
    <section class="about">
        <div class="container">
            <div class="about-section">
                <img src="../../images/hotel/history.jpg" alt="Nuestra Historia">
                <div class="about-content">
                    <h2>Nuestra Historia</h2>
                    <p>Hotel AquaMar Resort fue fundado en 1990 con la visión de ofrecer una experiencia única de lujo y confort en un entorno natural incomparable. Desde entonces, hemos crecido y evolucionado, pero nuestra misión sigue siendo la misma: proporcionar a nuestros huéspedes una estancia inolvidable.</p>
                </div>
            </div>
            <div class="about-section">
                <img src="../../images/hotel/mision.jpg" alt="Nuestra Misión">
                <div class="about-content">
                    <h2>Nuestra Misión</h2>
                    <p>En Hotel AquaMar Resort, nos esforzamos por ofrecer el más alto nivel de servicio y hospitalidad. Nuestro objetivo es crear un ambiente acogedor y relajante donde nuestros huéspedes puedan disfrutar de todas las comodidades modernas mientras se conectan con la naturaleza.</p>
                </div>
            </div>
            <div class="about-section">
                <img src="../../images/hotel/team.jpg" alt="Nuestro Equipo">
                <div class="about-content">
                    <h2>Nuestro Equipo</h2>
                    <p>Contamos con un equipo de profesionales dedicados que están comprometidos a hacer que tu estancia sea lo más placentera posible. Desde nuestro personal de recepción hasta nuestros chefs y personal de limpieza, todos trabajamos juntos para asegurarnos de que tengas una experiencia excepcional.</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2025 Hotel AquaMar Resort. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>