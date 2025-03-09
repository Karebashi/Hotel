document.addEventListener('DOMContentLoaded', () => {
    function eliminarSubHabitacion(id) {
        if (confirm("¿Estás seguro de que deseas eliminar esta sub-habitación?")) {
            fetch("eliminar_sub_habitacion.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${id}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                if (data.includes('Sub-habitación eliminada correctamente')) {
                    document.querySelector(`.sub-habitacion[data-id="${id}"]`).remove();
                }
            })
            .catch(error => {
                console.error("Error al eliminar la sub-habitación:", error);
            });
        }
    }

    document.getElementById('form-agregar-sub-habitacion').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('agregar_sub_habitacion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('Sub-habitación agregada correctamente')) {
                document.getElementById('mensaje-exito').style.display = 'block';
                const habitacionId = document.getElementById('habitacion_id').value;
                const subHabitacionId = document.getElementById('sub_habitacion_id').value;
                const subHabitacionDiv = document.createElement('div');
                subHabitacionDiv.classList.add('sub-habitacion');
                subHabitacionDiv.setAttribute('data-id', subHabitacionId);
                subHabitacionDiv.innerHTML = `
                    <span>Habitación ${subHabitacionId}</span>
                    <span class="estado">Disponible</span>
                    <button class="btn btn-eliminar" onclick="eliminarSubHabitacion(${subHabitacionId})">Eliminar</button>
                `;
                document.querySelector(`.habitacion[data-id="${habitacionId}"] .sub-habitaciones`).appendChild(subHabitacionDiv);

                // Attach event listener to the new delete button
                subHabitacionDiv.querySelector('.btn-eliminar').addEventListener('click', function() {
                    eliminarSubHabitacion(subHabitacionId);
                });
            } else {
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error al agregar la sub-habitación:', error);
        });
    });

    // Attach event listeners to existing delete buttons
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function() {
            const subHabitacionId = this.getAttribute('data-id');
            eliminarSubHabitacion(subHabitacionId);
        });
    });
});