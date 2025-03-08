<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../Vistas/html/index.html"); 
    exit();
}

include 'conexion_be.php';

$query = "SELECT id, nombre, descripcion, precio, imagen FROM habitaciones";
$resultado = mysqli_query($conexion, $query);
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
        <form id="form-habitaciones" action="guardar_habitacion.php" method="POST" enctype="multipart/form-data">
            <label for="tipo">Tipo de Habitación:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo de habitación</option>
                <option value="estandar">Habitación Ejecutiva 🌿</option>
                <option value="deluxe">Habitación Deluxe con Vista al Mar 🌅</option>
                <option value="junior">Suite Junior 🏝️</option>
                <option value="presidencial">Suite Presidencial 🌟</option>
            </select>
            
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="imagenes">Imágenes:</label>
            <input type="file" id="imagenes" name="imagenes" accept="image/*" multiple required>
            
            <button type="submit" class="btn btn-primary">Agregar Habitación</button>
        </form>
        <div id="lista-habitaciones">
            <h2>Habitaciones Existentes</h2>
            <div class="row">
                <?php while ($habitacion = mysqli_fetch_assoc($resultado)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="../../images/<?php echo explode(',', $habitacion['imagen'])[0]; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $habitacion['nombre']; ?></h5>
                                <p class="card-text"><?php echo $habitacion['descripcion']; ?></p>
                                <p class="card-text">Precio: $<?php echo $habitacion['precio']; ?></p>
                                <button class="btn btn-primary" onclick="editarHabitacion(<?php echo $habitacion['id']; ?>)">Editar</button>
                                <button class="btn btn-danger" onclick="eliminarHabitacion(<?php echo $habitacion['id']; ?>)">Eliminar</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
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

    <!-- Formulario de edición de habitación -->
    <div id="form-editar-habitacion" style="display: none;">
        <h2>Editar Habitación</h2>
        <form id="editar-habitacion" action="editar_habitacion.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="editar-id" name="id">
            <label for="editar-tipo">Tipo de Habitación:</label>
            <select id="editar-tipo" name="tipo" required>
                <option value="">Seleccione un tipo de habitación</option>
                <option value="estandar">Habitación Estándar 🌿</option>
                <option value="deluxe">Habitación Deluxe con Vista al Mar 🌅</option>
                <option value="junior">Suite Junior 🏝️</option>
                <option value="presidencial">Suite Presidencial 🌟</option>
                <option value="bungalow">Bungalow Privado Frente al Mar 🏖️</option>
            </select>
            
            <label for="editar-precio">Precio:</label>
            <input type="number" id="editar-precio" name="precio" required>

            <label for="editar-descripcion">Descripción:</label>
            <textarea id="editar-descripcion" name="descripcion" required></textarea>

            <label for="editar-imagenes">Imágenes:</label>
            <input type="file" id="editar-imagenes" name="imagenes" accept="image/*" multiple>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" onclick="ocultarFormularioEdicion()">Cancelar</button>
        </form>
    </div>

    <script>
        function editarHabitacion(id) {
            // Lógica para mostrar el formulario de edición con los datos de la habitación
            fetch(`obtener_habitacion.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editar-id').value = data.id;
                    document.getElementById('editar-tipo').value = data.nombre;
                    document.getElementById('editar-precio').value = data.precio;
                    document.getElementById('editar-descripcion').value = data.descripcion;
                    document.getElementById('form-editar-habitacion').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error al obtener los datos de la habitación:', error);
                });
        }

        function ocultarFormularioEdicion() {
            document.getElementById('form-editar-habitacion').style.display = 'none';
        }

        function eliminarHabitacion(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta habitación?")) {
                fetch("eliminar_habitacion.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${id}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error al eliminar la habitación:", error);
                });
            }
        }
    </script>
</body>
</html>

<?php
mysqli_close($conexion);
?>