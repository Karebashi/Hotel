<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../Vistas/html/index.php"); 
    exit();
}

include 'conexion_be.php';

// Obtener habitaciones
$query = "SELECT id, nombre, descripcion, precio, imagen FROM habitaciones";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Obtener mensajes de contacto con filtros
$search_subject = isset($_GET['search_subject']) ? $_GET['search_subject'] : '';
$search_email = isset($_GET['search_email']) ? $_GET['search_email'] : '';
$search_status = isset($_GET['search_status']) ? $_GET['search_status'] : '';

$query_contact = "SELECT id, name, email, subject, message, resolved FROM contact_messages WHERE subject LIKE '%$search_subject%' AND email LIKE '%$search_email%'";

if ($search_status !== '') {
    $query_contact .= " AND resolved = " . ($search_status === 'resuelto' ? '1' : '0');
}

$resultado_contact = mysqli_query($conexion, $query_contact);

if (!$resultado_contact) {
    die("Error en la consulta de mensajes de contacto: " . mysqli_error($conexion));
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
</head>
<body>
    <header>
        <div class="container">
            <h1>Panel de Administración <i class="fa-solid fa-water"></i> Hotel AquaMar Resort </h1>
            <nav>
                <ul>
                    <li><a href="#habitaciones">Habitaciones</a></li>
                    <li><a href="#panel-reservas">Panel de Reservas</a></li>
                    <li><a href="#correos-contacto">Correos de Contacto</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="habitaciones" class="container">
        <h2>Habitaciones</h2>
        <div class="habitaciones-tipo">
            <?php while ($habitacion = mysqli_fetch_assoc($resultado)): ?>
                <div class="habitacion" data-id="<?php echo $habitacion['id']; ?>">
                    <h3><?php echo $habitacion['nombre']; ?></h3>
                    <p><?php echo $habitacion['descripcion']; ?></p>
                    <p>Precio: <?php echo $habitacion['precio']; ?>€</p>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($habitacion['imagen']); ?>" alt="Imagen de la habitación">
                    <div class="sub-habitaciones">
                        <?php
                        $subQuery = "SELECT id, estado FROM sub_habitaciones WHERE habitacion_id = ?";
                        $stmt = $conexion->prepare($subQuery);
                        $stmt->bind_param("i", $habitacion['id']);
                        $stmt->execute();
                        $subResult = $stmt->get_result();

                        while ($subHabitacion = $subResult->fetch_assoc()): ?>
                            <div class="sub-habitacion <?php echo $subHabitacion['estado'] == 'ocupada' ? 'reservada' : ''; ?>" data-id="<?php echo $subHabitacion['id']; ?>">
                                <span>Habitación <?php echo $subHabitacion['id']; ?></span>
                                <span class="estado"><?php echo $subHabitacion['estado'] == 'ocupada' ? 'Ocupada' : 'Disponible'; ?></span>
                                <button class="btn btn-eliminar" data-id="<?php echo $subHabitacion['id']; ?>">Eliminar</button>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section id="agregar-sub-habitacion" class="container">
        <h2>Agregar Sub-Habitación</h2>
        <form id="form-agregar-sub-habitacion" action="agregar_sub_habitacion.php" method="POST" class="form-agregar-sub-habitacion">
            <div id="mensaje-exito" class="mensaje-exito" style="display: none; color: green; margin-bottom: 15px;">Sub-habitación agregada correctamente.</div>
            <div class="form-group">
                <label for="habitacion_id">ID de la Habitación:</label>
                <input type="number" id="habitacion_id" name="habitacion_id" required>
            </div>
            <div class="form-group">
                <label for="sub_habitacion_id">ID de la Sub-Habitación:</label>
                <input type="number" id="sub_habitacion_id" name="sub_habitacion_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Sub-Habitación</button>
        </form>
    </section>

    <section id="panel-reservas" class="container">
        <h2>Panel de Reservas</h2>
        <div id="lista-reservas">
            <!-- Aquí se mostrarán las reservas -->
        </div>
    </section>

    <section id="correos-contacto" class="container">
        <h2>Correos de Contacto</h2>
        <form id="form-busqueda" action="#correos-contacto" method="GET">
            <label for="search_subject">Buscar por Asunto:</label>
            <input type="text" id="search_subject" name="search_subject" value="<?php echo $search_subject; ?>">

            <label for="search_email">Buscar por Email:</label>
            <input type="email" id="search_email" name="search_email" value="<?php echo $search_email; ?>">

            <label for="search_status">Buscar por Estado:</label>
            <select id="search_status" name="search_status">
                <option value="">Todos</option>
                <option value="resuelto" <?php if ($search_status === 'resuelto') echo 'selected'; ?>>Resuelto</option>
                <option value="no_resuelto" <?php if ($search_status === 'no_resuelto') echo 'selected'; ?>>No Resuelto</option>
            </select>

            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <div id="lista-correos">
            <?php while ($contact = mysqli_fetch_assoc($resultado_contact)): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text"><strong>Asunto:</strong> <?php echo $contact['subject']; ?></p>
                        <p class="card-text"><strong>Nombre:</strong> <?php echo $contact['name']; ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo $contact['email']; ?></p>
                        <p class="card-text"><strong>Mensaje:</strong> <?php echo $contact['message']; ?></p>
                        <p class="card-text"><strong>Estado:</strong> <?php echo $contact['resolved'] ? 'Resuelto' : 'No resuelto'; ?></p>
                        <button class="btn btn-resuelto" onclick="marcarResuelto(<?php echo $contact['id']; ?>)">Marcar como Resuelto</button>
                        <button class="btn btn-no-resuelto" onclick="marcarNoResuelto(<?php echo $contact['id']; ?>)">Marcar como No Resuelto</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer>
        <p>Panel de Administración <i class="fa-solid fa-water"></i> Hotel AquaMar Resort</p>
    </footer>
</body>
</html>