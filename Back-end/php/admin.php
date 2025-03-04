<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../Vistas/html/index.html"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../../Vistas/css/admin.css">
    <script src="../../Vistas/js/admin.js"></script>
    <script src="https://kit.fontawesome.com/9540a64b47.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../Vistas/html/index.html">
</head>
<body>
    <header>
        <div class="container">
            <h1>Panel de Administración <i class="fa-solid fa-water"></i> Hotel AquaMar Resort </h1>
            <nav>
                <ul>
                    <li><a href="#gestion-habitaciones">Gestión de Habitaciones</a></li>
                    <li><a href="#panel-reservas">Panel de Reservas</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>

                </ul>
            </nav>
        </div>
    </header>

    <section id="gestion-habitaciones" class="container">
        <h2>Gestión de Habitaciones</h2>
        <form id="form-habitaciones">
            <label for="tipo">Tipo de Habitación:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo de habitación</option>
                <option value="estandar">Habitación Estándar 🌿</option>
                <option value="deluxe">Habitación Deluxe con Vista al Mar 🌅</option>
                <option value="junior">Suite Junior 🏝️</option>
                <option value="presidencial">Suite Presidencial 🌟</option>
                <option value="bungalow">Bungalow Privado Frente al Mar 🏖️</option>
            </select>
            
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="imagenes">Imágenes:</label>
            <input type="file" id="imagenes" name="imagenes" accept="image/*" multiple required>
            
            <button type="submit">Agregar Habitación</button>
        </form>
        <div id="lista-habitaciones">
            <!-- Aquí se mostrarán las habitaciones -->
        </div>
    </section>

    <section id="panel-reservas" class="container">
        <h2>Panel de Reservas</h2>
        <div id="lista-reservas">
            <!-- Aquí se mostrarán las reservas -->
        </div>
    </section>

    <footer>
        <p>Panel de Administración <i class="fa-solid fa-water"></i> Hotel AquaMar Resort</p>
    </footer>

    <script src="/js/admin.js"></script>
</body>
</html>
