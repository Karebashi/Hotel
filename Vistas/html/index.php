<?php
session_start();
$isClient = isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel AquaMar Resort</title>
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

    <section class="welcome parallax">
        <div class="container">
            <h1>¡Bienvenido a Hotel AquaMar Resort!</h1>
            <h1>Vive la armonía entre el lujo y la naturaleza en nuestro exclusivo resort frente al mar.</h1>
        </div>
    </section>
    <section class="gallery">
        <div class="container">
            <h2>Galería</h2>
            <p>Echa un vistazo a lo que te ofrecemos en nuestro grandioso hotel.</p>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../images/hotel1.png" class="d-block w-100" alt="Hotel Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../../images/hotel2.png" class="d-block w-100" alt="Hotel Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../../images/hotel3.png" class="d-block w-100" alt="Hotel Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="../../images/hotel4.png" class="d-block w-100" alt="Hotel Image 4">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <h2>Nuestros Servicios</h2>
            <ul>
                <li><i class="fas fa-swimming-pool"></i> Piscina</li>
                <li><i class="fas fa-spa"></i> Spa</li>
                <li><i class="fas fa-utensils"></i> Restaurante</li>
                <li><i class="fas fa-dumbbell"></i> Gimnasio</li>
                <li><i class="fas fa-dice"></i> Casino</li>
                <li><i class="fas fa-wifi"></i> Wi-Fi Gratis</li>
                <li><i class="fas fa-tv"></i> TV Satelital</li>
                <li><i class="fas fa-ellipsis-h"></i> </li> 
            </ul>
        </div>
    </section>
    <section class="contact">
        <div class="container">
            <h2>Contacto</h2>
            <div class="contact-info">
                <div class="contact-details">
                    <p><i class="fas fa-map-marker-alt"></i> Dirección: </p>
                    <p>Hotel AquaMar Resort, Cra. 2 #6-49, El Rodadero, Gaira, Santa Marta, Magdalena</p>
                    <p><i class="fas fa-phone-alt"></i> Teléfono: </p>
                    <p>+57 300 3618052</p>
                </div>
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3913.7557824746173!2d-74.22927082536597!3d11.205696488970341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef4f567ed7b6d7b%3A0xe0018e31b8a1055!2sHotel%20Arhuaco%20Rodadero!5e0!3m2!1ses!2sco!4v1740703633628!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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